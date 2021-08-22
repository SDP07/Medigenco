<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\location;
use App\Banner;
use App\DoctorClinic;
use App\Hospital;
use App\HospitalDetail;
use App\Ambulance;
use App\AmbulanceDetail;
use App\Diagnostic;
use App\DiagnosticDetail;
use App\Appointment;
use Carbon\carbon;
use App\Doctor;
use App\Clinic;
use App\Page;
class AppController extends Controller
{
    //
    /**
     * Send Otp To The Number To Be Registered.
     *
     * @return OTP and Succes Message
     */
    public function RegAccounts(Request $request){
       $mobile =$request->mobile;
       if(empty($mobile)){
        return response()->json(['status'=>'no number','message'=>'No mobile number provided']);
       }
       $user = \DB::SELECT('SELECT * FROM users WHERE phone Like '.(int)$mobile.'');
       if(count($user)>0){
        return response()->json(['status'=>false,'message'=>'Mobile Number Already Exist']);
       }else{
          $otp = (string)mt_rand(111111,999999);
       if(strlen($otp)<6){
          $otp = (string)mt_rand(111111,999999);
       }
          $apiKey = '9a8c8e35-913e-456d-ac5f-a738ee4f4d6a';
          $message = 'Your OTP for Medigenco is '.$otp;
          $data = array('username' => 'happygrocery','smstype'=>'TRANS', 'numbers' => $mobile, "sendername" => 'HPYGCY', "message" => $message,'apikey'=>$apiKey);
 
        // Send the POST request with cURL
        $ch = curl_init('http://sms.bulksmsind.in/sendSMS');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
          return response()->json(['status' => true,'message'=>'Account has been created','otp'=>$otp]);
       }
    }
     //
    /**
     * Registered User user_id.
     *
     * @return user_id and Succes Message
     */

    public function personalDetails(Request $request){
      $name = $request->name;
      if(empty($name)){
        return response()->json(['status'=>false,'message'=>'No name found']);
      }
      $dev_key = $request->dev_key;
      if(empty($dev_key)){
        return response()->json(['status'=>false,'message'=>'No Device Key found']);
      }
      $mobile = $request->mobile;
      if(empty($mobile)){
        return response()->json(['status'=>false,'message'=>'No Mobile Number found']);
      }
      $email = $request->email;
    $userEmail = User::where('phone','Like',$mobile)->get();
    if(count($userEmail)>0){
      return response()->json(['status'=>false,'message'=>'Mobile Number Already Exist']);
    }

      $address = $request->address;
      $postal_code = $request->postal_code;
      $city = $request->city;
      $country = $request->country;
      
      $password = $request->password;
      if(empty($password)){
        return response()->json(['status'=>false,'message'=>'must enter Password']);
      }
      else if(strlen($password)<6){
        return response()->json(['status'=>false,'message'=>'Password must be 6 character long']);
      }
      $encryptedPass = password_hash($password,PASSWORD_DEFAULT);
      User::create(['name'=>$name,'user_type'=>7,'email'=>$email,'dev_key'=>$dev_key,'password'=>$encryptedPass,'phone'=>$mobile,'otp'=>'5468125','address'=>$address,'postal_code'=>$postal_code,'city'=>$city,'country'=>$country]);
      $user = \DB::SELECT('SELECT * FROM users WHERE phone Like '.$mobile.'');
    $user_id = User::Where('phone','Like',$mobile)->first();
      if(count($user)>0){
        return response()->json(['status'=>true,'message'=>'Thanks for providing Information','user_id'=>$user_id->id]);
      }
      else{
        return response()->json(['status'=>false]);
      }
    }

    //
    /**
     * Log User In.
     *
     * @return user_id and Succes Message
     */

    public function appLogin(Request $request){
      $mobile = $request->mobile;
      if(empty($mobile)){
        return response()->json(['status'=>'Fill the mobile Number']);
      }
      $dev_key = $request->dev_key;
      $password = $request->password;
      if(empty($password)){
        return response()->json(['status'=>'Fill the Password']);
      }
      $encryptedPass = password_hash($password,PASSWORD_DEFAULT);
      if(count(User::Where('phone','Like',$mobile)->get()) < 1){
        return response()->json(['status'=>false,'message'=>'Check Your Crientials']);
      }

      $cridential = User::Where('phone','Like',$mobile)->first();

  

      if(password_verify($password, $cridential->password) and $mobile == $cridential->phone){
        User::where('phone', 'Like',$mobile)->Update(['dev_key'=>$dev_key]);
        return response()->json(['status'=>true,'name'=>$cridential->name,'email'=>$cridential->email,'mobile'=>$cridential->phone,'user_id'=>$cridential->id]);
      }
      else{
        return response()->json(['status'=>false,'message'=>'Wrong Password']);
      }

    }

     //
    /**
     * Forgot Password.
     *
     * @return New Password (OTP)
     */


    public function forgotPassword(Request $req){

        $phone = $req->phone;
        if(empty($phone)){
            return response()->json(array('status'=>false,'message'=>'Phone Number Field Can Not Be Left Blank'));
        }
        $select = User::where('phone','Like',$phone)->first();
        // $select->execute([$username]);
        if(count(User::where('phone','Like',$phone)->get())>0){
            $id = $select->id;                    
            $otp = (string)mt_rand(111111,999999);
            User::where('phone','Like',$phone)->update(['password'=>password_hash($otp,PASSWORD_DEFAULT)]);
            $apiKey = '9a8c8e35-913e-456d-ac5f-a738ee4f4d6a';
            $message = 'Your OTP for Medigenco is '.$otp . ". It Is Also Your Current Password";
            $data = array('username' => 'happygrocery','smstype'=>'TRANS', 'numbers' => $phone, "sendername" => 'HPYGCY', "message" => $message,'apikey'=>$apiKey);
   
            // Send the POST request with cURL
            $ch = curl_init('http://sms.bulksmsind.in/sendSMS');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            return response()->json(['status'=>true,'message'=>'A otp has been to your mobile '.$phone,'otp'=>$otp]);
            
        }else{
             return response()->json(array('status'=>false,'message'=>'No account binded with this email ID!'));
        }
    }

    public function confirmPassword(Request $req){
      $id = $req->user_id;
      if(empty($id)){
        return response()->json(['status'=>false,'message'=>'Empty Id']);
      }
      if(count(User::where('id','=',$id)->get())>0){
        $password = $req->password;
        if(empty($password)){
        return response()->json(['status'=>false,'message'=>'must enter Password']);
      }
      else if(strlen($password)<6){
        return response()->json(['status'=>false,'message'=>'Password must be 6 character long']);
      }
        $oldPassword = $req->oldPassword;
        if(empty($oldPassword)){
          return response()->json(['status'=>false,'message'=>'must enter old Password']);
        }
     $oldcred = User::where('id','=',$id)->first();
    if(password_verify($oldPassword, $oldcred->password)){
        $encryptedPass = password_hash($password,PASSWORD_DEFAULT);
        $user = User::where('id','=',$id);
        if($user->update(['password'=>$encryptedPass])){
           return response()->json(['status'=>true,'message'=>'password changed successfully']);
        }
        else{
           return response()->json(['status'=>false,'message'=>'Oops! Something Went Wrong']);
        }
      }
    else{
      return response()->json(['status'=>false,'message'=>'Oops! Something Went Wrong']);
    }
    }
      else{
        return response()->json(['status'=>false,'message'=>'Invalid ID']);
      }
    }

    public function updateProfile(Request $req){
    $user_id = $req->user_id;
    $user = User::findOrFail($user_id);
    if($req->has('email')){
     
      $user->email = $req->email;
    }
    if($req->has('password')){
      $user->password = password_hash($req->password,PASSWORD_DEFAULT);
    }
    if($req->has('address')){
      $user->address = $req->address;
    }
    if($req->has('postal_code')){
      $user->postal_code = $req->postal_code;
    }

     if($req->has('alternate_no')){
      $user->alternate_no = $req->alternate_no;
    }
    
     if($req->has('city')){
      $user->city = $req->city;
    }

    if($user->save()){
      return response()->json(['status'=>true,'message'=>'Profile Updated']);
    }
    else{
      return response()->json(['status'=>false,'message'=>'Oops! Something Went Wrong']);
    }


  } 


  public function SetLocation(Request $request){
    $user_id =  $request->user_id;
     if(empty($user_id)){
        return response()->json(['status'=>false,'message'=>'must enter User ID']);
      }
    $location_id = $request->location_id;
     if(empty($location_id)){
        return response()->json(['status'=>false,'message'=>'must enter Location']);
      }
    $user = User::findOrFail($user_id);
    $user->location_id = $location_id;
    if($user->save()){
      return response()->json(['status'=>true,'message'=>'Location Updated successfully']);
    }
    else{
      return response()->json(['status'=>false,'message'=>'Oops! Something Went Wrong']);
    }
  }

  public function Dashboard($user_id){
    $banner = Banner::all();
    $user_location = \DB::SELECT("SELECT locations.id,locations.name from locations,users where locations.id = users.location_id and users.id = ".$user_id." ");
    $location = Location::all();

    return response()->json(['status'=>true,'message'=>"User Data",'banner'=>$banner,'userLocaiton'=>$user_location,'location'=>$location]);

  }
  public function Doctors($user_id){
    $doctors = \DB::SELECT("SELECT GROUP_CONCAT(DISTINCT(clinics.clinic_name)) as clinic_name,clinics.id as clinic_id,GROUP_CONCAT(doctors.Name) as doctor_name,GROUP_CONCAT(doctors.qualification) as doctor_qualification,GROUP_CONCAT(doctors.id) as doctor_id,GROUP_CONCAT(DISTINCT(doctors.special_id)) as special_id,GROUP_CONCAT(DISTINCT(doctor_specializations.name)) as specialization FROM `doctors`,doctor_specializations,clinics,users,doctor_clinics where users.location_id = clinics.location_id and doctors.location_id = users.location_id and clinics.id = doctor_clinics.clinic_id and users.id = ".$user_id." and doctor_specializations.id = doctors.special_id and doctor_clinics.doctor_id = doctors.id  group by clinics.location_id");

    if(count($doctors)>0){
      return response()->json(['status'=>true,'message'=>"Here Are The Details",'doctors'=>$doctors]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }
  }

  public function doctorDetails($doctor_id,$clinic_id){
    $doctorsDet = \DB::SELECT("SELECT doctors.id as doctor_id,doctors.name as doctor_name,doctor_specializations.id as special_id,doctor_specializations.name as special_name,doctors.qualification FROM doctors,doctor_specializations Where doctors.id = ".$doctor_id." and doctor_specializations.id = doctors.special_id ");
    $clinic_details = \DB::SELECT("SELECT doctor_clinics.*,clinics.clinic_name,clinics.clinic_address,clinics.clinic_phone,clinics.clinic_email FROM doctor_clinics,clinics where doctor_clinics.doctor_id = ".$doctor_id." and clinics.id = ".$clinic_id." and doctor_clinics.clinic_id = clinics.id");
    if(count($doctorsDet)>0){
      return response()->json(['status'=>true,'DoctorDetails'=>$doctorsDet,'clinicDetails'=>$clinic_details]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }
  }

  public function Hospital($user_id){
    $hospital = \DB::SELECT("SELECT hospitals.* FROM hospitals,users where users.location_id = hospitals.location_id and users.id = ".$user_id." ");

    if(count($hospital)>0){
      return response()->json(['status'=>true,'hospitals'=>$hospital]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }
  }

  public function HospitalDetails($hospital_id){
    $hospital = Hospital::where('id',$hospital_id)->first();
    $details = HospitalDetail::where('hospital_id',$hospital_id)->get();
    if(count($details)>0){
      return response()->json(['status'=>true,'hospitals'=>$hospital,'hospitalDetail'=>$details]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }
  }
  
  public function Ambulance($user_id){
    $ambulance = Ambulance::join('users','users.location_id','=','ambulances.location_id')
                ->where('users.id',$user_id)
                ->Select('ambulances.*')
                ->get();
    if(count($ambulance)>0){
      return response()->json(['status'=>True,'ambulance'=>$ambulance]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }
  }

  public function AmbulanceDetail($ambulance_id){
    $ambulance = Ambulance::where('id',$ambulance_id)->get();
    $details = AmbulanceDetail::where('ambulance_id',$ambulance_id)->get();

    if(count($ambulance)>0){
      return response()->json(['status'=>True,'ambulance'=>$ambulance,'details'=>$details]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }

  }

  public function Diagnostic($user_id){
    $diagnostics = Diagnostic::join('users','users.location_id','=','diagnostics.location_id')
                ->where('users.id',$user_id)
                ->Select('diagnostics.*')
                ->get();
    if(count($diagnostics)>0){
      return response()->json(['status'=>True,'diagnostic'=>$diagnostics]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }
  }

  public function DiagnosticDetail($diagnostic_id){
    $diagnostic = Diagnostic::where('id',$diagnostic_id)->get();
    $details = DiagnosticDetail::where('diagnostic_id',$diagnostic_id)->get();

    if(count($diagnostic)>0){
      return response()->json(['status'=>True,'diagnostic'=>$diagnostic,'details'=>$details]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Oops!Something Went Wrong"]);
    }

  }
  
   public function Appointments(Request $req){
    $appointment =  new Appointment;
    $appointment->user_id = $req->user_id;
    
    $codes = \DB::SELECT("SELECT MAX(id) as Code FROM appointments");
    $newCode = 0;
    foreach ($codes as $code) {
        $cutcode = (int)$code->Code+1;
        if($cutcode < 10){
          $newCode = 'MEDI000' . $cutcode . '/2020-21';
          }
        elseif($cutcode>9 and $cutcode<99){
          $newCode = 'MEDI00' . $cutcode . '/2020-21';
        }
        elseif($cutcode>99 and $cutcode<999 ){
          $newCode = 'MEDI0' . $cutcode . '/2020-21';
        }
      elseif($cutcode>999){
          $newCode = 'MEDI' . $cutcode . '/2020-21';
      }
          
    }

    $appointment->code = $newCode;
    $appointment->type_id = $req->type_id;
    $appointment->type = $req->type;

    if(empty($req->clinic_id)){
      $appointment->clinic_id = null;
    }

    else{
      $appointment->clinic_id = $req->clinic_id;
    }

    if(empty($req->home_collection)){
      $appointment->home_collection = 0;
    }

    else{
      $appointment->home_collection = $req->home_collection;
    }

     if(empty($req->address)){
      $appointment->address = null;
    }

    else{
      $appointment->address = $req->address;
    }

    if(empty($req->bed_id)){
      $appointment->address = 0;
    }

    else{
      $appointment->bed_id = $req->bed_id;
    }

    if(empty($req->car_no)){
      $appointment->address = null;
    }

    else{
      $appointment->car_no = $req->car_no;
    }


    $appointment->date =  Carbon::parse($req->input('date'))->format('Y-m-d');
    $appointment->time =  Carbon::parse($req->input('time'))->format('h:i a');

    if($appointment->save()){
      return response()->json(['status'=>true,'message'=>"Appontment is saved"]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"Opps! Mistake"]);
    }

  }

  public function showAppointments($user_id){
    $appointments = Appointment::where('user_id',$user_id)->orderBy('id','desc')->get();
    $appoint = [];
    foreach ($appointments as $appointment) {
      if($appointment->type == 'doctors'){

       $doctor = Doctor::where('id',$appointment->type_id)->first();
       $clinic = Clinic::where('id',$appointment->clinic_id)->first();
       $appoin = new \stdClass();
       $appoin->code =  $appointment->code;
       $appoin->app_id = $doctor->id;
       $appoin->type = $appointment->type;
       $appoin->name = $doctor->Name;
       $appoin->shop_id = $clinic->id;
       $appoin->shop_name = $clinic->clinic_name;
       $appoin->date = $appointment->date;
       $appoin->time = $appointment->time;
       $appoin->approve = $appointment->approve;
       $appoin->created_at = $appointment->created_at;
       array_push($appoint,$appoin);
      }

      else if($appointment->type == 'diagnostics'){
        $diagnostic = Diagnostic::where('id',$appointment->type_id)->first();
        $appoin = new \stdClass();
        $appoin->code = $appointment->code;
        $appoin->app_id = $diagnostic->id;
        $appoin->shop_name = $diagnostic->shop_name;
        $appoin->type = $appointment->type;
        $appoin->phone = $diagnostic->phone;
        $appoin->date = $appointment->date;
        $appoin->time = $appointment->time;
        $appoin->approve = $appointment->approve;
        $appoin->home_collection = $appointment->home_collection;
        $appoin->address = $appointment->address;
        $appoin->created_at = $appointment->created_at;
        array_push($appoint,$appoin);
      }
      else if($appointment->type == 'hospitals'){
        $hospital = Hospital::where('id',$appointment->type_id)->first();
        $det = HospitalDetail::where('id',$appointment->bed_id)->first();
        $appoin = new \stdClass();
        $appoin->code = $appointment->code;
        $appoin->app_id = $hospital->id;
        $appoin->shop_name = $hospital->hospital_name;
        $appoin->type = $appointment->type;
        $appoin->bed_type = $det->bed_type;
        $appoin->phone = $det->phone;
        $appoin->date = $appointment->date;
        $appoin->time = $appointment->time;
        $appoin->approve = $appointment->approve;
        $appoin->created_at = $appointment->created_at;
        array_push($appoint,$appoin);
      }
      else if($appointment->type == 'ambulances'){
        $ambulance = Ambulance::where('id',$appointment->type_id)->first();
        $det = AmbulanceDetail::where('car_no',$appointment->car_no)->first();
        $appoin = new \stdClass();
        $appoin->code = $appointment->code;
        $appoin->app_id = $ambulance->id;
        $appoin->shop_name = $ambulance->com_name;
        $appoin->phone = $ambulance->com_phone;
        $appoin->car_no = $appointment->car_no;
        $appoin->type = $appointment->type;
        $appoin->date = $appointment->date;
        $appoin->time = $appointment->time;
        $appoin->approve = $appointment->approve;
        $appoin->created_at = $appointment->created_at;
        array_push($appoint,$appoin);
      }
    }

    if(count($appointments)> 0){
      return response()->json(['status'=>true,'appointment'=>$appoint]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"No appointments found"]);
    }
  }

  public function about_us(){
    $page = Page::first();

    if(($page) != null){
      return response()->json(['status'=>true,'page'=>$page]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"No appointments found"]);
    }

  }

  public function contact_us(){
    $page = Page::where('id',2)->first();

    if(($page) != null){
      return response()->json(['status'=>true,'page'=>$page]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"No appointments found"]);
    }
  }

  public function privacyPolicy(){
    $page = Page::where('id',3)->first();

    if(($page) != null){
      return response()->json(['status'=>true,'page'=>$page]);
    }
    else{
      return response()->json(['status'=>false,'message'=>"No appointments found"]);
    }
  }

}
