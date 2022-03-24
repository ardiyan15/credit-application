<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Calon_Debitur extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'calon_debitur';

    protected $guarded = [];
}
