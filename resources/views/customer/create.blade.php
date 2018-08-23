@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Customer</div>
                    <section class="creditly-wrapper gray-theme">
                        <form method="POST" action="{{ route('create_customer') }}" aria-label="{{ __('Create') }}">
                            @csrf
                            <div class="credit-card-wrapper">
                                <div class="first-row form-group">
                                    <div class="col-sm-8 controls form-group">
                                        <label class="control-label">Card Number</label>
                                        <input class="number credit-card-number form-control"
                                               type="text" name="pan"
                                               pattern="\d*"
                                               value="{{ old('pan') }}"
                                               inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"
                                               placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
                                        @if ($errors->has('pan'))
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong>{{ $errors->first('pan') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-4 controls form-group">
                                        <label class="control-label">CVV</label>
                                        <input class="security-code form-control"·
                                               value="{{ old('cvv2') }}"
                                               inputmode="numeric"
                                               pattern="\d*"
                                               type="text" name="cvv2"
                                               placeholder="&#149;&#149;&#149;">
                                        @if ($errors->has('cvv2'))
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong>{{ $errors->first('cvv2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="second-row form-group">
                                    <div class="col-sm-8 controls form-group">
                                        <label class="control-label">Name on Card</label>
                                        <input class="billing-address-name form-control"
                                               value="{{ old('name') }}"
                                               type="text" name="name"
                                               placeholder="John Smith">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert" style="display: block;">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-sm-4 controls form-group">
                                        <label class="control-label">Expiration</label>
                                        <input class="expiration-month-and-year form-control"
                                               value="{{ old('expired') }}"
                                               type="text" name="expired"
                                               placeholder="MM / YY">
                                        @if ($errors->has('expired'))
                                            <span class="invalid-feedback" role="alert" style="display: block;" >
                                                <strong>{{ $errors->first('expired') }}</strong>
                                             </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                             <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </section>



            </div>
        </div>
    </div>
</div>
@endsection
