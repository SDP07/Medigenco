<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clinic;
use App\Location;
use App\User;
class clinicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clinics = Clinic::all();
        return view('admin.clinics.index',compact('clinics'));
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
        return view('admin.clinics.create',compact('locations'));
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
            $clinic = new Clinic;
            $clinic->user_id = $user->id;
            $clinic->clinic_name = $request->clinic_name;
            $clinic->clinic_address = $request->cliAddress;
            $clinic->location_id = $request->location_id;
            $clinic->clinic_phone = $request->clinPhone;
             if($request->has('alternate')){
                $clinic->clinic_alternate = $request->alternate;
            }
            else{
                $clinic->clinic_alternate = null;
            }
            if($clinic->save()){
                flash(translate('Clinic Saved Successfully'))->success();
                return redirect()->route('clinics.index');
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
        $clinic = Clinic::findOrFail(decrypt($id));
        return view('admin.clinics.edit',compact('clinic','locations'));
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
        $clinic =  Clinic::findOrFail($id);
        $clinic->clinic_name = $request->clinic_name;
        $clinic->clinic_address = $request->cliAddress;
        $clinic->location_id = $request->location_id;
        $clinic->clinic_phone = $request->clinPhone;
         if($request->has('alternate')){
            $clinic->clinic_alternate = $request->alternate;
        }
        else{
            $clinic->clinic_alternate = null;
        }
        if($clinic->save()){
           $user =  User::where('id',$clinic->user_id)->first();
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
                flash(translate('Clinic Updated Successfully'))->success();
                return redirect()->route('clinics.index');
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
