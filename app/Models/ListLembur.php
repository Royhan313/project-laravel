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
        'id',
        'user_id',
        'name',
        'division',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'jam_mulai',
        'jam_selesai',
        'jml_lembur',
        'pekerjaan',
        'hasil_lembur',
        'upload_doc',
        'lokasi',
        'status',
    ];

    // Menimpa metode boot untuk menangani ID secara otomatis
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Mencari ID terakhir
            $lastId = self::query()->max('id');
            $model->id = $lastId + 1;  // ID baru adalah ID terakhir + 1
        });

        // Menangani saat data dihapus, memperbarui ID lainnya
        static::deleted(function ($model) {
            self::rearrangeIds();  // Panggil fungsi untuk memperbarui ID yang ada
        });
    }

    /**
     * Fungsi untuk mengurutkan ulang ID setelah penghapusan data
     */
    public static function rearrangeIds()
    {
        // Ambil semua data urut berdasarkan ID
        $items = self::query()->orderBy('id')->get();

        // Set ulang ID untuk memastikan urutan
        foreach ($items as $index => $item) {
            $item->update(['id' => $index + 1]);  // Set ID berdasarkan urutan
        }
    }

    public static function countLemburUser($name)
    {
        return self::query()
            ->where('name', $name)
            ->count();
    }

    public static function countLembur()
    {
        return self::count();
    }

    public static function countLemburP()
    {
        return self::query()
            ->where('status', 'pending')
            ->count();
    }

    public static function countLemburR()
    {
        return self::query()
            ->where('status', 'rejected')
            ->count();
    }

    public static function countLemburS()
    {
        return self::query()
            ->where('status', 'approved')
            ->count();
    }

    public static function countLemburUS($name)
    {
        return self::query()
            ->where('name', $name)
            ->where('status', 'approved')
            ->count();
    }

    public static function countLemburUP($name)
    {
        return self::query()
            ->where('name', $name)
            ->where('status', 'pending')
            ->count();
    }

    public static function countLemburUR($name)
    {
        return self::query()
            ->where('name', $name)
            ->where('status', 'rejected')
            ->count();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
