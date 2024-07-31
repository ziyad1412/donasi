<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fundraiser extends Model
{
    use HasFactory, SoftDeletes;
    //fillable is_active user_id
    protected $fillable = ['is_active', 'user_id'];

    //relation user belongsto
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
