<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DBHomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\LectureController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/contactMe', 'HomeController@contactMe');
Route::get('/dailyMail', 'HomeController@dailyMail');

// Auth::routes();
Auth::routes(['register' => true]);

//DB common routes
Route::get('db_views/db_home', [DBHomeController::class, 'index'])->name('db_home');

//LastUpdate routes
Route::post('db_views/lastupdate', 'LastUpdateController@store')->name('lastupdate.store');

//User routes for admin
Route::get('db_views/user', [UserController::class, 'index'])->name('user.index')->middleware('checkrole:Admin,Operator');
Route::get('db_views/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('checkrole:Admin,Operator');
Route::get('db_views/user/{user}/editLimit', [UserController::class, 'editLimit'])->name('user.editLimit')->middleware('is.mine.or.allowed:Admin,Operator');
Route::put('db_views/user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('checkrole:Admin,Operator');
Route::put('db_views/userLimited/{user}', [UserController::class, 'updateLimit'])->name('user.updateLimit')->middleware('is.mine.or.allowed:Admin,Operator');
Route::delete('db_views/user/delete/{user}', [UserController::class, 'destroy'])->name('user.delete')->middleware('checkrole:Admin,Operator');

//Profile routes
Route::get('db_views/profile', [ProfileController::class, 'index'])->name('profile.index')->middleware('checkrole:Admin,Operator');
Route::get('db_views/profile/create', [ProfileController::class, 'create'])->name('profile.create')->middleware('checkrole:Admin,Operator');
Route::post('db_views/profile', [ProfileController::class, 'store'])->name('profile.store')->middleware('checkrole:Admin,Operator');
Route::get('db_views/profile/{profile}/edit', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('is.mine.or.allowed:Admin,Operator');
Route::put('db_views/profile/{profile}', [ProfileController::class, 'update'])->name('profile.update')->middleware('is.mine.or.allowed:Admin,Operator');
Route::get('db_views/profile/{profile}', [ProfileController::class, 'show'])->name('profile.show')->middleware('is.mine.or.allowed:Admin,Operator');
Route::delete('db_views/profile/delete/{profile}', [ProfileController::class, 'destroy'])->name('profile.delete')->middleware('checkrole:Admin,Operator');

//Offer routes
// Route::get('db_views/offer', 'OfferController@index')->name('offer.index')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/offer/create', 'OfferController@create')->name('offer.create')->middleware('checkrole:Admin,Operator');
// Route::post('db_views/offer', 'OfferController@store')->name('offer.store')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/offer/{offer}', 'OfferController@show')->name('offer.show')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/offer/{offer}/edit', 'OfferController@edit')->name('offer.edit')->middleware('checkrole:Admin,Operator');
// Route::put('db_views/offer/{offer}', 'OfferController@update')->name('offer.update')->middleware('checkrole:Admin,Operator');
// Route::delete('db_views/offer/delete/{offer}', 'OfferController@destroy')->name('offer.delete')->middleware('checkrole:Admin,Operator');

//Info routes
// Route::get('db_views/info', 'InfoController@index')->name('info.index')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/info/create', 'InfoController@create')->name('info.create')->middleware('checkrole:Admin,Operator');
// Route::post('db_views/info', 'InfoController@store')->name('info.store')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/info/{info}', 'InfoController@show')->name('info.show')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/info/{info}/edit', 'InfoController@edit')->name('info.edit')->middleware('checkrole:Admin,Operator');
// Route::put('db_views/info/{info}', 'InfoController@update')->name('info.update')->middleware('checkrole:Admin,Operator');
// Route::delete('db_views/info/delete/{info}', 'InfoController@destroy')->name('info.delete')->middleware('checkrole:Admin,Operator');

//News routes
// Route::get('db_views/news', 'NewsController@index')->name('news.index')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/news/create', 'NewsController@create')->name('news.create')->middleware('checkrole:Admin,Operator');
// Route::post('db_views/news', 'NewsController@store')->name('news.store')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/news/{news}', 'NewsController@show')->name('news.show')->middleware('checkrole:Admin,Operator');
// Route::get('db_views/news/{news}/edit', 'NewsController@edit')->name('news.edit')->middleware('checkrole:Admin,Operator');
// Route::put('db_views/news/{news}', 'NewsController@update')->name('news.update')->middleware('checkrole:Admin,Operator');
// Route::delete('db_views/news/delete/{news}', 'NewsController@destroy')->name('news.delete')->middleware('checkrole:Admin,Operator');

//Customer routes
Route::get('/getCustomer/{customer}', [CustomerController::class, 'getCustomer'])->name('customer.getCustomer');
Route::get('/getCustomerMeetings/{customer}', [CustomerController::class, 'listMeetings'])->name('customer.listMeetings');
Route::get('db_views/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::post('db_views/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('db_views/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('db_views/customer/{customer}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('db_views/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
Route::get('db_views/customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');
Route::delete('db_views/customer/delete/{customer}', [CustomerController::class, 'destroy'])->name('customer.delete');

//Meetings routes
Route::get('db_views/meeting', [MeetingController::class, 'index'])->name('meeting.index');
Route::post('db_views/meeting', [MeetingController::class, 'store'])->name('meeting.store');
Route::get('db_views/meeting/create', [MeetingController::class, 'create'])->name('meeting.create');
Route::get('db_views/meeting/{meeting}/edit', [MeetingController::class, 'edit'])->name('meeting.edit')->middleware('is.mine.or.allowed:Admin,Operator');
Route::put('db_views/meeting/{meeting}', [MeetingController::class, 'update'])->name('meeting.update')->middleware('is.mine.or.allowed:Admin,Operator');
Route::get('db_views/meeting/{meeting}', [MeetingController::class, 'show'])->name('meeting.show');
Route::delete('db_views/meeting/delete/{meeting}', [MeetingController::class, 'destroy'])->name('meeting.delete');

//Products routes
Route::get('db_views/product', [ProductController::class, 'index'])->name('product.index');
Route::post('db_views/product', [ProductController::class, 'store'])->name('product.store');
Route::get('db_views/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('db_views/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('db_views/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('db_views/product/{product}', [ProductController::class, 'show'])->name('product.show');
Route::delete('db_views/product/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');

//Provider routes
Route::get('/getProvider/{provider}', [ProviderController::class, 'getProvider'])->name('provider.getProvider');
Route::get('db_views/provider', [ProviderController::class, 'index'])->name('provider.index');
Route::post('db_views/provider', [ProviderController::class, 'store'])->name('provider.store');
Route::get('db_views/provider/create', [ProviderController::class, 'create'])->name('provider.create');
Route::get('db_views/provider/{provider}/edit', [ProviderController::class, 'edit'])->name('provider.edit');
Route::put('db_views/provider/{provider}', [ProviderController::class, 'update'])->name('provider.update');
Route::get('db_views/provider/{provider}', [ProviderController::class, 'show'])->name('provider.show');
Route::delete('db_views/provider/delete/{provider}', [ProviderController::class, 'destroy'])->name('provider.delete');

//Lecture routes
Route::get('db_views/lecture', [LectureController::class, 'index'])->name('lecture.index');
Route::post('db_views/lecture', [LectureController::class, 'store'])->name('lecture.store');
Route::get('db_views/lecture/create', [LectureController::class, 'create'])->name('lecture.create');
Route::get('db_views/lecture/{lecture}/edit', [LectureController::class, 'edit'])->name('lecture.edit');
Route::put('db_views/lecture/{lecture}', [LectureController::class, 'update'])->name('lecture.update');
Route::get('db_views/lecture/{lecture}', [LectureController::class, 'show'])->name('lecture.show');
Route::delete('db_views/lecture/delete/{lecture}', [LectureController::class, 'destroy'])->name('lecture.delete');

//------------------------LINKING MODELS---------------------//
//Purchase routes
Route::get('db_views/purchase', [PurchaseController::class, 'index'])->name('purchase.index');
Route::get('db_views/purchase/create', [PurchaseController::class, 'create'])->name('purchase.create');
Route::post('db_views/purchase', [PurchaseController::class, 'store'])->name('purchase.store');
Route::get('db_views/purchase/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchase.edit');
Route::put('db_views/purchase/{purchase}', [PurchaseController::class, 'update'])->name('purchase.update');
Route::get('db_views/purchase/{purchase}', [PurchaseController::class, 'show'])->name('purchase.show');
Route::delete('db_views/purchase/delete/{purchase}', [PurchaseController::class, 'destroy'])->name('purchase.delete');

//Participant routes
Route::get('db_views/participant', [ParticipantController::class, 'index'])->name('participant.index');
Route::get('db_views/participant/create', [ParticipantController::class, 'create'])->name('participant.create');
Route::post('db_views/participant', [ParticipantController::class, 'store'])->name('participant.store');
Route::get('db_views/participant/{participant}/edit', [ParticipantController::class, 'edit'])->name('participant.edit');
Route::put('db_views/participant/{participant}', [ParticipantController::class, 'update'])->name('participant.update');
Route::get('db_views/participant/{participant}', [ParticipantController::class, 'show'])->name('participant.show');
Route::delete('db_views/participant/delete/{participant}', [ParticipantController::class, 'destroy'])->name('participant.delete');


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

// Auth::routes();
