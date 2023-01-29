<?php

namespace App\Actions\Admin\LoanType;

use App\Models\Loan;

class  UpdateLoanType {
    
    public static function update(Loan $loan, array $data): Loan
    {
        $loan->update([
            'loan_type' => $data['loan_type'],
            'loan_description' => $data['loan_description'],
            'min_amount' => $data['min_amount'],
            'max_amount' => $data['max_amount'],
        ]);

        $loan->save();

        return $loan;
    }
}