<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            // Jika NIS kosong, maka generate NIS baru
            if (empty($student->nis)) {
                $student->nis = self::generateNIS();
            }
        });
    }

    // Fungsi untuk generate NIS
    public static function generateNIS()
    {
        // Ambil data terakhir berdasarkan NIS
        $lastNIS = self::latest('nis')->first();

        if (!$lastNIS) {
            return '0001';
        }

        // Ambil angka urut dari NIS terakhir dan tambahkan 1
        $lastNumber = (int) $lastNIS->nis;
        return str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT); // Format urutan dengan 4 digit
    }

    // Relasi ke model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'classroom_id');
    }
}
