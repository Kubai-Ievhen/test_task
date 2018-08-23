<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchTransaction;

class SearchTransactionGUIController extends SearchTransactionController
{
    /**
     * @param SearchTransaction $request
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View|mixed
     */
    public function search(SearchTransaction $request)
    {
        try{
            $transaction = parent::search($request);
            return view('transaction.search')->with(['data'=> $transaction, 'parameters' => $request->all()]);
        }catch (\Exception $e){
            return redirect('transaction')->with('error_message' , 'Unspecified query error. Update is failed.');
        }
    }
}
