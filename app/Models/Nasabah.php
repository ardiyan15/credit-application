<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Nasabah extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'nasabah';

    protected $guarded = [];

    public function calon_debitur()
    {
        return $this->hasOne(Calon_Debitur::class, 'nasabah_id');
    }

    public function kerabat()
    {
        return $this->hasOne(Kerabat::class, 'nasabah_id');
    }

    public function suami_istri()
    {
        return $this->hasOne(Suami_istri::class, 'nasabah_id');
    }

    public function usaha()
    {
        return $this->hasOne(Usaha::class, 'nasabah_id');
    }

    public function calculation()
    {
        return $this->hasOne(Calculation::class, 'nasabah_id');
    }
}
