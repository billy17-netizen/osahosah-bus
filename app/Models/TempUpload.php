<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempUpload extends Model
{
    protected $fillable = [
        'folder',
        'file',
    ];
}
