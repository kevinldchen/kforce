@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Project</div>
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
                    <b>{{ Form::label('project_no', 'Project No') }}</b>
                    {{ Form::number('project_no') }}<br>
                    <b>{{ Form::label('project_data', 'Project Data') }}</b>
                    {{ Form::text('project_data') }}<br>
                    {{ Form::submit('Create') }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
