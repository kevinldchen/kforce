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
                <div>
                  <b>Orders</b>
                  @if(count($orders) > 0)
                    <table>
                      <tr><th>Order No</th><th>Project No</th><th>Date Required</th><th>Date Completed</th></tr>
                      @foreach($orders as $order)
                        <tr>
                          <td>{{ $order->order_no }}</td>
                          <td>{{ $order->contract_no}}</td>
                          <td>{{ $order->date_required}}</td>
                          <td>{{ $order->date_completed}}</td>
                          <td>[<a href="/order/{{ $order->order_no }}">View</a>]</td>
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
@endsection
