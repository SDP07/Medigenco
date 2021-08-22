<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doctor;
use App\DoctorClinic;
use App\Location;
use App\Specialization;
use App\User;
use App\Clinic;
use Carbon\carbon;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $doctors =Doctor::where('user_id','<>',0)->get();
        return view('admin.doctor.index',compact('doctors'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $locations = Location::all();
        $specs = Specialization::all();
        return view('admin.doctor.create',compact('locations','specs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = new User;
        $user->user_type = 3; 
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->perAddress;
        $user->country = 'India';
        $user->password = password_hash($request->password,PASSWORD_DEFAULT);
        $user->city = $request->city;
        $user->postal_code = $request->postal;
        $user->verified = 1;
        if(empty($request->email)){
            $user->email = null;
        }
        else{
            $user->email = $request->email;
        }
        $user->location_id = $request->location_id;

        if($user->save()){
            $doctor = new Doctor;
            $doctor->special_id = $request->special_id;
            $doctor->Name = $request->name;
            $doctor->qualification = $request->qualification;
            $doctor->location_id = $request->location_id;
            $doctor->user_id = $user->id;
            if($doctor->save()){
                $clinic = new Clinic;
                $clinic->user_id = $user->id;
                $clinic->clinic_name = $request->dispensary;
                $clinic->clinic_address = $request->cliAddress;
                $clinic->location_id = $request->location_id;
                $clinic->clinic_phone = $request->clinPhone;
                $clinic->clinic_alternate = $request->alternate;
                if($clinic->save()){
                    flash(translate('Doctor Details Saved'))->success();
                    return redirect()->route('doctors.index');
                }
                else{
                    flash(translate('Something Went Wrong'))->error();
                    return back();
                }
            }
            else{
            flash(translate('Something Went Wrong'))->error();
            return back();
            }

        }
        else{
            flash(translate('Something Went Wrong'))->error();
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $doctor = Doctor::findOrFail(decrypt($id));
        return view('admin.doctor.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $doctor = Doctor::findOrFail($id);
        $doctor->special_id = $request->special_id;
        $doctor->Name = $request->name;
        $doctor->qualification = $request->qualification;
        $doctor->location_id = $request->location_id;
        if($doctor->save()){
            $clinic = Clinic::where('user_id',$doctor->user_id)->first();
            $clinic->clinic_name = $request->dispensary;
            $clinic->clinic_address = $request->cliAddress;
            $clinic->location_id = $request->location_id;
            $clinic->clinic_phone = $request->clinPhone;
            $clinic->clinic_alternate = $request->alternate;
            if($clinic->save()){
                $user = User::where('id',$doctor->user_id)->first();
                $user->name = $request->name;
                $user->phone = $request->phone;
                $user->address = $request->perAddress;
                $user->country = 'India';
                $user->city = $request->city;
                $user->postal_code = $request->postal;
                $user->verified = 1;
                if(empty($request->email)){
                    $user->email = null;
                }
                else{
                    $user->email = $request->email;
                }
                $user->location_id = $request->location_id;

                if($user->save()){
                    flash(translate('Doctor Details Updated'))->success();
                    return redirect()->route('doctors.index');
                }
                else{
                    flash(translate('Something Went Wrong'))->error();
                    return back();
                }
            }
            else{
                flash(translate('Something Went Wrong'))->error();
                return back();
            }
        }
        else{
        flash(translate('Something Went Wrong'))->error();
        return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function Details(Request $request){
        $id = null;
        $id = $request->id;
        $doctorData = \DB::SELECT("SELECT doctor_clinics.id as main_id ,doctors.id as doctor_id , doctors.Name as name,clinics.id as clinic_id,clinics.clinic_name,doctor_clinics.fees,doctor_clinics.day,doctor_clinics.start,doctor_clinics.end,doctor_clinics.discount FROM `doctor_clinics`,doctors,clinics where doctors.id = doctor_clinics.doctor_id and clinics.id = doctor_clinics.clinic_id and doctor_clinics.doctor_id = ".$id." ");
        return response()->json(['doctorClinic'=>$doctorData]);
    }

    public function ClinicIndex(){
        $doctorClinic = \DB::SELECT("SELECT doctor_clinics.id as main_id ,(doctors.id) as doctor_id , (doctors.Name) as name,clinics.id as clinic_id,clinics.clinic_name,(doctor_clinics.fees) as fees,(doctor_clinics.day) as day,(doctor_clinics.start) as startDate,(doctor_clinics.end) as EndDate,(doctor_clinics.discount) as Discount FROM `doctor_clinics`,doctors,clinics where doctors.id = doctor_clinics.doctor_id and clinics.id = doctor_clinics.clinic_id and doctors.user_id <> 0 ");
        return view('admin.doctor.timingIndex',compact('doctorClinic'));
    }

    public function ClinicCreate(){
        return view('admin.doctor.createTiming');
    }

    public function ClinicSave(Request $request){
        $doctor_id = $request->doctor_id;
        $clinic_id = $request->clinic_id;
        $day = $request->day;
        $start = $request->start;
        $end = $request->end;
        $price =  $request->price;
        $discount = $request->discount;

        $doctor = new DoctorClinic;
        $doctor->doctor_id = $request->doctor_id;
        $doctor->clinic_id = $request->clinic_id;
        $doctor->fees = $request->price;
        $doctor->day = $request->day;
        $doctor->start = Carbon::parse($request->input('start'))->format('H:i a');
        $doctor->end =  Carbon::parse($request->input('end'))->format('H:i a');
        if(empty($discount)){
            $doctor->discount = 0;
        }      
        else{
            $doctor->discount = $request->discount;
        }

        if($doctor->save()){
            flash(translate('Timing Saved Successfully'))->success();
            return redirect()->route('clinic.doctor');
        }
        else{
            flash(translate('Something Went Wrong'))->error();
            return back();
        }

    }

    public function ClinicEdit($id){
        $doctorDeta = DoctorClinic::findOrFail(decrypt($id));
        return view('admin.doctor.editTime',compact('doctorDeta'));
    }

    public function ClinicUpdate($id,Request $request){
        $doctor = DoctorClinic::findOrFail($id);
        $doctor->doctor_id = $request->doctor_id;
        $doctor->clinic_id = $request->clinic_id;
        $doctor->fees = $request->price;
        $doctor->day = $request->day;
        $discount = $request->discount;
        $doctor->start = Carbon::parse($request->input('start'))->format('H:i a');
        $doctor->end =  Carbon::parse($request->input('end'))->format('H:i a');
        if(empty($discount)){
            $doctor->discount = 0;
        }      
        else{
            $doctor->discount = $request->discount;
        }

        if($doctor->save()){
            flash(translate('Timing Updated Successfully'))->success();
            return redirect()->route('clinic.doctor');
        }
        else{
            flash(translate('Something Went Wrong'))->error();
            return back();
        }
    }

}