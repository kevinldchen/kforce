@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Supplier</div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session()->has('message'))
                <div class="alert alert-success">
                  {{ session()->get('message') }}
                </div>
                @endif

                Enter a new CONTRACT-NO with DATE-OF-CONTRACT together with the ITEM-NO,
                CONTRACT-PRICE, and CONTRACT-AMOUNT for all items in the contract. (infrequent)

                {{ Form::open(array('url' => 'supplier')) }}
                    <b>{{ Form::label('supplier_no', 'Supplier No') }}</b>
                    {{ Form::number('supplier_no') }}<br>
                    <b>{{ Form::label('supplier_name', 'Supplier Name') }}</b>
                    {{ Form::text('supplier_name') }}<br>
                    <b>{{ Form::label('supplier_address', 'Supplier Address') }}</b>
                    {{ Form::text('supplier_address') }}
                    {{ Form::submit('Create') }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
