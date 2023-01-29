<?php

namespace App\Actions\Admin\LoanType;

use App\Models\Loan;

class  CreateLoanType {
    public static function insert( array $data): Loan
    {
        return Loan::create([
            'loan_type' => $data['loan_type'],
            'loan_description' => $data['loan_description'],
            'min_amount' => $data['min_amount'],
            'max_amount' => $data['max_amount'],
        ]);
    }
}