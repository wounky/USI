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
      	$appointment = Appointment::find($id);
    	 return response()->json(array('id'=>$id));
      	}

    

    public function postDoctors(){
		
		$data = request()->all();
		
		$speciality_id = array_get($data, "speciality_id");
		$speciality = Speciality::find($speciality_id);
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
    
//*************************************************************

    public function create(Request $request)
    {
    	// $data = $request->json()->all();
    	$appointmentReq = $request->json()->all();
    	$appointment = Appointment::create(array(
    			'DOCTOR_id' => $appointmentReq['doctor_id'],
    			'PATIENT_id' => $appointmentReq['patient_id'],
    			'date' => $appointmentReq['date'],
    			'duration' => $appointmentReq['duration']
    	));
    	return \Response::json(array(
    			'id' => $appointment->id
    	));
    }
    
    public function edit($appointment_id, Request $request)
    {
    	$appointmentReq = $request->json()->all();
    	$appointment = Appointment::findOrFail($appointment_id);
    	if(isset($appointmentReq['doctor_id'])) {
    		$appointment->DOCTOR_id = $appointmentReq['doctor_id'];
    	}
    	if(isset($appointmentReq['patient_id'])){
    		$appointment->PATIENT_id = $appointmentReq['patient_id'];
    	}
    	if(isset($appointmentReq['date'])){
    		$appointment->date = $appointmentReq['date'];
    	}
    	if(isset($appointmentReq['duration'])){
    		$appointment->duration = $appointmentReq['duration'];
    	}
    	$appointment->save();
    	return \Response::json($appointment);
    }
    
    public function destroy($appointment_id)
    {
    	$appointment = Appointment::find($appointment_id);
    	if($appointment != null){
    		$appointment->delete();
    		return \Response::json(array(
    				'id' => $appointment_id
    		));
    	}
    	return \Response::json($appointment);
    }
    
    public function create(Request $request)
    {
    	// $data = $request->json()->all();
    	$doctorReq = $request->json()->all();
    	$doctor = Doctor::create(array(
    			'SPECIALITY_id' => $doctorReq['speciality_id'],
    			'first_name' => $doctorReq['first_name'],
    			'last_name' => $doctorReq['last_name'],
    			'phone' => $doctorReq['phone'],
    			'gender' => $doctorReq['gender'],
    			'birthday' => $doctorReq['birthday'],
    			'email' => $doctorReq['email'],
    			'room' => $doctorReq['room']
    	));
    	return \Response::json(array(
    			'id' => $doctor->id
    	));}
    	
    	public function edit($doctor_id, Request $request)
    	{
    		$doctorReq = $request->json()->all();
    		$doctor = Doctor::findOrFail($doctor_id);
    		if(isset($doctorReq['speciality_id'])) {
    			$doctor->SPECIALITY_id = $doctorReq['speciality_id'];
    		}
    		if(isset($doctorReq['first_name'])){
    			$doctor->first_name = $doctorReq['first_name'];
    		}
    		if(isset($doctorReq['last_name'])){
    			$doctor->last_name = $doctorReq['last_name'];
    		}
    		if(isset($doctorReq['phone'])){
    			$doctor->phone = $doctorReq['phone'];
    		}
    		if(isset($doctorReq['gender'])){
    			$doctor->gender = $doctorReq['gender'];
    		}
    		if(isset($doctorReq['birthday'])){
    			$doctor->birthday = $doctorReq['birthday'];
    		}
    		if(isset($doctorReq['email'])){
    			$doctor->email = $doctorReq['email'];
    		}
    		if(isset($doctorReq['room'])){
    			$doctor->room = $doctorReq['room'];
    		}
    		$doctor->save();
    		return \Response::json($doctor);
    	}
    	
    	public function destroy($doctor_id)
    	{
    		$doctor = Doctor::find($doctor_id);
    		if($doctor != null){
    			$doctor->a_p_p_o_i_n_t_m_e_n_t_s()->delete();
    			$doctor->delete();
    			return \Response::json(array(
    					'id' => $doctor_id
    			));
    		}
    		return \Response::json($doctor);
    	}
    	
    	public function create(Request $request)
    	{
    		// $data = $request->json()->all();
    		$patientReq = $request->json()->all();
    		$patient = Patient::create(array(
    				'first_name' => $patientReq['first_name'],
    				'last_name' => $patientReq['last_name'],
    				'phone' => $patientReq['phone'],
    				'gender' => $patientReq['gender'],
    				'birthday' => $patientReq['birthday'],
    				'email' => $patientReq['email']
    		));
    		return \Response::json(array(
    				'id' => $patient->id
    		));
    	}
    
    
    	public function edit($patient_id, Request $request)
    	{
    		$patientReq = $request->json()->all();
    		$patient = Patient::findOrFail($patient_id);
    		if(isset($patientReq['first_name'])){
    			$patient->first_name = $patientReq['first_name'];
    		}
    		if(isset($patientReq['last_name'])){
    			$patient->last_name = $patientReq['last_name'];
    		}
    		if(isset($patientReq['phone'])){
    			$patient->phone = $patientReq['phone'];
    		}
    		if(isset($patientReq['gender'])){
    			$patient->gender = $patientReq['gender'];
    		}
    		if(isset($patientReq['birthday'])){
    			$patient->birthday = $patientReq['birthday'];
    		}
    		if(isset($patientReq['email'])){
    			$patient->email = $patientReq['email'];
    		}
    		$patient->save();
    		return \Response::json($patient);
    	}
    
    	public function destroy($patient_id)
    	{
    		$patient = Patient::find($patient_id);
    		if($patient != null){
    			$patient->a_p_p_o_i_n_t_m_e_n_t_s()->delete();
    			$patient->delete();
    			return \Response::json(array(
    					'id' => $patient_id
    			));
    		}
    		return \Response::json($patient);
    	}
    	
    	public function showAppointmentByDateOrSpeciality($patient_id, Request $request)
    	{
    		if(isSet($request['date'])){
    			$patientAppointments = Appointment::where('PATIENT_id', '=', $patient_id)->whereDate('date', '=', $request['date'])->get();
    			return \Response::json($patientAppointments);
    		}
    		if(isSet($request['speciality_id'])){
    			$speciality_id = $request['speciality_id'];
    			$patientAppointments = Appointment::where('PATIENT_id', '=', $patient_id)->join('DOCTOR', function($join)  use ($speciality_id)
    			{
    				$join->on('APPOINTMENT.DOCTOR_id', '=', 'DOCTOR.id')
    				->where('DOCTOR.SPECIALITY_id', '=', $speciality_id);
    			})->get(array('APPOINTMENT.*'));
    			return \Response::json($patientAppointments);
    		}
    		return \Response::json();
    	}
}

