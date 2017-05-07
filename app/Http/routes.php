<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index')); // mapowanie do sciezki naszego adresu 
// oute::get('doctor/{id?}', array('as' => 'doctor.get', 'uses' => 'DoctorController@show'));



Route::get('doctor', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctors'));
Route::get('doctor/{id?}', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctorsID'));
Route::get('doctor/{id?}/appointment', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctorsIDAppointment'));

Route::post('doctor/create', array('as' => 'doctor.create', 'uses' => 'HomeController@postDoctors'));



/* Route::set('doctor/{id?}', array('as' => 'doctor.set', 'uses' => 'HomeController@readDoctors'));


