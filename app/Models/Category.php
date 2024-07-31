<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    //fillable
    protected $fillable = ['name', 'slug', 'icon'];

    // relation fundraisings hasmany
    public function fundraisings()
    {
        return $this->hasMany(Fundraising::class);
    }
}
