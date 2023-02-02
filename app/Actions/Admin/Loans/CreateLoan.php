<?php 

namespace App\Actions\Admin\Loans;

use App\Models\LoanUser;

class CreateLoan {
    public static function hanlde($data)
    {
        LoanUser::create([
            'user_id' => $data['user']['id'],
            'plan_id' => $data['plan']['id'],
            'loan_id' => $data['loan']['id'],
            'monthly_installment' => 
                            ceil(($data['amount_payable'] + ($data['amount_payable'] * 
                            ($data['plan']['interest_rate'] / 100))) / ($data['plan']['repayment_months'])),
            'amount_payable' => $data['amount_payable'],
            'amount_remaining' => $data['amount_payable'] + ($data['amount_payable'] * 
                            ($data['plan']['interest_rate'] / 100))
        ]);
    }
}