@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Projects') }}</div>
                <table class="table">
                  <thead>
                  <tr>
                    <th scope="col">Project No</th>
                    <th scope="col">Project Data</th>
                    <th scope="col"><a href="/project/create">New</a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($projects as $project)
                    <tr>
                      <td>{{ $project->project_no }}</td>
                      <td>{{ $project->project_data}}</td>
                      <td><a href="/project/{{ $project->project_no }}">View</a></td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
