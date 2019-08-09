@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Create Order</div>
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

                {{ Form::open(array('url' => 'order')) }}
                <div class="form-group">
                  {{ Form::label('order_no', 'Order No') }}
                    {{ Form::number('order_no','',['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                  {{ Form::label('date_required', 'Date Required') }}
                    <input type="date" name="date_required" id="date_required" value="{{ old('date_required') }}" class="form-control">
                </div>
                <div class="form-group">
                  {{ Form::label('project_no', 'Project No') }}
                    {{ Form::select('project_no',$projects,'',['class'=>'form-control']) }}
                </div>
                <div class="form-group">
                  {{ Form::label('contract_no', 'Contract No') }}
                    {{ Form::select('contract_no',$contracts,'',['class'=>'form-control']) }}
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
