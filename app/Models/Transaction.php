<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, Uuid;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'customer_id',
        'game_id',
        'item',
        'price',
        'payment_id',
        'user_id',
        'status'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
    ];

    public function customer()
    {
        $this->belongsTo(Customer::class);
    }
    
    public function game()
    {
        $this->belongsTo(Game::class);
    }

    public function payment()
    {
        $this->belongsTo(Payment::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
