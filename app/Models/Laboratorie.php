<?php

namespace App\Models;

use App\Models\Image;
use App\Models\Doctor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Laboratorie extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class,'doctor_id');
    }

    // public function employee()
    // {
    //     return $this->belongsTo(LaboratorieEmployee::class,'employee_id')
    //         ->withDefault(['name'=>'noEmployee']);
    // }

    public function Patient()
    {
        return $this->belongsTo(Patient::class,'patient_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
