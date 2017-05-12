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



Route::get('doctor', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctors'));    //1
Route::get('patient', array('as' => 'patient.get', 'uses' => 'HomeController@readPatients'));  //5
Route::get('speciality', array('as' => 'speciality.get', 'uses' => 'HomeController@readSpecialities')); //8
Route::get('appointment', array('as' => 'appointment.get', 'uses' => 'HomeController@readAppointments')); //6



Route::get('doctor/{id?}', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctorsID'));  //2
Route::get('patient/{id?}', array('as' => 'patient.get', 'uses' => 'HomeController@readPatientID'));	//4
Route::get('appointment/{id?}', array('as' => 'appointment.get', 'uses' => 'HomeController@readAppointmentsID')); //7
Route::get('speciality/{id?}', array('as' => 'speciality.get', 'uses' => 'HomeController@readSpecialityID')); //9



Route::get('doctor/{id?}/appointment', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctorsIDAppointment'));
Route::get('doctor/{id?}/appointment/{id2?}', array('as' => 'doctor.get', 'uses' => 'HomeController@readDoctorsIDAppointmentID'));
Route::get('doctor/speciality/{id?}', array('as' => 'speciality.get', 'uses' => 'HomeController@readDoctorsSpecialityID'));
Route::get('patient/{id?}/appointment', array('as' => 'patient.get', 'uses' => 'HomeController@readPatientsIDAppointment'));
Route::get('patient/{id?}/appointment/{id2?}', array('as' => 'patient.get', 'uses' => 'HomeController@readPatientIDAppointmentID'));
Route::delete('appointment/{id?}/delete}', array('as' => 'appointment.delete', 'uses' => 'HomeController@deleteAppointment'));


Route::resource('doctor','HomeController');
Route::resource('appointment','HomeController');
Route::resource('patient','HomeController');
Route::resource('speciality','HomeController');

Route::post('doctor/create', array('as' => 'doctor.create', 'uses' => 'HomeController@postDoctors'));



// Route::set('doctor/{id?}', array('as' => 'doctor.set', 'uses' => 'HomeController@readDoctors')); 
