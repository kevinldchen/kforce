@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Create Project</div>
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
                {{ Form::open(array('url' => 'project')) }}
                  <div class="form-group">
                    {{ Form::label('project_no', 'Project No') }}
                    {{ Form::number('project_no','',['class'=>'form-control']) }}
                  </div>
                  <div class="form-group">
                    {{ Form::label('project_data', 'Project Data') }}
                    {{ Form::text('project_data','',['class'=>'form-control']) }}
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
