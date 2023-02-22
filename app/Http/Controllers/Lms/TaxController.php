<?php

namespace App\Http\Controllers\Lms;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Course;
use App\Models\Tax;
use App\Models\CourseSetting;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;

class TaxController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tax list', ['only' => ['index', 'show']]);
        $this->middleware('can:tax create', ['only' => ['create', 'store']]);
        $this->middleware('can:tax edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:tax delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $taxes = (new Tax)->newQuery();
        $taxes->latest();
        $taxes = $taxes->paginate(100)->appends(request()->query());
        return response()->json($taxes);
    }


    public function autocomplete()
    {
        $taxes = (new Tax)->newQuery();
        $taxes = $taxes->paginate(100)->appends(request()->query());
        // echo '<pre>';print_r($taxes);echo '</pre>';
        // die;
        return response()->json($taxes);
    }


    public function admin()
    {
        $taxes = (new Tax)->newQuery();
        $taxes = $taxes->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Tax/Admin', [
            'taxes' => $taxes,
            'can' => [
                'create' => Auth::user()->can('tax create'),
                'edit' => Auth::user()->can('tax edit'),
                'delete' => Auth::user()->can('tax delete'),
            ]
        ]);
    }

    public function create()
    {

        return Inertia::render('Lms/Tax/Create', [
            'lmsaction' => 'lms.tax.store',
            'can' => [
                'create' => Auth::user()->can('tax create'),
                'edit' => Auth::user()->can('tax edit'),
                'delete' => Auth::user()->can('tax delete'),
            ]
        ]);
    }



    protected function inputValidate($request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'percent' => ['required', 'max:255'],
        ]);

        return $validator;
    }



    public function store(Request $request)
    {
        if($this->inputValidate($request)){
            $user = tax::create([
                'name' => $request->name,
                'percent' => $request->percent,
            ]);
            return redirect()->route('lms.tax.admin');
        }
    }

    public function edit($id)
    {

        $tax = Tax::find($id);

        return Inertia::render('Lms/Tax/Edit', [
            'tax' => $tax,
            'lmsaction' => 'lms.tax.update',
            'can' => [
                'create' => Auth::user()->can('tax create'),
                'edit' => Auth::user()->can('tax edit'),
                'delete' => Auth::user()->can('tax delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $tax = Tax::find($id);

        if($this->inputValidate($request)){
            $tax->name=$request->name;
            $tax->percent=$request->percent;
            $tax->save();
            return redirect()->route('lms.tax.admin')->with(['sucsess' => 'tax has been successfully Updated']);
        }
    }
}
