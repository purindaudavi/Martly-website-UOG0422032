<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{

    use HasRoles;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    
    /**
     * NEW: Define a relationship to get all products for this user.
     *
     * @return HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'vendor_id');
    }

    // NEW: Define the relationship with the reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
    // NEW: Define the relationship to get all orders for this user.
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Make sure 'role' is fillable if you are assigning it
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}