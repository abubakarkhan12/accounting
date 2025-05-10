<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntryLine extends Model
{
    use HasFactory;
    protected $fillable = ['account_id', 'debit', 'credit'];

    public function account()
{
    return $this->belongsTo(Account::class);
}

public function journalEntry()
    {
        return $this->belongsTo(JournalEntry::class);
    }

}
