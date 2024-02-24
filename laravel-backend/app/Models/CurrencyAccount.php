<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurrencyAccount extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, double>
     */
    protected $fillable = [
        'currency',
        'client_id',
        'amount'
    ];
    /**
     * Get exchange rates associated with account currency
     */
    public function exchangeRate(): BelongsTo
    {
        return $this->belongsTo(ExchangeRate::class, 'currency', 'currency');
    }

    public function transactionsSent(): HasMany
    {
        return $this->hasMany(Transaction::class, 'sender_account_id', 'id');
    }

    public function transactionsReceived(): HasMany
    {
        return $this->hasMany(Transaction::class, 'recipient_account_id', 'id');
    }
}
