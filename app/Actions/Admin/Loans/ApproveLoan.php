<?php

namespace App\Actions\Admin\Loans;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ApproveLoan {
    public static function handle($account, $loan)
    {
        DB::transaction(function() use ($account, $loan) {
            $account->available_balance += $loan->amount_payable;
            $loan->next_payment_due_date = now()->addMonth();
            $loan->status = 'approved';

            $account->save();
            $loan->save();

            Transaction::create([
                'user_id' => $loan->user_id,
                'actor_id' => request()->user()->id,
                'account_uuid' => $account->uuid,
                'type' => 'debit',
                'for' => 'loan_disbursement',
                'amount' => $loan->amount_payable,
                'comments' => 'Loan disbursed successfully',
            ]);
        });
    }
}