<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemList extends Model
{
    use HasFactory;

    protected $table = 'item_list';
    protected $guarded = ['id'];

    public function Location() {
        return $this->belongsTo('App\Models\ItemLocation', 'location_id');
    }

    public function Category() {
        return $this->belongsTo('App\Models\ItemCategory', 'category_id');
    }

    public function SubCategory() {
        return $this->belongsTo('App\Models\ItemSubCategory', 'subcategory_id');
    }
    
}
