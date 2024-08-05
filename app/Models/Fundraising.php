<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fundraising extends Model
{
    use HasFactory, SoftDeletes;
    //fillable name slug fundraiser id category id thumbnail about has_finished is_active target_amount

    protected $fillable = [
        'name',
        'slug',
        'fundraiser_id',
        'category_id',
        'thumbnail',
        'about',
        'has_finished',
        'is_active',
        'target_amount',
    ];

    //relation category, fundraiser belongsto
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }
    // relation hasmany donaturs where is paid 1, withdrawals
    public function donaturs()
    {
        return $this->hasMany(Donatur::class)->where('is_paid', 1);
    }

    //totalreachamount
    public function totalReachedAmount()
    {
        return $this->donaturs->sum('total_amount');
    }

    public function withdrawals()
    {
        return $this->hasMany(FundraisingWithdrawal::class);
    }

    //fundraising_phases hasmany
    public function fundraising_phases()
    {
        return $this->hasMany(FundraisingPhase::class);
    }

    //getpercentageattribute
    public function getPercentageAttribute()
    {
        $totalDonations = $this->totalReachedAmount();
        if ($this->target_amount > 0) {
            $percentage = ($totalDonations / $this->target_amount) * 100;
            return $percentage > 100 ? 100 : $percentage;
        }
        return 0;
    }
}
