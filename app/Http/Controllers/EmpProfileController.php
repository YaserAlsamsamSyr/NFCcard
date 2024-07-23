<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmpProfileLoginRequest;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;

class EmpProfileController extends Controller
{
    public function openLogin(Request $req){
        // if($req->session()->has('empId'))
        if($req->hasCookie('empId'))
            return redirect(route('profile')); 
        return view('employeeProfile.login',['isTruePass'=>true]);
    }
    public function login(EmpProfileLoginRequest $req){
        $req->validated();
        $emp=Employee::where('password','=',$req->password)->get();
        if(count($emp)==0) 
            return view('employeeProfile.login',['isTruePass'=>false]);
        if(Cookie::queue(Cookie::make('empId',$emp[0]->id, 60*24*360)))
            return redirect()->intended(route('profile')); 
        return redirect(route('empLogin'))->with("error","كلمة سر غير صحيحة");
    }

    public function openProfile(Request $req){
    //    $emp=Employee::find($req->session()->get('empId'));
        if(!$req->hasCookie('empId'))
            return redirect(route('empLogin')); 
       $emp=Employee::find($req->cookie('empId'));
       $emp->numUsedCard++;
       $emp->save();
       return view('employeeProfile.profile',['emp'=>$emp]);
    }

    public function logout(Request $request){
        // $request->session()->flush();
        // Auth::logout();
        Cookie::queue(Cookie::forget('empId'));
        return redirect(route('empLogin'));
    }
}
