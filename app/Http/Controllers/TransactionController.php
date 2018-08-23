<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateTransaction;
use App\Transaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\StrictSessionHandler;

class TransactionController extends Controller
{
    /**
     * @param CreateTransaction $request
     * @param $customer_id
     * @return mixed
     */
    public function create(CreateTransaction $request, $customer_id)
    {
        if ($customer = Customer::find($customer_id)) {
            $transaction_id = Customer::find($customer_id)->transactions()->insertGetId([
                'amount' => $request->get('amount'),
                'date' => date('Y-m-d'),
                'customer_id' => $customer_id,
            ]);

            return Transaction::find($transaction_id);
        }

        abort(404);
    }

    /**
     * @param CreateTransaction $request
     * @param $transaction_id
     * @return mixed
     */
    public function update(CreateTransaction $request, $transaction_id)
    {
        if ($customer = Transaction::find($transaction_id)){
            $customer->update(['amount' => $request->get('amount')]);

            return Transaction::find($transaction_id);
        }

        abort(404);
    }

    /**
     * @param $transaction_id
     * @return mixed
     */
    public function delete($transaction_id)
    {
        return Transaction::where('id', $transaction_id)->delete();
    }

    /**
     * @param $customer_id
     * @param $transaction_id
     * @return bool
     */
    public function show($customer_id, $transaction_id)
    {
        if ($customer = Customer::find($customer_id)){
            if ($transaction = $customer->transactions()->where('id', $transaction_id)->first()){
                return  $transaction;
            }
        }
        abort(404);
    }
}
