@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Create Item</div>
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
                {{ Form::open(array('url' => 'item')) }}
                <div class="form-group">
                    {{ Form::label('item_no', 'Item No') }}
                    {{ Form::number('item_no','',['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('item_description', 'Item Description') }}
                    {{ Form::text('item_description','',['class'=>'form-control']) }}
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
