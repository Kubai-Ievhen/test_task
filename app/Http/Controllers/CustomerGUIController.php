<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CreateCustomer;

class CustomerGUIController extends CustomerController
{
    /**
     * @param CreateCustomer $request
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function create(CreateCustomer $request)
    {
        try{
            $customer = parent::create($request);
            return redirect('customer')->with('new_customer', $customer);
        }catch (\Exception $e){
            return redirect('customer/create')->with('error_message' , 'Unspecified query error. Create is failed.');
        }
    }

    /**
     * @return array|\Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
     */
    public function show()
    {
        return view('customer.list')->with(['data'=>Customer::all()]);
    }
}
