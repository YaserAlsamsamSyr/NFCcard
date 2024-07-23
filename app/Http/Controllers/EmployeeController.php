<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employee;
use \App\Http\Requests\EmployeeRequest;
use \App\Http\Requests\UpdateEmpRequest;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $employees=User::find(auth()->id())->employees()->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('employee.viewEmployees',['isDeleted'=>false,'employees'=>$employees,'withPag'=>true]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.addEmployee',['created'=>false]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $request->validated();
        $user=User::find(auth()->id());
        $imageName =$request->getSchemeAndHttpHost()."/images/".time().'.'.$request->img->extension();
        $user->employees()->create([
            'firstName'=>$request->firstName,
            'lastName'=>$request->lastName,
            'phone'=>$request->phone,
            'img'=>$imageName,
            'age'=>$request->age,
            'address'=>$request->address,
            'password'=>$request->password
        ]);
        $request->img->move(public_path('images'), $imageName);
        return view('employee.addEmployee',['created'=>true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,string $id)
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
        ]);
        $emp=Employee::find($id);
        return view('employee.updateEmp',['emp'=>$emp,'isUpdated'=>false,'isPassUsed'=>false]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmpRequest $request, string $id)
    {
        // adminPass
        $request->validated();
        $isNewPass=true;
        $isNewImg=true;
        $oldPass=$request->oldPassword;
        $oldImg=$request->oldImage;
        // password
        if($oldPass==$request->password)
                $isNewPass=false;
        if($isNewPass){
            $pass=Employee::where('password','=',$request->password)->get();
            if(count($pass)>0){
                $emp=Employee::find($id);
                return view('employee.updateEmp',['emp'=>$emp,'isUpdated'=>false,'isPassUsed'=>true]); 
            }
        }
        // PASSWORD READY
        // image
        if(!$request->img){
           $request->img=$oldImg;
           $isNewImg=false;
        }
        $updateImageName=$oldImg;
        $string = $oldImg;
        $oldImg = ($sub = strstr($string, "images/")) ? substr($sub, 7) : $string;
        if($isNewImg){
            $image_path =public_path()."/images/".$oldImg;
            if (file_exists($image_path))
                @unlink($image_path);
            $imageName =$request->getSchemeAndHttpHost()."/images/".time().'.'.$request->img->extension();
            $updateImageName=$imageName;
            $request->img->move(public_path('images'), $imageName);        
        }
        // image ready
        $updateEmp=Employee::find($id)->first();
        $updateEmp->firstName=$request->firstName;
        $updateEmp->lastName=$request->lastName;
        $updateEmp->phone=$request->phone;
        $updateEmp->img=$updateImageName;
        $updateEmp->age=$request->age;
        $updateEmp->address=$request->address;
        $updateEmp->password=$request->password;
        $updateEmp->save();
        return view('employee.updateEmp',['emp'=>$updateEmp,'isUpdated'=>true,'isPassUsed'=>false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,string $id)
    {
        $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
        ]);
        $e=Employee::where('id', $id)->firstorfail()->delete();
        $s=explode("/images/",$request->img);
        $image_path =public_path()."/images/".$s[1];
        if (file_exists($image_path))
            @unlink($image_path);
        $employees=User::find(auth()->id())->employees()->orderBy('created_at', 'desc')->simplePaginate(15);
        return view('employee.viewEmployees',['isDeleted'=>true,'employees'=>$employees,'withPag'=>true]);
    }
}
