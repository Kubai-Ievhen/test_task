<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTransaction;
use App\Transaction;
use Illuminate\Http\Request;

class SearchTransactionController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function search(SearchTransaction $request)
    {
        $transaction = Transaction::where('id','>',0);

        $parameters = ['customer_id', 'amount', 'date', 'limit', 'offset'];
        foreach ($parameters as $parameter) {
            $transaction = self::searchParameter($transaction, $request, $parameter, $parameter);
        }

        return $transaction->with('customer')->get();
    }

    /**
     * @param $transaction
     * @param Request $request
     * @param String $name
     * @param String $metod
     * @return mixed
     */
    private function searchParameter($transaction, Request $request, String $name, String $metod = 'where')
    {
        if ($request->has($name)){
            if ($param = $request->get($name)){
                switch ($metod){
                    case 'where':
                        $transaction->where($name, $param);
                        break;
                    case 'offset':
                    case 'limit':
                        $transaction->$metod($param);
                        break;
                }
            }
        }

        return $transaction;
    }
}
