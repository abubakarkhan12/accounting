<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function journalEntryLines()
{
    return $this->hasMany(JournalEntryLine::class);
}

}
