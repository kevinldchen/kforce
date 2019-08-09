@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Create Contract</div>
                <div class="card-body">
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
                  <div class="form-group">
                    {{ Form::label('contract_no', 'Contract No') }}
                    {{ Form::number('contract_no','',['class'=>'form-control']) }}
                  </div>
                  <div class="form-group">
                    {{ Form::label('date_of_contract', 'Date of Contract') }}
                    <input type="date" name="date_of_contract" id="date_of_contract" value="{{ old('date_of_contract') }}" class="form-control">
                  </div>
                  <div class="form-group">
                    {{ Form::label('item_no', 'Item No') }}
                    {{ Form::select('item_no',$items,'',['class'=>'form-control']) }}
                  </div>
                  <div class="form-group">
                    {{ Form::label('contract_price', 'Contract Price') }}
                    {{ Form::number('contract_price','',['class'=>'form-control']) }}
                  </div>
                  <div class="form-group">
                    {{ Form::label('contract_amount', 'Contract Amount') }}
                    {{ Form::number('contract_amount','',['class'=>'form-control']) }}
                  </div>
                  <div class="col text-center">
                    {{ Form::submit('Create',['class'=>'btn btn-success']) }}
                  </div>
                {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
