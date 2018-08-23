@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h2>Transactions</h2></div>

                    </div>
                </div>
                <div class="card-body">
                    <section>
                        <form method="POST" action="{{ route('search') }}" aria-label="{{ __('Search') }}">
                            @csrf
                            <div class="row">
                                <div class="form-group row col-6">
                                    <label for="email" class="col-md-5 col-form-label text-md-right">{{ __('Customer Id') }}</label>
                                    <div class="col-md-7">
                                        <input id="customer_id" type="number" class="form-control{{ $errors->has('customer_id') ? ' is-invalid' : '' }}" name="customer_id" value="{{ old('customer_id')??$parameters['customer_id']??'' }}">
                                        @if ($errors->has('customer_id'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('customer_id') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row col-6">
                                    <label for="amount" class="col-md-5 col-form-label text-md-right">{{ __('Amount') }}</label>
                                    <div class="col-md-7">
                                        <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount')??$parameters['amount']??'' }}">
                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row col-6">
                                    <label for="offset" class="col-md-5 col-form-label text-md-right">{{ __('Offset') }}</label>
                                    <div class="col-md-7">
                                        <input id="offset" type="number" class="form-control{{ $errors->has('offset') ? ' is-invalid' : '' }}" name="offset" value="{{ old('offset')??$parameters['offset']??'' }}">
                                        @if ($errors->has('offset'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('offset') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row col-6">
                                    <label for="limit" class="col-md-5 col-form-label text-md-right">{{ __('Limit') }}</label>
                                    <div class="col-md-7">
                                        <input id="limit" type="number" class="form-control{{ $errors->has('limit') ? ' is-invalid' : '' }}" name="limit" value="{{ old('limit')??$parameters['limit']??'' }}">
                                        @if ($errors->has('limit'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('limit') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row col-6">
                                    <label for="date" class="col-md-5 col-form-label text-md-right">{{ __('Date') }}</label>
                                    <div class="col-md-7">
                                        <input id="date" type="date" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date')??$parameters['date']??'' }}">
                                        @if ($errors->has('date'))
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row mb-0 col-6">
                                    <div class="col-md-3 offset-md-8">
                                        <button type="submit" class="btn btn-light">
                                            {{ __('Search') }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </section>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $datum)
                            <tr>
                                <td scope="row">{{$datum->id}}</td>
                                <td>{{$datum->customer->name}}</td>
                                <td>{{$datum->amount}}</td>
                                <td>{{$datum->date}}</td>
                                <td>
                                    <div class="row">
                                        <a href="{{ route('get_transaction',['transaction_id'=>$datum->id, 'customerId'=>$datum->customer->id]) }}" class="btn btn-link">Detail</a>
                                        <form method="POST" action="{{ route('delete_transaction',['transaction_id'=>$datum->id]) }}" aria-label="{{ __('Delete') }}">
                                            {{ method_field('DELETE') }}
                                            @csrf
                                            <button type="submit" class="btn btn-link">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if(session('new_transaction'))
    <script>
        alert('Created transaction with id: {{session('new_transaction')->id}}, customerId: {{session('new_transaction')->customer_id}}, amount: {{session('new_transaction')->amount}}, date: {{session('new_transaction')->date}}');
    </script>
@endif
@endsection