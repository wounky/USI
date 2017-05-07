<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
Use App\Speciality;
use App\Http\Requests;
use Illuminate\Auth\Access\Response;

class HomeController extends Controller
{
    //
    public function index(){
        return view("welcome");
    }
    
    public function readDoctors(){					//1
    	$doctors = Doctor::all();
    	return response()->json($doctors);
    }
    
    public function readDoctorsID(){				//2
    	$id = request()->route("id");
    	$doctors = Doctor::find($id);
    	return response()->json($doctors);
    }
    
    public function readDoctorsIDAppointment(){		//3
    	$id = request()->route("id");
    	$doctors = Doctor::find($id);
    	$appointments = $doctors->appointments;
    	return response()->json($appointments);
    }
    
   /* public function deletePatient($patient_id){		//4
    	Patient::destroy($patient_id);
    	return response()->json(array)
    }*/
    
    
    
    public function postDoctors(){
		
		$data = request()->all();
		
		$speciality_id = array_get($data, "speciality_id");
		$speciality = Speciality::find($speciality_id);
		
		// return response()->json($speciality);
		
		$doctor = new Doctor();
		$doctor->first_name = array_get($data,"first_name");	
		$doctor->last_name = array_get($data,"last_name");
		$doctor->phone = array_get($data,"phone");
		$doctor->gender = array_get($data,"gender");
		$doctor->birthday = array_get($data,"birthday");
		$doctor->email = array_get($data,"email");	
		$doctor->room = array_get($data,"room");	
		
		$doctor->speciality->attach($speciality_id);
		
		$doctor->save();
		
		
		
		
    	return response()->json(["id"=> $doctor->id]);
    }

    
}

