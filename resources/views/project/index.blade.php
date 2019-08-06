@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Projects') }}</div>
                <table>
                  <tr><th>Project No</th><th>Project Data</th><th>Details</th></tr>
                  @foreach($projects as $project)
                    <tr>
                      <td>{{ $project->project_no }}</td>
                      <td>{{ $project->project_data}}</td>
                      <td>[<a href="/project/{{ $project->project_no }}">View</a>]</td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
