<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Boot method untuk auto-generate NIP
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($teacher) {
            if (empty($teacher->nip)) {
                $teacher->nip = self::generateNIP();
            }
        });
    }


    public static function generateNIP()
    {
        $lastTeacher = self::latest('nip')->first();

        if (!$lastTeacher) {
            return '1000000001';
        }


        $lastNumber = (int) substr($lastTeacher->nip, 1);
        return '1' . str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
    }
}
