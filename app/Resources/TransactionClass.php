<?php
/**
 * Created by PhpStorm.
 * User: yevhen
 * Date: 20.06.18
 * Time: 10:04
 */

namespace App\Resources;

use Illuminate\Http\Request;
use App\Customer;
use App\Transaction;
use Validator;


class TransactionClass
{
    /**
     * @param Request $request
     * @param $customer_id
     * @return bool
     */
    public static function create(Request $request, $customer_id)
    {
        if ($customer = Customer::find($customer_id)) {
            $transaction_id = Customer::find($customer_id)->transactions()->insertGetId([
                'amount' => $request->get('amount'),
                'date' => date('Y-m-d'),
                'customer_id' => $customer_id,
            ]);

            return Transaction::find($transaction_id);
        }

        return false;
    }

    public static function update(Request $request, $transaction_id)
    {
        if ($customer = Transaction::find($transaction_id)){
            $customer->update(['amount' => $request->get('amount')]);

            return Transaction::find($transaction_id);
        }

        return false;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function valid(Request $request)
    {
        return Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);
    }

    /**
     * @param $transaction_id
     * @return mixed
     */
    public static function delete($transaction_id)
    {
        return Transaction::where('id', $transaction_id)->delete();
    }

    /**
     * @param $customer_id
     * @param $transaction_id
     * @return bool
     */
    public static function show($customer_id, $transaction_id)
    {
        if ($customer = Customer::find($customer_id)){
            if ($transaction = $customer->transactions()->where('id', $transaction_id)->first()){
                return  $transaction;
            }
        }

        return false;
    }
}