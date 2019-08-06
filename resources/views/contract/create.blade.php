@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Contract</div>
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

                {{ Form::open(array('url' => 'contract')) }}
                    <b>{{ Form::label('contract_no', 'Contract No') }}</b>
                    {{ Form::number('contract_no') }}<br>
                    <b>{{ Form::label('date_of_contract', 'Date of Contract') }}</b>
                    <input type="date" name="date_of_contract" id="date_of_contract" value="{{ old('date_of_contract') }}"><br>
                    <b>{{ Form::label('item_no', 'Item No') }}</b>
                    {{ Form::number('item_no') }}<br>
                    <b>{{ Form::label('contract_price', 'Contract Price') }}</b>
                    {{ Form::number('contract_price') }}<br>
                    <b>{{ Form::label('contract_amount', 'Contract Amount') }}</b>
                    {{ Form::number('contract_amount') }}<br>
                    {{ Form::submit('Create') }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
