<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ListLembur extends Model
{
    use HasFactory;

    protected $table = 'listlembur';

    protected $fillable = [
        'user_id',
        'name',
        'division',
        'tanggal',
        'jam_mulai',
        'jam_selesai',
        'jml_lembur',
        'keterangan',
        'status',
        
    ];

    public static function countLemburUser($name)
    {
      $totalLembur = self::query()
        ->selectRaw('COUNT(*) as total_lembur')
        ->where('name', $name)
        ->value('total_lembur'); // Mengambil nilai total_lembur berdasarkan nama

    return $totalLembur; // Mengembalikan nilai total lembur
    }
    


    public static function countLembur()
    {
        
        return self::count(); // Menghitung jumlah total data di tabel listlembur
        
    }

    public static function countLemburP()
    {
            // Menghitung jumlah lembur yang statusnya 'pending'
        $totalLemburP = self::query()
        ->where('status', 'pending') // Memfilter berdasarkan status 'pending'
        ->count(); // Menghitung jumlah data yang statusnya 'pending'

        return $totalLemburP; // Mengembalikan jumlah lembur yang pending
    }

    public static function countLemburR()
    {
            // Menghitung jumlah lembur yang statusnya 'pending'
        $totalLemburR = self::query()
        ->where('status', 'rejected') // Memfilter berdasarkan status 'pending'
        ->count(); // Menghitung jumlah data yang statusnya 'pending'

        return $totalLemburR; // Mengembalikan jumlah lembur yang pending
    }

    public static function countLemburS()
    {
            // Menghitung jumlah lembur yang statusnya 'pending'
        $totalLemburS = self::query()
        ->where('status', 'approved') // Memfilter berdasarkan status 'pending'
        ->count(); // Menghitung jumlah data yang statusnya 'pending'

        return $totalLemburS; // Mengembalikan jumlah lembur yang pending
    }

    public static function countLemburUS($name)
    {
        $totalLemburUS = self::query()
        ->where('name', $name)
        ->where('status', 'approved')
        ->count();

        return $totalLemburUS; // Mengembalikan jumlah lembur yang pending
    }

    public static function countLemburUP($name)
    {
        $totalLemburUP = self::query()
        ->where('name', $name)
        ->where('status', 'pending')
        ->count();

        return $totalLemburUP; // Mengembalikan jumlah lembur yang pending
    }

    public static function countLemburUR($name)
    {
        $totalLemburUR = self::query()
        ->where('name', $name)
        ->where('status', 'rejected')
        ->count();

        return $totalLemburUR; // Mengembalikan jumlah lembur yang pending
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
