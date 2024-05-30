<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name'];

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function subjecs()
    {
        return $this->hasMany(Subject::class);
    }
}
