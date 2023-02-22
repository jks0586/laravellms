<?php

namespace App\Http\Controllers\Lms;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Timezone;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;

class OrganisationController extends Controller
{
    public function __construct()
    {
        // $this->middleware('can:organisation list', ['only' => ['index', 'show']]);
        // $this->middleware('can:organisation create', ['only' => ['create', 'store']]);
        // $this->middleware('can:organisation edit', ['only' => ['edit', 'update']]);
        // $this->middleware('can:organisation delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return redirect('/lms/organisation/admin');
        // return redirect()->route('admin.organisation.admin');
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->appends(request()->query());
        return response()->json($organisations);
    }


    public function autocomplete()
    {
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->appends(request()->query());

        $this->data['organisations']=$organisations;

        return $this->response();
        // return response()->json($organisations);
    }

    public function admin()
    {
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());
        return Inertia::render('Lms/Organisation/Admin', [
            'organisations' => $organisations,
            'can' => [
                'create' => Auth::user()->can('organisation create'),
                'edit' => Auth::user()->can('organisation edit'),
                'delete' => Auth::user()->can('organisation delete'),
            ]
        ]);
    }
    public function create()
    {
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());
        $timezones = Timezone::all();
        // $org = (new Organisation);
        // $this->pre($timezones);
//         $this->pre($org);
// die('aaaa');
        return Inertia::render('Lms/Organisation/Create', [
            'organisations' => $organisations,
            'timezones' => $timezones,
            'lmsaction' => 'lms.organisation.store',
            'can' => [
                'create' => Auth::user()->can('organisation create'),
                'edit' => Auth::user()->can('organisation edit'),
                'delete' => Auth::user()->can('organisation delete'),
            ]
        ]);
    }



    // protected function validator(array $data)
    // {
    //     return Validator::make($data, [
    //         'name' => ['required', 'max:100'],
    //         'url' => ['required', 'max:100'],
    //         'from_email' => 'required|email|max:255',
    //         'identity_verification_email' => 'required|email|max:255',
    //     ]);
    // }

    protected $validatearray = [
        'name' => ['required', 'max:100'],
        'url' => ['required', 'max:100'],
        'from_email' => 'required|email|max:255',
        'identity_verification_email' => 'required|email|max:255',
        'parent_organisation_id'=>'nullable|numeric',
        'active'=>'nullable|boolean',
        'use_organisation_structure'=>'nullable||numeric',
        'use_usi'=>'nullable||numeric',
        'use_staff_id'=>'nullable||numeric',
        'time_zone'=>'nullable||max:255',
        'eway_customer_id'=>'nullable||numeric',
        'enable_eway'=>'nullable||boolean',
        'enable_stripe'=>'nullable||boolean',
        'eway_test_mode'=>'nullable||boolean',
        'email_template'=>'nullable||numeric',
        'logo'=>'nullable||mimes:jpg,png,jpeg',
        'background_image'=>'nullable||mimes:jpg,png,jpeg',
        'background_position'=>'nullable||numeric',
        'background_repeat'=>'nullable||numeric',
        'background_size'=>'nullable||numeric',
        'background_color'=>'nullable||numeric',
        'print_logo'=>'nullable||numeric',
        'footer_text'=>'nullable||numeric',
        'eway_user_name'=>'nullable||numeric',
        'stripe_secret_key'=>'nullable||max:64',
        'stripe_publishable_key'=>'nullable||max:64',
        'trial_end'=>'nullable',
        'restrict_by_ip'=>'nullable',
        'terms_and_conditions'=>'nullable',
        'identity_requirements'=>'nullable',
        'welcome_email'=>'nullable',
        'course_complete_email'=>'nullable',
        'invoice_address'=>'nullable',
        'new_course_email'=>'nullable',
        'set_password_email'=>'nullable',
        'invoice_thankyou_message'=>'nullable',
        'avetmiss_privacy_notice'=>'nullable',
    ];

    protected function inputValidate($request)
    {
        // $this->pre($request->all());
        $validated = $request->validate($this->validatearray);
        return $validated;
    }


    public function store(Request $request){

        if ($this->inputValidate($request)) {

                $ogobject = [];

                if (!empty($request->all())) {
                    foreach ($request->all() as $key => $value) {
                        $ogobject[$key] = $value;
                    }
                }

                if ($request->logo) {


                    $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
                    $filePath = $request->file('logo')->storeAs('uploads', $fileName, 'public');
                    $ogobject['logo'] = $fileName;
                }

                if ($request->background_image) {

                    $fileName = time() . '_' . $request->file('background_image')->getClientOriginalName();
                    $filePath = $request->file('background_image')->storeAs('uploads', $fileName, 'public');
                    $ogobject['background_image'] = $fileName;
                }

                // echo response(json_encode($ogobject));
                // die('yyy');
                $organisation = Organisation::create($ogobject);

                return Inertia::render('Lms/Organisation/Admin', ['organisation' => $organisation])->withViewData(['sucsess' => 'Oraganisation has been successfully Created']);

        }
    }

    public function edit($id)
    {

        $org = Organisation::find($id);

        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());
        $timezones = Timezone::all();
        $org->logo_url=($org->logo)?asset('storage/uploads/'.$org->logo):'';
        $org->background_image_url=($org->background_image)?asset('storage/uploads/'.$org->background_image):'';
        // $this->pre($org);
        return Inertia::render('Lms/Organisation/Edit', [
            'org' => $org,
            'lmsaction' => 'lms.organisation.update',
            'organisations' => $organisations,
            'timezones' => $timezones,
            'can' => [
                'create' => Auth::user()->can('organisation create'),
                'edit' => Auth::user()->can('organisation edit'),
                'delete' => Auth::user()->can('organisation delete'),
            ]
        ]);
    }

    public function update($id,Request $request){
        $organisation=Organisation::find($id);
        if($this->inputValidate($request)){
            if (!empty($request->except(['logo','background_image']))) {
                foreach ($request->except(['logo','background_image']) as $key => $value) {
                    if($key!='password'){
                        $organisation->$key = $value;
                    }

                }

            }
            if(!empty($request->files)){
                foreach ($request->files as $key => $value) {
                    $fileName = time() . '_' . $request->file($key)->getClientOriginalName();
                    $filePath = $request->file($key)->storeAs('uploads', $fileName, 'public');
                    $organisation->$key = $fileName;
                }
            }

            $organisation->save();

            return redirect()->route('lms.organisation.admin');

        }
    }
}
