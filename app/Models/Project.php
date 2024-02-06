<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function partners()
    {
        $this->hasMany(Partner::class);
    }


    protected $fillable = ["name","description","budget"];
}
