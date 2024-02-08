<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;

    /**
     * The model's fillable properties.
     *
     * @var array
     */
    protected $fillable = ["name", "description", "budget" , "user_id"];

    /**
     * Get the user that owns the project.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the partners associated with the project.
     */
    public function partners()
    {
        // Corrected to include a return statement
        return $this->hasMany(Partner::class);
    }
}
