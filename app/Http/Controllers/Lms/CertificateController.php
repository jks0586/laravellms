<?php

namespace App\Http\Controllers\lms;

use App\Http\Controllers\Controller;
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

class CertificateController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('can:certificate list', ['only' => ['index', 'show']]);
        $this->middleware('can:certificate create', ['only' => ['create', 'store']]);
        $this->middleware('can:certificate edit', ['only' => ['edit', 'update']]);
        $this->middleware('can:certificate delete', ['only' => ['destroy']]);
    }


    public function index()
    {

        $certificates = (new Certificate())->newQuery();
        $certificates->latest();
        $certificates = $certificates->paginate(100)->appends(request()->query());
        return response()->json($certificates);
    }

    public function autocomplete()
    {

        $certificates = (new Certificate())->newQuery();
        $certificates->latest();
        $certificates = $certificates->paginate(100)->appends(request()->query());
        return response()->json($certificates);
    }



    public function admin()
    {
        $organisations=$this->organisations();
        $certificates = (new Certificate())->newQuery();

        $certificates = $certificates->paginate(100)->onEachSide(2)->appends(request()->query());

        return Inertia::render('Lms/Certificate/Admin', [
            'organisations' => $organisations,
            'certificates' => $certificates,
            'can' => [
                'create' => Auth::user()->can('certificate create'),
                'edit' => Auth::user()->can('certificate edit'),
                'delete' => Auth::user()->can('certificate delete'),
            ]
        ]);
    }

    public function create()
    {

        $certificate = new Certificate();
        $organisations=$this->organisations();
        $imagelist=[];
        return Inertia::render('Lms/Certificate/Create', [
            'organisations' => $organisations,
            'lmsaction' => 'lms.certificate.store',
            'certificate' => $certificate,
            'imagelist'=>$imagelist,
            'can' => [
                'create' => Auth::user()->can('certificate create'),
                'edit' => Auth::user()->can('certificate edit'),
                'delete' => Auth::user()->can('certificate delete'),
            ]
        ]);
    }

    protected function inputValidate($request)
    {

        $inputdata=[
            'organisation_id' => 'nullable|numeric',
            'name' => ['required'],
        ];
        if($this->routeaction() == 'edit'){
            $inputdata['image']='required|mime:jpeg';
        }
        $validated = $request->validate($inputdata);
        return $validated;

    }



    public function store(Request $request)
    {
        if($this->inputValidate($request)){
            Certificate::create($request->all());
            return redirect()->route('lms.certificate.admin')->with(['sucsess' => 'Certificate has been successfully Created']);
        }

    }

    public function edit($id)
    {

        $certificate = Certificate::find($id);
        $organisations=$this->organisations();
        $organisation=Organisation::find($certificate->organisation_id);
        $certificate_dir=Storage::path('/public/uploads/'.$organisation->url.'/certificates/');
        $imagelist=[];
        $files = scandir($certificate_dir);
        if($files){
            foreach($files as $file){
                if(!is_dir($file)){
                    $imagelist[]=$file;
                }
            }
        }
        // $this->pre($imagelist);

        return Inertia::render('Lms/Certificate/Edit', [
            'lmsaction' => 'lms.certificate.update',
            'organisations' => $organisations,
            'certificate' => $certificate,
            'imagelist' => $imagelist,
            'can' => [
                'create' => Auth::user()->can('certificate create'),
                'edit' => Auth::user()->can('certificate edit'),
                'delete' => Auth::user()->can('certificate delete'),
            ]
        ]);
    }

    public function update($id, Request $request)
    {
        $certificate = Certificate::find($id);

        if($this->inputValidate($request)){
            if (!empty($request->all())) {
                foreach ($request->except(['imageurl','imagelistvalue']) as $key => $value) {
                        $certificate->$key = $value;
                }
                // echo $certificate->organisation_id; die;
                $organisation=Organisation::find($certificate->organisation_id);
                // $this->pre($organisation); die;
                if($request->imagelistvalue){
                    $certificate->image = 'uploads/'.$organisation->url.'/certificates/'.$request->imagelistvalue;
                } else if ($request->image) {

                    $fileName = $request->file('image')->getClientOriginalName();
                    $filePath = $request->file('image')->storeAs('uploads/'.$organisation->url.'/certificates/', $fileName, 'public');
                    $certificate->image = 'uploads/'.$organisation->url.'/certificates/'.$fileName;
                }

                $certificate->save();
            }

            return redirect()->route('lms.certificate.admin')->with(['sucsess' => 'Certificate has been successfully Updated']);

        }

    }

}
