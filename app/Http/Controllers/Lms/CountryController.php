<?php

namespace App\Http\Controllers\lms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Facades\Auth;
class CountryController extends Controller
{
    //

    public function __construct()
    {
        // $this->middleware('can:card list', ['only' => ['index', 'show']]);
        // $this->middleware('can:card create', ['only' => ['create', 'store']]);
        // $this->middleware('can:card edit', ['only' => ['edit', 'update']]);
        // $this->middleware('can:card delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        return redirect()->route('lms.country.admin');   
    }

    public function autocomplete()
    {
        $countries = (new Country())->newQuery();
        // $countries->latest();
        $countries = $countries->paginate(100)->appends(request()->query());
        return response()->json($countries);
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
