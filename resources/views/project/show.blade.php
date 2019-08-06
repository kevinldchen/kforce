@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Project Details') }}</div>
                <b>Project No:</b>
                {{ $project->project_no }}
                <b>Project Data:</b>
                {{ $project->project_data }}
                <br><br>
                <b>Orders</b><br>TBD
            </div>
        </div>
    </div>
</div>
@endsection
