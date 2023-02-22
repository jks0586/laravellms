<?php

namespace App\Http\Controllers\Lms;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Course;
use App\Models\CourseSetting;
use App\Models\Tax;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:course list', ['only' => ['index', 'show']]);
        $this->middleware('can:course create', ['only' => ['create', 'store']]);
        $this->middleware('can:course edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:course delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $courses = (new Course)->newQuery();
        $courses->latest();
        $courses = $courses->paginate(100)->appends(request()->query());
        return response()->json($courses);
    }


    public function autocomplete()
    {

        $courses = (new Course)->newQuery();
        $courses->latest();
        $courses = $courses->paginate(100)->appends(request()->query());
        return response()->json($courses);
    }


    public function admin()
    {
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $courses = (new Course())->newQuery();
        $courses->latest();
        $courses = $courses->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Course/Admin', [
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
        $course = new Course;
        $coursesetting = new CourseSetting;
        // $this->pre($course);

        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $taxs = (new Tax)->newQuery();
        $taxs = $taxs->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Course/Create', [
            'organisations' => $organisations,
            'taxs' => $taxs,
            'lmsaction' => 'lms.course.store',
            'delivery_modes' => (array) $course->delivery_modes,
            'field_of_education_identifiers' => $course->field_of_education_identifiers,
            'course' => $course,
            'coursesetting' => $coursesetting,
            'can' => [
                'create' => Auth::user()->can('course create'),
                'edit' => Auth::user()->can('course edit'),
                'delete' => Auth::user()->can('course delete'),
            ]
        ]);
    }



    protected function inputValidateCourse($request)
    {

        $validator = Validator::make($request->course, [
            'organisation_id' => 'required|numeric',
            'name' => ['required', 'max:255'],
            // 'url' => ['required', 'max:255'],
            'full_title' => ['nullable', 'max:255'],
            'code' => ['nullable', 'max:255'],
            'is_scorm' => ['nullable', 'numeric'],
            'is_scorm_new' => ['nullable', 'numeric'],
            'require_marking' => ['nullable', 'numeric'],
            'complete_in_order' => ['nullable', 'numeric'],
            'show_outline' => ['nullable', 'numeric'],
            'show_outline_shared' => ['nullable', 'numeric'],
            'course_outline' => ['nullable'],
            'image' => ['nullable', 'max:255'],
            'nominal_hours' => ['nullable', 'numeric'],
            'vet_flag' => ['nullable', 'numeric'],
            'field_of_education_identifier' => ['nullable', 'max:6'],
            'delivery_mode' => ['nullable', 'max:3'],
        ]);

        return $validator;
    }

    protected function inputValidateCourseSetting($request)
    {

        $validator = Validator::make($request->coursesetting, [
            'price' => 'required',
        ]);

        return $validator;
    }


    public function store(Request $request)
    {
        // $this->pre($request->course);
        $coursevalidator = $this->inputValidateCourse($request);
        $coursesettingvalidator = $this->inputValidateCourseSetting($request);
        if ($coursevalidator->fails() || $coursesettingvalidator->fails()) {
            $messages = array_merge_recursive($coursevalidator->messages()->toArray(), $coursesettingvalidator->messages()->toArray());

            // $merge_errors=array_merge($coursevalidator,$coursesettingvalidator);
            return back()->withInput()->withErrors($messages);
            // return Inertia::render('Lms/Course/Create')->withErrors($validator);
            // return response()->json($validator->messages(), 200);
        } else {
            $course = Course::create($request->course);
            $coursesetting_array = $request->coursesetting;
            $coursesetting_array['organisation_id'] = $course->organisation_id;
            $coursesetting_array['course_id'] = $course->id;
            $request->merge(['coursesetting' => $coursesetting_array]);
            $coursesetting = CourseSetting::create($request->coursesetting);
            // return Inertia::render('Lms/Course/Admin', ['course' => $course,'coursesetting' => $coursesetting])->withViewData(['sucsess' => 'Course has been successfully Created']);

            return redirect()->route('lms.course.admin')->with(['sucsess' => 'Course has been successfully Created']);
        }

        // print_r($request->course);


        // die;
        // if ($this->inputValidate($request)) {
        //         return Inertia::render('Lms/Course/Admin');
        // }
    }

    public function edit($id)
    {

        $course = Course::find($id);
        // $this->pre($course->coursesetting);
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $taxs = (new Tax)->newQuery();
        $taxs = $taxs->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Course/Edit', [
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
