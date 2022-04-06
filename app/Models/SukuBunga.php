<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SukuBunga extends Model
{
    protected $table = 'suku_bunga';

    protected $guarded = [];

    use HasFactory, SoftDeletes;
}
