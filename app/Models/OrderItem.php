<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'menu_item_id',
        'quantity',
        'price',
        // 'options', // Add if you have an options column
    ];

    // Relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship with the MenuItem model
    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class);
    }
}
