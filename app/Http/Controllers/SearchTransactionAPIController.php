<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTransaction;
use Illuminate\Http\Request;

class SearchTransactionAPIController extends SearchTransactionController
{
    /**
     * @param Request $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|mixed
     */
    public function search(SearchTransaction $request)
    {
        try{
            $transaction = parent::search($request);

            $transaction->transform(function ($item, $key) {
                $transaction = new TransactionAPIController();
                return $transaction->formTransactionOutput($item);
            });

            return $transaction;
        }catch (\Exception $e){
            return response('Unspecified query error. Create is failed', 500);
        }
    }
}
