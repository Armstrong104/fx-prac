<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = Doctor::all();
        return view('backend.doctor.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $departments = Department::all();
        return view('backend.doctor.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department_id' => 'required',
            'speciality' => 'required',
            'image' => 'image',

        ]);
        $image = $request->image;
        if($image){
            $imgUrl = imageUpload($image,'doctor-images');
        }

        Doctor::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'speciality' => $request->speciality,
            'desc' => $request->desc,
            'image' => $imgUrl
        ]);

        return back()->with('msg','Doctor Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor = Doctor::find($id);
        $departments = Department::all();
        return view('backend.doctor.edit',compact('doctor','departments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor = Doctor::find($id);
        $image = $request->image;
        if($image){
            if(file_exists($doctor->image)){
                unlink($doctor->image);
            }
            $imgUrl = imageUpload($image,'doctor-images');
        }else{
            $imgUrl = $doctor->image;
        }

        $doctor->update([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'speciality' => $request->speciality,
            'desc' => $request->desc,
            'image' => $imgUrl
        ]);

        return to_route('doctors.index')->with('msg','Doctor Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $doctor = Doctor::find($id);
        if(file_exists($doctor->image)){
            unlink($doctor->image);
        }
        $doctor->delete();
        return back()->with('msg','Doctor Deleted Successfully!');
    }
}
