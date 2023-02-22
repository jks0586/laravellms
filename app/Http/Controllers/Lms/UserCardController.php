<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
use App\Models\UserCard;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class UserCardController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:coursecard list', ['only' => ['index', 'show']]);
        $this->middleware('can:coursecard create', ['only' => ['create', 'store']]);
        $this->middleware('can:coursecard edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:coursecard delete', ['only' => ['destroy']]);
    }


    public function index()
    {

        return redirect()->route('lms.usercard.admin');

    }

    public function autocomplete()
    {

        $usercards = (new UserCard())->newQuery();

        $usercards = $usercards->paginate(100)->appends(request()->query());
        return response()->json($usercards);
    }



    public function admin()
    {

        $usercards = (new UserCard())->newQuery();
        $usercards = $usercards->paginate(100)->onEachSide(2)->appends(request()->query());
        return Inertia::render('Lms/UserCard/Admin', [
            'usercards' => $usercards,
            'can' => [
                'create' => Auth::user()->can('usercard create'),
                'edit' => Auth::user()->can('usercard edit'),
                'delete' => Auth::user()->can('usercard delete'),
            ]
        ]);
    }

    public function create()
    {

        $usercard = new UserCard();

        return Inertia::render('Lms/UserCard/Create', [
            'lmsaction' => 'lms.usercard.store',
            'usercard' => $usercard,
            'can' => [
                'create' => Auth::user()->can('usercard create'),
                'edit' => Auth::user()->can('usercard edit'),
                'delete' => Auth::user()->can('usercard delete'),
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
            $usercard=UserCard::create($request->all());
            if($request->requesttype=='modal'){
                return response()->json(['success'=>'User Card has been successfully created','usercard'=>$usercard,'requesttype'=>$request->requesttype]);
            } else {
                return redirect()->route('lms.usercard.admin')->with(['sucsess' => 'Course Card has been successfully Created','requesttype'=>$request->requesttype]);
            }

        }

    }

    public function edit($id)
    {
        $usercard = UserCard::find($id);
        return Inertia::render('Lms/UserCard/Edit', [
            'lmsaction' => 'lms.usercard.update',
            'usercard' => $usercard,
            'can' => [
                'create' => Auth::user()->can('usercard create'),
                'edit' => Auth::user()->can('usercard edit'),
                'delete' => Auth::user()->can('usercard delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $usercard = UserCard::find($id);

        if($this->inputValidate($request)){
            if (!empty($request->all())) {
                foreach ($request->all() as $key => $value) {
                        $usercard->$key = $value;
                }
                $usercard->save();
            }

            return redirect()->route('lms.usercard.admin')->with(['sucsess' => 'User Card has been successfully Updated']);

        }

    }
}
