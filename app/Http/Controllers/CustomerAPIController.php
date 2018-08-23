<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomer;

/**
 * Class CustomerAPIController For API methods
 * @package App\Http\Controllers
 */
class CustomerAPIController extends CustomerController
{
    /**
     * Create a new customer instance for API
     *
     * @link /api/customer post method
     * @param CreateCustomer $request Request parameters for new customer
     * @return array  With id of created Customer
     * @return mixed|\Symfony\Component\HttpFoundation\Response If an error occurred return error 500 with description
     */
    public function create(CreateCustomer $request)
    {
        try{
            $customer = parent::create($request);
            return ['customerId'=>$customer];
        }catch (\Exception $e){
            return response('Unspecified query error. Create is failed', 500);
        }

    }
}
