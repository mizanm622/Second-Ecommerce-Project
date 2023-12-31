<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Childcategory;
use App\Models\Brand;
use App\Models\Pickup;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo( Category::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo( Subcategory::class, 'subcategory_id');
    }

    public function childcategory()
    {
        return $this->belongsTo( Childcategory::class, 'childcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function pickup()
    {
        return $this->belongsTo(Pickup::class, 'pickup_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'id');
    }

    public function scopeStatus($query)
    {
        $query->where('status', 1);
    }

    public function scopeFeature($query)
    {
        $query->where('featured',1);
    }

    public function scopeNew($query)
    {
        $query->where('is_new',1);
    }
    public function scopeTodaysDeal($query)
    {
        $query->where('todays_deal',1);
    }

}



