<?php
namespace App\Http\Controllers\Lms;

use App\Http\Controllers\Controller;
use App\Models\Organisation;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Exception;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:package list', ['only' => ['index', 'show']]);
        $this->middleware('can:package create', ['only' => ['create', 'store']]);
        $this->middleware('can:package edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:package delete', ['only' => ['destroy']]);
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

        $packages = (new Package)->newQuery();
        $packages->latest();
        $packages = $packages->paginate(100)->appends(request()->query());
        return response()->json($packages);
    }

    public function admin()
    {
        $organisations = (new Organisation())->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        $packages = (new Package())->newQuery();
        $packages->latest();
        $packages = $packages->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Package/Admin', [
            'organisations' => $organisations,
            'packages' => $packages,
            'can' => [
                'create' => Auth::user()->can('package create'),
                'edit' => Auth::user()->can('package edit'),
                'delete' => Auth::user()->can('package delete'),
            ]
        ]);
    }

    public function create()
    {

        $package = new Package();

        $organisations=$this->organisations();

        return Inertia::render('Lms/Package/Create', [
            'organisations' => $organisations,
            'lmsaction' => 'lms.package.store',
            'lmspackage' => $package,
            'can' => [
                'create' => Auth::user()->can('course create'),
                'edit' => Auth::user()->can('course edit'),
                'delete' => Auth::user()->can('course delete'),
            ]
        ]);
    }

    protected function inputValidate($request)
    {
        $validated = $request->validate([
            'organisation_id' => 'required|numeric',
            'name' => ['required', 'max:255'],
            'weight' => ['required','numeric'],
            'visible' => ['nullable', 'numeric'],
            'short_description' => ['nullable'],
            'description' => ['nullable']
        ]);
        return $validated;

    }



    public function store(Request $request)
    {
        if($this->inputValidate($request)){
            $package = Package::create($request->all());
            return redirect()->route('lms.package.admin')->with(['sucsess' => 'Package has been successfully Created']);
        }

    }

    public function edit($id)
    {

        $package = Package::find($id);
        // $this->pre($course->coursesetting);
        $organisations = (new Organisation)->newQuery();
        $organisations->latest();
        $organisations = $organisations->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Package/Edit', [
            'lmspackage' => $package,
            'lmsaction' => 'lms.package.update',
            'organisations' => $organisations,
            'can' => [
                'create' => Auth::user()->can('package create'),
                'edit' => Auth::user()->can('package edit'),
                'delete' => Auth::user()->can('package delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $package = Package::find($id);

        if($this->inputValidate($request)){
            if (!empty($request->all())) {
                foreach ($request->all() as $key => $value) {
                        $package->$key = $value;
                }
                $package->save();
            }

            return redirect()->route('lms.package.admin')->with(['sucsess' => 'Package has been successfully Updated']);

        }

    }

}
