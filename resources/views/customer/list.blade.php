@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-8"><h2>Customers</h2></div>
                            <div class="col-4">
                                <a class="btn btn-xs btn-info" href="{{ route('customer_create') }}">Crete New</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Name</th>
                                <th scope="col">PAN</th>
                                <th scope="col">Expired</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $datum)
                            <tr>
                                <th scope="row">{{$datum->id}}</th>
                                <td>{{$datum->name}}</td>
                                <td>{{$datum->pan}}</td>
                                <?php
                                $date = explode('-', $datum->expired);
                                $expired = date('m/y',mktime(0, 0, 0, $date[1], 0, $date[0]));
                                ?>
                                <td>{{$expired}}</td>
                                <td><a href="{{ route('create_transaction_view',['customerId'=>$datum->id]) }}">Crete Transaction</a></td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('new_customer'))
        <script>
            alert('Created customer with id: '+ {{session('new_customer')}})
        </script>
    @endif
@endsection
