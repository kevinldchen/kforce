@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Create Supplier</div>
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
                {{ Form::open(array('url' => 'supplier')) }}
                <div class="form-group">
                    {{ Form::label('supplier_no', 'Supplier No') }}
                    {{ Form::number('supplier_no','',['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('supplier_name', 'Supplier Name') }}
                    {{ Form::text('supplier_name','',['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('supplier_address', 'Supplier Address') }}
                    {{ Form::textarea('supplier_address','',['class'=>'form-control']) }}
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
