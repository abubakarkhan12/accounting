<?php

namespace Database\Seeders;
use App\Models\Account;

use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
        ['name' => 'Cash', 'type' => 'asset'],
        ['name' => 'Sales Revenue', 'type' => 'income'],
        ['name' => 'Accounts Receivable', 'type' => 'asset'],
        ['name' => 'Capital', 'type' => 'equity'],
        ['name' => 'Expenses', 'type' => 'expense'],
    ];

    foreach ($accounts as $acc) {
        Account::create($acc);
    }
    }
}
