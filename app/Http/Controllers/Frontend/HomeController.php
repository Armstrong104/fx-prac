<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('frontend.home.index',compact('departments','doctors'));
    }
}
