<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
use App\Models\Card;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\Organisation;
use App\Models\Course;
use App\Models\CourseSetting;
use App\Models\Tax;
use App\Models\Timezone;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

class CardController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:card list', ['only' => ['index', 'show']]);
        $this->middleware('can:card create', ['only' => ['create', 'store']]);
        $this->middleware('can:card edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:card delete', ['only' => ['destroy']]);
    }


    public function index()
    {

        return redirect()->route('lms.card.admin');
        // $cards = (new Card())->newQuery();
        // $cards->latest();
        // $cards = $cards->paginate(100)->appends(request()->query());
        // return response()->json($cards);
    }

    public function autocomplete()
    {

        $cards = (new Card())->newQuery();
        $cards->latest();
        $cards = $cards->with('organisation')->paginate(100)->appends(request()->query());
        // $this->pre($cards[0]->organisation);
        return response()->json($cards);
    }



    public function admin()
    {
        $organisations=$this->organisations();
        $cards = (new Card())->newQuery();

        $cards = $cards->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Card/Admin', [
            'organisations' => $organisations,
            'cards' => $cards,
            'can' => [
                'create' => Auth::user()->can('card create'),
                'edit' => Auth::user()->can('card edit'),
                'delete' => Auth::user()->can('card delete'),
            ]
        ]);
    }

    public function create()
    {

        $card = new Card();
        $organisations=$this->organisations();

        return Inertia::render('Lms/Card/Create', [
            'organisations' => $organisations,
            'lmsaction' => 'lms.card.store',
            'card' => $card,
            'can' => [
                'create' => Auth::user()->can('card create'),
                'edit' => Auth::user()->can('card edit'),
                'delete' => Auth::user()->can('card delete'),
            ]
        ]);
    }

    protected function inputValidate($request)
    {

        $inputdata=[
            'organisation_id' => 'nullable|numeric',
            'name' => ['required'],
        ];
        // if($this->routeaction() == 'edit'){
        //     $inputdata['image']='required|mime:jpeg';
        // }
        $validated = $request->validate($inputdata);
        return $validated;

    }



    public function store(Request $request)
    {
        if($this->inputValidate($request)){
            Card::create($request->all());
            return redirect()->route('lms.card.admin')->with(['sucsess' => 'Card has been successfully Created']);
        }

    }

    public function edit($id)
    {
        $card = Card::find($id);
        $organisations=$this->organisations();
        // $organisation=Organisation::find($card->organisation_id);
        return Inertia::render('Lms/Card/Edit', [
            'lmsaction' => 'lms.card.update',
            'organisations' => $organisations,
            'card' => $card,
            'can' => [
                'create' => Auth::user()->can('card create'),
                'edit' => Auth::user()->can('card edit'),
                'delete' => Auth::user()->can('card delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $card = Card::find($id);

        if($this->inputValidate($request)){
            if (!empty($request->all())) {
                foreach ($request->all() as $key => $value) {
                        $card->$key = $value;
                }
                $card->save();
            }

            return redirect()->route('lms.card.admin')->with(['sucsess' => 'Card has been successfully Updated']);

        }

    }

}
