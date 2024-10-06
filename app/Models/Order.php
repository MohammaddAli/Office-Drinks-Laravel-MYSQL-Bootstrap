<?php

namespace App\Models;

use App\Models\User;
use App\Models\Drink;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'drink_id',
        'drink_count',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function drink()
    {
        return $this->belongsTo(Drink::class);
    }
}
