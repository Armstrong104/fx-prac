<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    public static $doctor,$slug;

    public static function saveDoctor($r)
    {
        self::$doctor = new Doctor();
        self::$doctor->name = $r->name;
        self::$doctor->department_id = $r->department_id;
        self::$doctor->speciality = $r->speciality;
        self::$doctor->desc = $r->desc;
        $image = $r->image;
        if($image){
            self::$doctor->image = imageUpload($image,'doctor-images');
        }
        self::$doctor->save();

    }

    public static function updateDoctor($r,$id)
    {
        self::$doctor = Doctor::find($id);
        self::$doctor->name = $r->name;
        self::$doctor->department_id = $r->department_id;
        self::$doctor->speciality = $r->speciality;
        self::$doctor->desc = $r->desc;
        $image = $r->image;
        if($image){
            if(file_exists(self::$doctor->image)){
                unlink(self::$doctor->image);
            }
            self::$doctor->image = imageUpload($image,'doctor-images');
        }
        self::$doctor->save();
    }

    public static function destroyDoctor($id)
    {
        self::$doctor = Doctor::find($id);
        if(file_exists(self::$doctor->image)){
            unlink(self::$doctor->image);
        }
        self::$doctor->delete();
    }



    public function department()
    {
        return $this->belongsTo(Department::class);
    }

}
