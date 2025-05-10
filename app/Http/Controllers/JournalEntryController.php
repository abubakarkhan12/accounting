<?php

namespace App\Http\Controllers;
use App\Models\JournalEntry;
use App\Models\JournalEntryLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Account; 


class JournalEntryController extends Controller
{
    public function store(Request $request){
    $request->validate([
        'description' => 'required|string',
        'reference' => 'required|string|unique:journal_entries,reference',
        'date' => 'required|date',
        'lines' => 'required|array|min:2',
        'lines.*.account_id' => 'required|exists:accounts,id',
        'lines.*.debit' => 'numeric|min:0',
        'lines.*.credit' => 'numeric|min:0',
    ]);

    $totalDebit = collect($request->lines)->sum('debit');
    $totalCredit = collect($request->lines)->sum('credit');

    if ($totalDebit != $totalCredit) {
        return response()->json(['error' => 'Debits and credits must be equal.'], 422);
    }

    DB::transaction(function () use ($request) {
        $entry = JournalEntry::create($request->only(['description', 'reference', 'date']));

        foreach ($request->lines as $line) {
            $entry->lines()->create([
                'account_id' => $line['account_id'],
                'debit' => $line['debit'],
                'credit' => $line['credit'],
            ]);
        }
    });

    return response()->json(['message' => 'Journal entry created successfully']);
}

public function index()
{
    return JournalEntry::with('lines.account')->get();
}


public function accountBalances()
{
    $accounts = \App\Models\Account::with('journalEntryLines')->get();

    $data = $accounts->map(function ($account) {
        $debit = $account->journalEntryLines->sum('debit');
        $credit = $account->journalEntryLines->sum('credit');
        $balance = $debit - $credit;

        // For liabilities, equity, income → flip sign
        if (in_array($account->type, ['liability', 'equity', 'income'])) {
            $balance = $credit - $debit;
        }

        return [
            'account' => $account->name,
            'type' => $account->type,
            'balance' => $balance,
        ];
    });

    return response()->json($data);
}


public function create()
    {
        $accounts = Account::all(); 
        return view('journal-create', compact('accounts'));
    }

}
