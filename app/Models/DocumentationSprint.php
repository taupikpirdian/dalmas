<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentationSprint extends Model
{
    protected $fillable = [
        'sprint_id',
        'name',
        'path',
        'original_name',
    ];
}
