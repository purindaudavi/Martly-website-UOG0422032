<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'vendor_price',
        'quantity',
        'image',
        'vendor_id',
        'category',
        'is_deal',
        'discount_percentage',
        'is_approved'
    ];

    /**
     * Define the relationship with the User model (the vendor).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    /**
     * Define the relationship with the cart items.
     *
     * @return HasMany
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
    
    // NEW: Define the relationship with the reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}