<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Course;
use App\Models\PackageCourse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;

class PackageCourseController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:packagecourse list', ['only' => ['index', 'show']]);
        $this->middleware('can:packagecourse create', ['only' => ['create', 'store']]);
        $this->middleware('can:packagecourse edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:packagecourse delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        $packages = (new Package())->newQuery();
        $packages->latest();
        $packages = $packages->paginate(100)->appends(request()->query());
        return response()->json($packages);
    }

    public function autocomplete()
    {

        $packagecourses = (new PackageCourse)->newQuery();
        $packagecourses = $packagecourses->paginate(100)->appends(request()->query());
        return response()->json($packagecourses);
    }

    public function admin()
    {
        $organisations=$this->organisations();
        $packagecourses = (new PackageCourse())->newQuery();

        $packagecourses = $packagecourses->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/PackageCourse/Admin', [
            'organisations' => $organisations,
            'packagecourses' => $packagecourses,
            'can' => [
                'create' => Auth::user()->can('packagecourses create'),
                'edit' => Auth::user()->can('packagecourses edit'),
                'delete' => Auth::user()->can('packagecourses delete'),
            ]
        ]);
    }

    public function create()
    {

        $packagecourse = new PackageCourse();

        $organisations=$this->organisations();

        $packages = (new Package)->newQuery();
        $packages=$packages->select('name', 'id')->paginate(100);

        $courses = (new Course)->newQuery();
        $courses=$courses->select('name', 'id')->paginate(100);

        // $this->pre($courses);

        return Inertia::render('Lms/PackageCourse/Create', [
            'organisations' => $organisations,
            'lmsaction' => 'lms.packagecourse.store',
            'packagecourse' => $packagecourse,
            'packages' => $packages,
            'courses' => $courses,
            'can' => [
                'create' => Auth::user()->can('packagecourse create'),
                'edit' => Auth::user()->can('packagecourse edit'),
                'delete' => Auth::user()->can('packagecourse delete'),
            ]
        ]);
    }

    protected function inputValidate($request)
    {
        $validated = $request->validate([
            'organisation_id' => 'nullable|numeric',
            'package_id' => ['required'],
            'course_id' => ['required'],
            'price' => ['required', 'numeric'],
        ]);
        return $validated;

    }



    public function store(Request $request)
    {
        if($this->inputValidate($request)){
            PackageCourse::create($request->all());
            return redirect()->route('lms.packagecourse.admin')->with(['sucsess' => 'Package Course has been successfully Created']);
        }

    }

    public function edit($id)
    {

        $packagecourse = PackageCourse::find($id);

        $organisations=$this->organisations();

        $packages = (new Package)->newQuery();
        $packages=$packages->select('name', 'id')->paginate(100);

        $courses = (new Course)->newQuery();
        $courses=$courses->select('name', 'id')->paginate(100);

        return Inertia::render('Lms/PackageCourse/Edit', [
            'lmspackage' => $packagecourse,
            'lmsaction' => 'lms.packagecourse.update',
            'organisations' => $organisations,
            'packages' => $packages,
            'courses' => $courses,
            'can' => [
                'create' => Auth::user()->can('packagecourse create'),
                'edit' => Auth::user()->can('packagecourse edit'),
                'delete' => Auth::user()->can('packagecourse delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $packagecourse = PackageCourse::find($id);

        if($this->inputValidate($request)){
            if (!empty($request->all())) {
                foreach ($request->all() as $key => $value) {
                        $packagecourse->$key = $value;
                }
                $packagecourse->save();
            }

            return redirect()->route('lms.packagecourse.admin')->with(['sucsess' => 'Package Course has been successfully Updated']);

        }

    }
}
