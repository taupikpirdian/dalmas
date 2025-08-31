<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personil extends Model
{
    protected $fillable = [
        'nrp',
        'name',
        'pangkat',
        'jabatan',
        'satuan'
    ];

    public function sprints()
    {
        return $this->hasMany(Sprint::class);
    }
}
