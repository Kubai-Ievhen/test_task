<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateCustomer;

class CustomerController extends Controller
{
    /**
     * @param CreateCustomer $request
     * @return mixed
     */
    public function create(CreateCustomer $request)
    {
        $date = explode('/', $request->get('expired'));
        $expired = date('Y-m-d',mktime(0, 0, 0, $date[0], 30, $date[1]));

        $data = $request->all();
        $data['expired'] = $expired;
        unset($data['_token']);

        return Customer::insertGetId($data);
    }
}
