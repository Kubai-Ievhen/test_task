<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaction;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransactionGUIController extends TransactionController
{
    /**
     * @param Request $request
     * @param $customer_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(CreateTransaction $request, $customer_id)
    {
        try{
            $transaction = parent::create($request, $customer_id);
            return redirect("customer/$customer_id/transaction/$transaction->id");
        }catch (NotFoundHttpException $e) {
            if ($e->getStatusCode() == '404') {
                return redirect('customer/create')->with('error_message' , 'Customer Not Found');
            }
        }catch (\Exception $e){
            return redirect('customer/create')->with('error_message' , 'Unspecified query error. Create is failed.');
        }
    }

    /**
     * @param Request $request
     * @param $transaction_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function update(CreateTransaction $request, $transaction_id)
    {
        try{
            $transaction = parent::update($request, $transaction_id);
            return redirect("customer/$transaction->customer_id/transaction/$transaction->id")->with('transaction_update',true);
        }catch (NotFoundHttpException $e){
            if ($e->getStatusCode() == '404'){
                return redirect('transaction')->with('error_message' , 'Transaction Not Found');
            }
        }catch (\Exception $e){
            return redirect('transaction')->with('error_message' , 'Unspecified query error. Update is failed.');
        }
    }

    /**
     * @param $transaction_id
     * @return mixed
     */
    public function delete($transaction_id)
    {
        parent::delete($transaction_id);
        return back();
    }

    /**
     * @param $customer_id
     * @param $transaction_id
     * @return array|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function show($customer_id, $transaction_id)
    {
        try{
            $transaction = parent::show($customer_id, $transaction_id);
            return view('transaction.create', ['transaction'=>$transaction]);
        }catch (NotFoundHttpException $e){
            if ($e->getStatusCode() == '404'){
                return redirect('transaction')->with('error_message' , 'Customer or Transaction Not Found');
            }
        }catch (\Exception $e){
            return redirect('transaction')->with('error_message' , 'Unspecified query error. Update is failed.');
        }
    }
}
