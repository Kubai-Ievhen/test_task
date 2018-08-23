<?php
/**
 * Created by PhpStorm.
 * User: yevhen
 * Date: 20.06.18
 * Time: 10:29
 */

namespace App\Resources;

use Illuminate\Http\Request;
use App\Transaction;
use Validator;

class SearchTransactionClass
{
    /**
     * @param Request $request
     * @return mixed
     */
    public static function search(Request $request)
    {

        $transaction = Transaction::where('id','>',0);

        $transaction = self::searchParameter($transaction, $request, 'customer_id');
        $transaction = self::searchParameter($transaction, $request, 'amount');
        $transaction = self::searchParameter($transaction, $request, 'date');
        $transaction = self::searchParameter($transaction, $request, 'offset', 'offset');
        $transaction = self::searchParameter($transaction, $request, 'limit', 'limit');

        return $transaction->with('customer')->get();
    }

    /**
     * @param $transaction
     * @param Request $request
     * @param String $name
     * @param String $metod
     * @return mixed
     */
    private static function searchParameter($transaction, Request $request, String $name, String $metod = 'where')
    {
        if ($request->has('customer_id')){
            if ($param = $request->get($name)){
                switch ($metod){
                    case 'where':
                        $transaction->where($name, $param);
                        break;
                    case 'offset':
                        $transaction->offset($param);
                        break;
                    case 'limit':
                        $transaction->limit($param);
                        break;
                }
            }
        }

        return $transaction;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public static function valid(Request $request)
    {
        return Validator::make($request->all(), [
            'customer_id' => 'nullable|numeric|exists:customers,id',
            'amount' => 'nullable|numeric',
            'date' => 'nullable|date_format:Y-m-d',
            'offset' => 'nullable|numeric',
            'limit' => 'nullable|numeric',
        ]);
    }
}