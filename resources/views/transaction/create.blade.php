@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Transaction</div>

                    <div class="card-body">
                        @if(isset($transaction))
                            <form method="POST" action="{{ route('update_transaction',['transaction_id'=>$transaction->id]) }}" aria-label="{{ __('Update') }}">
                                {{ method_field('PUT') }}
                                @csrf
                                <div class="form-group row">
                                    <label for="customer" class="col-md-4 col-form-label text-md-right">{{ __('Customer') }}</label>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-4">
                                                <input id="customer" type="number" class="form-control" name="customer" value="{{ $transaction->customer->id??'' }}" disabled>
                                            </div>
                                            <div class="col-8">
                                                <input id="customer_name" type="text" class="form-control" name="customer_name" value="{{ $transaction->customer->name??'' }}" disabled>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="transaction_id" class="col-md-4 col-form-label text-md-right">{{ __('Transaction id') }}</label>
                                    <div class="col-md-6">
                                        <input id="transaction_id" type="number" class="form-control" name="transaction_id" value="{{ $transaction->id??'' }}" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                                    <div class="col-md-6">
                                        <input id="date" type="text" class="form-control" name="date" value="{{ $transaction->date??'' }}" disabled>
                                    </div>
                                </div>
                        @else
                             <form method="POST" action="{{ route('create_transaction',['customerId'=>$customer_id]) }}" aria-label="{{ __('Create') }}">
                        @endif
                            @csrf

                            <div class="form-group row">
                                <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                                <div class="col-md-6">
                                    <input id="amount" type="number" class="form-control{{ $errors->has('amount') ? ' is-invalid' : '' }}" name="amount" value="{{ old('amount')??$transaction->amount??'' }}" required autofocus>

                                    @if ($errors->has('amount'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        @if(isset($transaction))
                                            {{ __('Update') }}
                                        @else
                                            {{ __('Create') }}
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('transaction_update'))
        <script>
            alert('Transaction updated')
        </script>
    @endif
@endsection
