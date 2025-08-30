<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    protected $fillable = [
        'user_id',
        'nomor',
        'nrp',
        'start_date',
        'end_date',
        'pangkat',
        'jabatan',
        'satuan',
        'pertimbangan',
        'dasar',
        'tugas',
        'tembusan',
        'created_by',
        'status',
        'nama',
        'jenis_tugas',
        'token',
        'expires_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function personil()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function files()
    {
        return $this->hasMany(DocumentationSprint::class, 'sprint_id', 'id');
    }
}
