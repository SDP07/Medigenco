<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hospital;
use App\HospitalDetail;
use App\User;
use App\Location;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hospitals = Hospital::all();
        return view('admin.hospital.index',compact('hospitals'));
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
        return view('admin.hospital.create',compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $user = new User;
        $user->user_type = 2;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->perAddress;
        $user->password = password_hash($request->password, PASSWORD_DEFAULT);
        $user->location_id = $request->location_id;
        $user->postal_code = $request->postal;
        $user->city = $request->city;
        $user->country = 'India';
        $user->verified = 1;
        if($request->has('email')){
            $user->email = $request->email;
        }
        else{
            $user->email = null;
        }

        if($user->save()){
            $hospital = new Hospital;
            $hospital->user_id = $user->id;
            $hospital->hospital_name = $request->hospital_name;
            $hospital->address = $request->cliAddress;
            $hospital->location_id = $request->location_id;
            $hospital->phone = $request->clinPhone;
             if($request->has('alternate')){
                $hospital->alternate_no = $request->alternate;
            }
            else{
                $hospital->alternate_no = null;
            }
            if($hospital->save()){
                flash(translate('Hospital Saved Successfully'))->success();
                return redirect()->route('hospitals.index');
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
        $locations = Location::all();
        $hospital = Hospital::findOrFail(decrypt($id));
        return view('admin.hospital.edit',compact('hospital','locations'));
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
        $hospital =  Hospital::findOrFail($id);
        $hospital->hospital_name = $request->hospital_name;
        $hospital->address = $request->cliAddress;
        $hospital->location_id = $request->location_id;
        $hospital->phone = $request->clinPhone;
         if($request->has('alternate')){
            $hospital->alternate_no = $request->alternate;
        }
        else{
            $hospital->alternate_no = null;
        }
        if($hospital->save()){
           $user =  User::where('id',$hospital->user_id)->first();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->address = $request->perAddress;
            $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            $user->location_id = $request->location_id;
            $user->postal_code = $request->postal;
            $user->city = $request->city;
            $user->country = 'India';
            $user->verified = 1;
            if($request->has('email')){
                $user->email = $request->email;
            }
            else{
                $user->email = null;
            }

            if($user->save()){
                flash(translate('hospital Updated Successfully'))->success();
                return redirect()->route('hospitals.index');
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
}
