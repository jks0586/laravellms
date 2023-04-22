<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;

use App\Http\Controllers\Lms\DashboardController;
use App\Http\Controllers\Lms\OrganisationController;
use App\Http\Controllers\Lms\UserController;
use App\Http\Controllers\Lms\CourseController;
use App\Http\Controllers\Lms\PackageController;
use App\Http\Controllers\Lms\PackageCourseController;
use App\Http\Controllers\Lms\CertificateController;
use App\Http\Controllers\Lms\CourseCertificateController;
use App\Http\Controllers\Lms\CardController;
use App\Http\Controllers\Lms\CourseCardController;
use App\Http\Controllers\Lms\TaxController;
use App\Http\Controllers\Lms\TimezoneController;
use App\Http\Controllers\Lms\CountryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('register', [PassportAuthController::class, 'register']);
Route::post('login', [PassportAuthController::class, 'login']);
Route::GET('user',function(){
    return true;
});

Route::group(['namespace' => 'App\Http\Controllers\Lms'], function () {
    // dahboard routes
    Route::get('dashboard/index',[DashboardController::class,'index'])->name('site.dashboard.index');
    Route::get('dashboard/admin',[DashboardController::class,'admin'])->name('site.dashboard.admin');
    // organisation routes for LMS

    Route::get('organisation/index',[OrganisationController::class,'index'])->name('lms.organisation.index');
    Route::get('organisation/autocomplete',[OrganisationController::class,'autocomplete'])->name('lms.organisation.autocomplete');
    Route::get('organisation/admin',[OrganisationController::class,'admin'])->name('lms.organisation.admin');
    Route::get('organisation/create',[OrganisationController::class,'create'])->name('lms.organisation.create');
    Route::post('organisation/store',[OrganisationController::class,'store'])->name('lms.organisation.store');
    Route::get('organisation/edit/{id}',[OrganisationController::class,'edit'])->name('lms.organisation.edit');
    Route::post('organisation/update/{id}',[OrganisationController::class,'update'])->name('lms.organisation.update');

    // Country List Section In LMS
    Route::get('country/index',[CountryController::class,'index'])->name('lms.country.index');
    Route::get('country/autocomplete',[CountryController::class,'autocomplete'])->name('lms.country.autocomplete');
    Route::get('country/admin',[CountryController::class,'admin'])->name('lms.country.admin');
    Route::post('country/store',[CountryController::class,'store'])->name('lms.country.store');
    Route::post('country/update/{id}',[CountryController::class,'update'])->name('lms.country.update');


    // Timezon routes in LMS
    Route::get('timezone/index',[TimezoneController::class,'index'])->name('lms.timezone.index');
    Route::get('timezone/admin',[TimezoneController::class,'admin'])->name('lms.timezone.admin');
    Route::get('timezone/autocomplete',[TimezoneController::class,'autocomplete'])->name('lms.timezone.autocomplete');
    Route::get('timezone/create',[TimezoneController::class,'create'])->name('lms.timezone.create');
    Route::post('timezone/store',[TimezoneController::class,'store'])->name('lms.timezone.store');
    Route::get('timezone/edit/{id}',[TimezoneController::class,'edit'])->name('lms.timezone.edit');
    Route::post('timezone/update',[TimezoneController::class,'update'])->name('lms.timezone.update');



    // Tax routes in LMS
    Route::get('tax/index',[TaxController::class,'index'])->name('lms.tax.index');
    Route::get('tax/admin',[TaxController::class,'admin'])->name('lms.tax.admin');
    Route::get('tax/autocomplete',[TaxController::class,'autocomplete'])->name('lms.tax.autocomplete');
    Route::get('tax/create',[TaxController::class,'create'])->name('lms.tax.create');
    Route::post('tax/store',[TaxController::class,'store'])->name('lms.tax.store');
    Route::get('tax/edit/{id}',[TaxController::class,'edit'])->name('lms.tax.edit');
    Route::post('tax/update',[TaxController::class,'update'])->name('lms.tax.update');


    // user routes
    Route::get('user/index',[UserController::class,'index'])->name('lms.user.index');
    Route::get('user/admin',[UserController::class,'admin'])->name('lms.user.admin');
    Route::get('user/create',[UserController::class,'create'])->name('lms.user.create');
    Route::post('user/store',[UserController::class,'store'])->name('lms.user.store');
    Route::get('user/edit/{id}',[UserController::class,'edit'])->name('lms.user.edit');
    Route::post('user/update',[UserController::class,'update'])->name('lms.user.update');



    //courses route list
    Route::get('course/index',[CourseController::class,'index'])->name('lms.course.index');
    Route::get('course/admin',[CourseController::class,'admin'])->name('lms.course.admin');
    Route::get('course/create',[CourseController::class,'create'])->name('lms.course.create');
    Route::post('course/store',[CourseController::class,'store'])->name('lms.course.store');
    Route::get('course/update/{id}',[CourseController::class,'edit'])->name('lms.course.edit');
    Route::post('course/update/{id}',[CourseController::class,'update'])->name('lms.course.update');
    Route::get('course/autocomplete',[CourseController::class,'autocomplete'])->name('lms.course.autocomplete');

    //package route list
    Route::get('package/index',[PackageController::class,'index'])->name('lms.package.index');
    Route::get('package/admin',[PackageController::class,'admin'])->name('lms.package.admin');
    Route::get('package/create',[PackageController::class,'create'])->name('lms.package.create');
    Route::post('package/store',[PackageController::class,'store'])->name('lms.package.store');
    Route::get('package/update/{id}',[PackageController::class,'edit'])->name('lms.package.edit');
    Route::post('package/update/{id}',[PackageController::class,'update'])->name('lms.package.update');
    Route::get('package/autocomplete',[PackageController::class,'autocomplete'])->name('lms.package.autocomplete');

    //packagecourse route list
    Route::get('packagecourse/index',[PackageCourseController::class,'index'])->name('lms.packagecourse.index');
    Route::get('packagecourse/admin',[PackageCourseController::class,'admin'])->name('lms.packagecourse.admin');
    Route::get('packagecourse/create',[PackageCourseController::class,'create'])->name('lms.packagecourse.create');
    Route::post('packagecourse/store',[PackageCourseController::class,'store'])->name('lms.packagecourse.store');
    Route::get('packagecourse/update/{id}',[PackageCourseController::class,'edit'])->name('lms.packagecourse.edit');
    Route::post('packagecourse/update/{id}',[PackageCourseController::class,'update'])->name('lms.packagecourse.update');
    Route::get('packagecourse/autocomplete',[PackageCourseController::class,'autocomplete'])->name('lms.packagecourse.autocomplete');

    //certificate route list
    Route::get('certificate/index',[CertificateController::class,'index'])->name('lms.certificate.index');
    Route::get('certificate/admin',[CertificateController::class,'admin'])->name('lms.certificate.admin');
    Route::get('certificate/create',[CertificateController::class,'create'])->name('lms.certificate.create');
    Route::post('certificate/store',[CertificateController::class,'store'])->name('lms.certificate.store');
    Route::get('certificate/update/{id}',[CertificateController::class,'edit'])->name('lms.certificate.edit');
    Route::post('certificate/update/{id}',[CertificateController::class,'update'])->name('lms.certificate.update');
    Route::get('certificate/autocomplete',[CertificateController::class,'autocomplete'])->name('lms.certificate.autocomplete');

    //course certificate route list
    Route::get('coursecertificate/index',[CourseCertificateController::class,'index'])->name('lms.coursecertificate.index');
    Route::get('coursecertificate/admin',[CourseCertificateController::class,'admin'])->name('lms.coursecertificate.admin');
    Route::get('coursecertificate/create',[CourseCertificateController::class,'create'])->name('lms.coursecertificate.create');
    Route::post('coursecertificate/store',[CourseCertificateController::class,'store'])->name('lms.coursecertificate.store');
    Route::get('coursecertificate/update/{id}',[CourseCertificateController::class,'edit'])->name('lms.coursecertificate.edit');
    Route::post('coursecertificate/update/{id}',[CourseCertificateController::class,'update'])->name('lms.coursecertificate.update');
    Route::get('coursecertificate/autocomplete',[CourseCertificateController::class,'autocomplete'])->name('lms.coursecertificate.autocomplete');

     //card route list
     Route::get('card',[CardController::class,'index'])->name('lms.card.index');
     Route::get('card/index',[CardController::class,'index'])->name('lms.card.index');
     Route::get('card/admin',[CardController::class,'admin'])->name('lms.card.admin');
     Route::get('card/create',[CardController::class,'create'])->name('lms.card.create');
     Route::post('card/store',[CardController::class,'store'])->name('lms.card.store');
     Route::get('card/update/{id}',[CardController::class,'edit'])->name('lms.card.edit');
     Route::post('card/update/{id}',[CardController::class,'update'])->name('lms.card.update');
     Route::get('card/autocomplete',[CardController::class,'autocomplete'])->name('lms.card.autocomplete');

     //course card route list
     Route::get('coursecard/index',[CourseCardController::class,'index'])->name('lms.coursecard.index');
     Route::get('coursecard/admin',[CourseCardController::class,'admin'])->name('lms.coursecard.admin');
     Route::get('coursecard/create',[CourseCardController::class,'create'])->name('lms.coursecard.create');
     Route::post('coursecard/store',[CourseCardController::class,'store'])->name('lms.coursecard.store');
     Route::get('coursecard/update/{id}',[CourseCardController::class,'edit'])->name('lms.coursecard.edit');
     Route::post('coursecard/update/{id}',[CourseCardController::class,'update'])->name('lms.coursecard.update');
     Route::get('coursecard/autocomplete',[CourseCardController::class,'autocomplete'])->name('lms.coursecard.autocomplete');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
