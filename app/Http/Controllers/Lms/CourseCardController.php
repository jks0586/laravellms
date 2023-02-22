<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\Course;
use App\Models\CourseCard;
use App\Models\CourseSetting;
use App\Models\Tax;
use App\Models\Timezone;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

class CourseCardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:coursecard list', ['only' => ['index', 'show']]);
        $this->middleware('can:coursecard create', ['only' => ['create', 'store']]);
        $this->middleware('can:coursecard edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:coursecard delete', ['only' => ['destroy']]);
    }


    public function index()
    {


        $coursecards = (new CourseCard())->newQuery();
        // $coursecards->latest();
        $coursecards = $coursecards->with(['card','course'])->paginate(100)->appends(request()->query());
        return response()->json($coursecards);
    }

    public function autocomplete()
    {

        $coursecards = (new CourseCard())->newQuery();
        // $coursecards->latest();
        $coursecards = $coursecards->with(['card','course'])->paginate(100)->appends(request()->query());
        return response()->json($coursecards);
    }



    public function admin()
    {

        $coursecards = (new CourseCard())->newQuery();
        $coursecards = $coursecards->paginate(100)->onEachSide(2)->appends(request()->query());
        return Inertia::render('Lms/CourseCard/Admin', [
            'coursecards' => $coursecards,
            'can' => [
                'create' => Auth::user()->can('coursecard create'),
                'edit' => Auth::user()->can('coursecard edit'),
                'delete' => Auth::user()->can('coursecard delete'),
            ]
        ]);
    }

    public function create()
    {

        $coursecard = new CourseCard();

        return Inertia::render('Lms/CourseCard/Create', [
            'lmsaction' => 'lms.coursecard.store',
            'coursecard' => $coursecard,
            'can' => [
                'create' => Auth::user()->can('coursecard create'),
                'edit' => Auth::user()->can('coursecard edit'),
                'delete' => Auth::user()->can('coursecard delete'),
            ]
        ]);
    }

    protected function inputValidate($request)
    {

        $inputdata=[
            'course_id' => 'nullable|numeric',
            'card_id' => 'nullable|numeric',
        ];
        $validated = $request->validate($inputdata);
        return $validated;

    }



    public function store(Request $request)
    {
        if($this->inputValidate($request)){
            $coursecard=CourseCard::create($request->all());
            if($request->requesttype=='modal'){
                return response()->json(['success'=>'Course Card has been successfully created','coursecard'=>$coursecard,'requesttype'=>$request->requesttype]);
            } else {
                return redirect()->route('lms.coursecard.admin')->with(['sucsess' => 'Course Card has been successfully Created','requesttype'=>$request->requesttype]);
            }

        }

    }

    public function edit($id)
    {
        $coursecard = CourseCard::find($id);
        return Inertia::render('Lms/CourseCard/Edit', [
            'lmsaction' => 'lms.coursecard.update',
            'coursecard' => $coursecard,
            'can' => [
                'create' => Auth::user()->can('coursecard create'),
                'edit' => Auth::user()->can('coursecard edit'),
                'delete' => Auth::user()->can('coursecard delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $coursecard = CourseCard::find($id);

        if($this->inputValidate($request)){
            if (!empty($request->all())) {
                foreach ($request->all() as $key => $value) {
                        $coursecard->$key = $value;
                }
                $coursecard->save();
            }

            return redirect()->route('lms.coursecard.admin')->with(['sucsess' => 'Course Card has been successfully Updated']);

        }

    }

}
