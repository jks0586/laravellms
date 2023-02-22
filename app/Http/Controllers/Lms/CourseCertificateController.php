<?php

namespace App\Http\Controllers\Lms;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\CourseSetting;
use App\Models\Tax;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;

class CourseCertificateController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coursecertificate list', ['only' => ['index', 'show']]);
        $this->middleware('can:coursecertificate create', ['only' => ['create', 'store']]);
        $this->middleware('can:coursecertificate edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:coursecertificate delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $coursecertificates = (new CourseCertificate)->newQuery();
        $coursecertificates->latest();
        $coursecertificates = $coursecertificates->paginate(100)->appends(request()->query());
        return response()->json($coursecertificates);
    }


    public function autocomplete()
    {

        $coursecertificates = (new CourseCertificate)->newQuery();
        // $coursecertificates->latest();
        $coursecertificates = $coursecertificates->paginate(100)->appends(request()->query());
        return response()->json($coursecertificates);
    }


    public function admin()
    {
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $courses = (new Course())->newQuery();
        $courses->latest();
        $courses = $courses->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/CourseCertificate/Admin', [
            'organisations' => $organisations,
            'courses' => $courses,
            'can' => [
                'create' => Auth::user()->can('course create'),
                'edit' => Auth::user()->can('course edit'),
                'delete' => Auth::user()->can('course delete'),
            ]
        ]);
    }
    public function create()
    {
        $course = new CourseCertificate;
        $coursesetting = new CourseSetting;

        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $taxs = (new Tax)->newQuery();
        $taxs = $taxs->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/CourseCertificate/Create', [
            'organisations' => $organisations,
            'taxs' => $taxs,
            'lmsaction' => 'lms.course.store',
            'delivery_modes' => (array) $course->delivery_modes,
            'field_of_education_identifiers' => $course->field_of_education_identifiers,
            'course' => $course,
            'coursesetting' => $coursesetting,
            'can' => [
                'create' => Auth::user()->can('coursecertificate create'),
                'edit' => Auth::user()->can('coursecertificate edit'),
                'delete' => Auth::user()->can('coursecertificate delete'),
            ]
        ]);
    }



    protected function inputValidate($request)
    {

        $validator = Validator::make($request->all(), [
            'organisation_id' => 'required|numeric',
            'course_id' => 'required|numeric',
            'certificate_id' => 'required|numeric',
        ]);

        return $validator;
    }


    public function store(Request $request)
    {
        // $this->pre($request->all()); die;
        $validator = $this->inputValidate($request);
        if ($validator->fails()) {
            // $messages = array_merge_recursive( $coursesettingvalidator->messages()->toArray());
            return back()->withInput()->withErrors($validator->messages());
        } else {
            $coursecertificate = CourseCertificate::create($request->all());
            if($request->requesttype=='modal'){
                return response()->json([
                    'coursecertificate' => $coursecertificate,
                    'success' => 'Course Certificate has been successfully Modified',
                ],200);
            } else {
                return redirect()->route('lms.coursecertificate.admin')->with(['sucsess' => 'Course Certificate has been successfully Modified']);
            }
        }
    }

    public function edit($id)
    {

        $course = Course::find($id);
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $taxs = (new Tax)->newQuery();
        $taxs = $taxs->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/CourseCertificate/Edit', [
            'course' => $course,
            'coursesetting' => $course->coursesetting,
            'lmsaction' => 'lms.course.update',
            'organisations' => $organisations,
            'delivery_modes' => (array) $course->delivery_modes,
            'field_of_education_identifiers' => $course->field_of_education_identifiers,
            'taxs' => $taxs,
            'can' => [
                'create' => Auth::user()->can('organisation create'),
                'edit' => Auth::user()->can('organisation edit'),
                'delete' => Auth::user()->can('organisation delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $course = Course::find($id);
        $coursevalidator = $this->inputValidateCourse($request);
        $coursesettingvalidator = $this->inputValidateCourseSetting($request);
        if ($coursevalidator->fails() || $coursesettingvalidator->fails()) {
            $messages = array_merge_recursive($coursevalidator->messages()->toArray(), $coursesettingvalidator->messages()->toArray());
            return back()->withInput()->withErrors($messages);
        } else {
            if ($request->course) {
                foreach ($request->course as $key => $value) {
                    $course->$key = $value;
                }
            }

            $course->save();

            if ($request->coursesetting) {
                $coursesetting_array = $request->coursesetting;
                $coursesetting_array['organisation_id'] = $course->organisation_id;
                $coursesetting_array['course_id'] = $course->id;
                $request->merge(['coursesetting' => $coursesetting_array]);
                if (!empty($course->coursesetting)) {
                    foreach ($request->coursesetting as $key => $value) {
                        $course->coursesetting->$key = $value;
                    }
                    $course->coursesetting->save();
                } else {
                    CourseSetting::create($request->coursesetting);
                }
            }
            return redirect()->route('lms.course.admin')->with(['sucsess' => 'Course has been successfully Updated']);
        }

    }
}
