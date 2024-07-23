<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\SearchPhoneRequest;
// use App\Http\Requests\SearchAddressRequest;
class SearchController extends Controller
{
    public function searchForEmpWithPhone(SearchPhoneRequest $req){
        $req->validated();
        $employees=User::find(auth()->id())->employees()->where('phone','=',$req->phone)->get();
        return view('employee.viewEmployees',['isDeleted'=>false,'employees'=>$employees,'withPag'=>false]);
    }

    // public function searchForEmpWithAddress(SearchAddressRequest $req){
    //     $req->validated();
    //     $employees=User::find(auth()->id())->employees()->where('address','=',$req->address)->simplePaginate(1);
    //     return view('employee.viewEmployees',['isDeleted'=>false,'employees'=>$employees]);
    // }
}