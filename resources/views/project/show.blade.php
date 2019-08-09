@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Project Details') }}</div>
                <div class="card-body">
                <dl class="row">

                <dt class="col-sm-3">Project No:</dt>
                <dd class="col-sm-9">{{ $project->project_no }}</dd>
                <dt class="col-sm-3">Project Data:</dt>
                <dd class="col-sm-9">{{ $project->project_data }}</dd>
              </dl>
                <div>
                  <b>Orders</b>
                  @if(count($orders) > 0)
                    <table class="table table-sm">
                      <thead>
                      <tr>
                        <th scope="col">Order No</th>
                        <th scope="col">Project No</th>
                        <th scope="col">Date Required</th>
                        <th scope="col">Date Completed</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                      @foreach($orders as $order)
                        <tr>
                          <td>{{ $order->order_no }}</td>
                          <td>{{ $order->contract_no}}</td>
                          <td>{{ $order->date_required}}</td>
                          <td>{{ $order->date_completed ? : "-"}}</td>
                          <td><a href="/order/{{ $order->order_no }}">View</a></td>
                        </tr>
                      @endforeach
                    </table>
                  @else
                    <br>No orders for this projects.
                  @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
