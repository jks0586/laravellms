<?php
namespace App\Http\Controllers\Lms;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user list', ['only' => ['index', 'show']]);
        $this->middleware('can:user admin', ['only' => ['admin']]);
        $this->middleware('can:user create', ['only' => ['create', 'store']]);
        $this->middleware('can:user edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:user delete', ['only' => ['destroy']]);
    }    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new User)->newQuery();
        $users->latest();
        $users = $users->paginate(100)->onEachSide(2)->appends(request()->query());
        return response()->json($users);
        // return Inertia::render('Admin/User/Index', [
        //     'users' => $users,
        //     'can' => [
        //         'create' => Auth::user()->can('user create'),
        //         'edit' => Auth::user()->can('user edit'),
        //         'delete' => Auth::user()->can('user delete'),
        //     ]
        // ]);
    }

    public function admin()
    {
         return Inertia::render('Lms/User/Admin', [
            'can' => [
                'create' => Auth::user()->can('user create'),
                'edit' => Auth::user()->can('user edit'),
                'delete' => Auth::user()->can('user delete'),
            ]
        ]);
    }

    public function create(){
            $organisations = Organisation::select('id','name')->get();
            $countries = Country::select('id','name')->get();

        return Inertia::render('Lms/User/Create', [
            'organisations'=>$organisations,
            'countries'=>$countries,
            'lmsaction'=>'lms.user.store',
            'can' => [
                'create' => Auth::user()->can('organisation create'),
                'edit' => Auth::user()->can('organisation edit'),
                'delete' => Auth::user()->can('organisation delete'),
            ]
        ]);
    }
    protected $validatearray=[
        'organisation_id'=>'required|integer',
        'usi'=>'max:255|nullable',
        'is_admin'=>'numeric|nullable',
        'title'=>'max:24',
        'name'=>'max:255|nullable',
        'first_name'=>'required|max:255',
        'middle_name'=>'max:255',
        'last_name'=>'required|max:255',
        'name_on_invoice'=>'max:255',
        'email'=>'unique:users|required|max:255',
        'staff_id'=>'max:255|nullable',
        'verified_identity'=>'numeric|nullable',
        'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
        'address_country'=>'numeric',
        'mla_road_address'=>'required|max:255',
        // 'address'=>'required|max:255',
        'suburb'=>'max:255',
        'state'=>'max:255',
        'postcode'=>'max:255',
        'password'=>['sometimes','required','min:6']
        // 'country_of_birth'=>'numeric',
        // 'browser'=>'max:255|nullable',
        // 'browser_version'=>'max:255|nullable',
        // 'ip'=>'max:255',
        // 'longitude'=>'max:255',
        // 'latitude'=>'max:255',

        // 'activity_stamp'=>'max:255|nullable',
        // 'mla_type'=>'max:255|nullable',
        // 'mla_register'=>'max:255',
        // 'mla_feedlot'=>'max:255',
        // 'mla_manufacturers_company'=>'max:255',
        // 'mla_company'=>'max:255',
        // 'mla_road_address'=>'max:255',
        // 'mla_town'=>'max:255',
        // 'created'=>'nullable',
        // 'modified'=>'nullable',
    ];
    protected function inputValidate($request){
        // print_r($request->all()); die;
        // print_r($this->validatearray); die;

        $validated = $request->validate($this->validatearray);
        // print_r($validated); die;

        return $validated;
    }

    public function store(Request $request){
        // $this->pre($request->all());

        if($this->inputValidate($request)){
            $user = User::create([
                'usi' => $request->usi,
                'is_admin' => $request->is_admin,
                'title' => $request->title,
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'name_on_invoice' => $request->name_on_invoice,
                'email' => $request->email,
                'staff_id' => $request->staff_id,
                'verified_identity' => $request->verified_identity,
                'address' => $request->address,
                'suburb' => $request->suburb,
                'state' => $request->state,
                'postcode' => $request->postcode,
                'country_of_birth' => $request->country_of_birth,
                'address_country' => $request->address_country,
                'country_of_birth' => $request->country_of_birth,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('lms.user.admin');
            // return RedirectResponse::route('users.index');
        }
        // $organisations = Organisation::select('id','name')->get();
        // $countries = Country::select('id','name')->get();

        // return Inertia::render('Lms/User/Create', [
        //     'organisations'=>$organisations,
        //     'countries'=>$countries,
        //     'can' => [
        //         'create' => Auth::user()->can('organisation create'),
        //         'edit' => Auth::user()->can('organisation edit'),
        //         'delete' => Auth::user()->can('organisation delete'),
        //     ]
        // ]);
}

public function edit($id){
    $organisations = Organisation::select('id','name')->get();
    $countries = Country::select('id','name')->get();
    $user=User::find($id);
    // $this->pre($user);
    return Inertia::render('Lms/User/Edit', [
        'organisations'=>$organisations,
        'countries'=>$countries,
        'lmsaction'=>'lms.user.update',
        'user'=>$user,
        'can' => [
            'create' => Auth::user()->can('organisation create'),
            'edit' => Auth::user()->can('organisation edit'),
            'delete' => Auth::user()->can('organisation delete'),
        ]
    ]);
}

public function update($id,Request $request){
    // $this->pre($request->all());
    $user=User::find($id);
    if($this->inputValidate($request)){

            $user->usi= $request->usi;
            $user->is_admin= $request->is_admin;
            $user->title= $request->title;
            $user->name= $request->name;
            $user->first_name= $request->first_name;
            $user->last_name= $request->last_name;
            $user->middle_name= $request->middle_name;
            $user->name_on_invoice= $request->name_on_invoice;
            $user->email= $request->email;
            $user->staff_id= $request->staff_id;
            $user->verified_identity= $request->verified_identity;
            $user->address= $request->address;
            $user->suburb= $request->suburb;
            $user->state= $request->state;
            $user->postcode= $request->postcode;
            $user->country_of_birth= $request->country_of_birth;
            $user->address_country= $request->address_country;
            $user->country_of_birth= $request->country_of_birth;
            if(!empty($request->password)){
                $user->password= Hash::make($request->password);
            }

        return redirect()->route('lms.user.admin');
        // return RedirectResponse::route('users.index');
    }
}

}
