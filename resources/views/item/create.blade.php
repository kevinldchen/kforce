@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Item</div>
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
                    <b>{{ Form::label('item_no', 'Item No') }}</b>
                    {{ Form::number('item_no') }}<br>
                    <b>{{ Form::label('item_description', 'Item Description') }}</b>
                    {{ Form::text('item_description') }}<br>
                    {{ Form::submit('Create') }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
