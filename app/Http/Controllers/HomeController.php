<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\Appointment;
use App\Speciality;
use App\Http\Requests;
use Illuminate\Auth\Access\Response;
use App\Patient;

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
    	$appointments = $doctors->appointmnts;
    	return response()->json($appointments);
    }
   

    public function readPatientID(){				//4
    	$id = request()->route("id");
    	$patients = Patient::find($id);
    	return response()->json($patients);
    }
    
    public function readPatients(){				    //5
    	$patients = Patient::all();
    	return response()->json($patients);
    }
    
    public function readAppointments(){				//6
    	$appointments = Appointment::all();
    	return response()->json($appointments);
    }
    
    
    public function readAppointmentsID(){       	//7
    	$id = request()->route("id");
    	$appointments = Appointment::find($id);
    	return response()->json($appointments);
    }
    
    public function readSpecialities(){       		//8
    	$specialities = Speciality::all();
    	return response()->json($specialities);
    }
    
    public function readSpecialityID(){       		//9
    	$id = request()->route("id");
    	$specialities = Speciality::find($id);
    	return response()->json($specialities);
    }
    
    
    //z powiazaniami, jeszcze bez route'ow:
    public function readDoctorsIDSpeciality(){		//10
    	$id = request()->route("id");
    	$doctors = Doctor::find($id);
    	$specialities = $doctors->speciality;
    	return response()->json($specialities);
    }
    
   // HomeController@readPatientsIDAppointment
    public function readPatientsIDAppointment(){		//11
    	$id = request()->route("id");
    	$patient = Patient::find($id);
    	$appointments = $patient->appointments;
    	return response()->json($appointments);
    }
    
    public function readDoctorsIDAppointmentPatient(){		//12
    	$id = request()->route("id");
    	$doctors = Doctor::find($id);
    	$appointments = $doctors->appointmnts;
    	$patient = $appointments->patient;
    	return response()->json($patient);
    }
     
      
    //HomeController@readDoctorsIDAppointmentID
    public function readDoctorsIDAppointmentID(){		//12
    	$id = request()->route("id");
    	$doctors = Doctor::find($id);
    	$appointments = $doctors->appointmnts;
    	$id2 = request()->route("id2");
    	$appointment = Appointment::find($id2);    	
    	return response()->json($appointment);
    }
    
    //HomeController@readDoctorsSpecialityID
    public function readDoctorsSpecialityID(){		//12
    	$id = request()->route("id");
		$specialities = Speciality::find($id);
		$doctors = $specialities->doctors;    	
    	return response()->json($doctors);
    }
    
    //HomeController@readPatientIDAppointmentID
    public function readPatientIDAppointmentID(){		//12
    	$id = request()->route("id");
    	$patients = Patient::find($id);
    	$appointments = $patients->appointmnts;
    	$id2 = request()->route("id2");
    	$appointment = Appointment::find($id2);
    	return response()->json($appointment);
    }
       
    
    //HomeController@deleteAppointment'
      public function deleteAppointment($id){		//4
      	$id = request()->route("id");
      	Appointment::destroy($id);
      //	$appointment = Appointment::find($id);
    	// return response()->json(array('id'=>$id));
      	//return response()->json($appointment);
    }

    
    /*
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


	*/
    
}

