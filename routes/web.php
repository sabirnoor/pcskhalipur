<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/ada', function () {
    return view('welcome');
});

Route::get('/', 'DashboardController@index');
Route::get('/about', 'DashboardController@about');
Route::get('/our-motto', 'DashboardController@ourmotto');
Route::get('/directors-desk', 'DashboardController@directorsdesk');
Route::get('/events', 'DashboardController@events');
Route::get('/news-paper', 'DashboardController@newspaper');
Route::get('/academics', 'DashboardController@academics');
Route::get('/school-profile', 'DashboardController@schoolprofile');
Route::get('/franchise-enquiry', 'DashboardController@franchiseenquiry');
Route::get('/downloads', 'DashboardController@downloads');
Route::get('/mandatory-disclosure', 'DashboardController@mandatorydisclosure');
Route::get('/Syllabus', 'DashboardController@Syllabus');
Route::get('/result', 'DashboardController@result');
Route::get('/contact', 'DashboardController@contact');
Route::get('/photo-gallery', 'DashboardController@photogallery');
//Route::post('/photo-gallery-detail', 'DashboardController@photogallerydetail');
Route::match(['get', 'post'],'/photo-gallery-detail', array('uses' => 'DashboardController@photogallerydetail'));
Route::get('/principal-desk', 'DashboardController@principaldesk');
Route::match(['get', 'post'],'/feedback', array('uses' => 'DashboardController@feedback'));
Route::match(['get', 'post'],'/feedbackform', array('uses' => 'DashboardController@feedbackform'));
Route::match(['get', 'post'],'/di2/{id?}', array('uses' => 'DashboardController@di2'));

//Quiz(Online Exam) Section
Route::match(['get', 'post'],'/din/{link?}', array('uses' => 'DashboardController@quizinvitation'));
Route::match(['get', 'post'],'/startquiz', array('uses' => 'DashboardController@startquiz'));
Route::match(['get', 'post'],'/quiz', array('uses' => 'DashboardController@playquiz'));
Route::match(['get', 'post'],'/quiz-result', array('uses' => 'DashboardController@showquizresult'));
Route::match(['get', 'post'],'/jump-question/{ques_no?}', array('uses' => 'DashboardController@jumpquestion'));
Route::match(['get', 'post'],'/answersheet', array('uses' => 'DashboardController@answersheet'));
//Route::get('/logout', 'DashboardController@logout');

/*
|--------------------------------------------------------------------------
| API Routing
| Md Sabir
| Created 16/12/2017
|--------------------------------------------------------------------------
*/
Route::match(['get', 'post'],'/OneApi', array('uses' => 'ApiController@index'));
Route::match(['get', 'post'],'/OneApi/bussearch', array('uses' => 'ApiController@bussearch'));


Route::get('/payment-initiate',function(){
    return view('payment/payment-initiate');
});

Route::post('/payment-initiate-request','PaymentController@Initiate');
Route::match(['get', 'post'],'/payment-complete','PaymentController@Complete');

//Admission Form
Route::match(['get', 'post'],'/admission', array('uses' => 'DashboardController@admissionform'));
Route::match(['get', 'post'],'/admission-success/{id?}', array('uses' => 'DashboardController@admissionsuccess'));

Route::get('/term-cond', 'DashboardController@termandcondition');
Route::get('/privacy-policy', 'DashboardController@privacypolicy');
Route::get('/refund-policy', 'DashboardController@refundpolicy');


Route::get('/crownjob', 'DashboardController@crownjob');
