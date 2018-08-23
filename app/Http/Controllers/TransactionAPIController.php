<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaction;
use App\Resources\SearchTransactionClass;
use App\Resources\TransactionClass;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TransactionAPIController extends TransactionController
{
    /**
     * @param CreateTransaction $request
     * @param $customer_id
     * @return bool|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Support\Collection|\Symfony\Component\HttpFoundation\Response
     */
    public function create(CreateTransaction $request, $customer_id)
    {
        try{
            $transaction = parent::create($request, $customer_id);
            return $this->formTransactionOutput($transaction);
        }catch (NotFoundHttpException $e){
            if ($e->getStatusCode() == '404'){
                return response('Customer Not Found', 404);
            }
        }catch (\Exception $e){
            return response('Unspecified query error. Create is failed', 500);
        }
    }

    /**
     * @param CreateTransaction $request
     * @param $transaction_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Support\Collection|mixed|\Symfony\Component\HttpFoundation\Response
     */
    public function update(CreateTransaction $request, $transaction_id)
    {
        try{
            $transaction = parent::update($request, $transaction_id);
            return $this->formTransactionOutput($transaction);
        }catch (NotFoundHttpException $e){
            if ($e->getStatusCode() == '404'){
                return response('Transaction Not Found', 404);
            }
        }catch (\Exception $e){
            return response('Unspecified query error. Update is failed', 500);
        }
    }

    /**
     * @param $transaction_id
     * @return mixed
     */
    public function delete($transaction_id)
    {
        return parent::delete($transaction_id);
    }

    /**
     * @param $customer_id
     * @param $transaction_id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Support\Collection|\Symfony\Component\HttpFoundation\Response
     */
    public function show($customer_id, $transaction_id)
    {
        try{
            $transaction = parent::show($customer_id, $transaction_id);
            return $this->formTransactionOutput($transaction);
        }catch (NotFoundHttpException $e){
            if ($e->getStatusCode() == '404'){
                return response('Customer or Transaction Not Found', 404);
            }
        }catch (\Exception $e){
            return response('Unspecified query error.', 500);
        }
    }

    /**
     * @param $item
     * @return \Illuminate\Support\Collection
     */
    public function formTransactionOutput($item)
    {
        $new_item = collect(
            [
                'transactionId' => $item->id,
                'amount' => $item->amount,
                'date' => $item->date,
            ]
        );
        return $new_item;
    }
}
