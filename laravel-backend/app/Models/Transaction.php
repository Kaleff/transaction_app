<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, double>
     */
    protected $fillable = [
        'currency',
        'amount',
        'sender_amount',
        'sender_id',
        'recipient_id',
        'sender_account_id',
        'recipient_account_id'
    ];
}
