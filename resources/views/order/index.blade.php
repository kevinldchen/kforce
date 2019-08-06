@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>
                <table>
                  <tr><th>Order No</th><th>Contract No</th><th>Project No</th><th>Date Required</th><th>Date Completed</th></tr>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->order_no }}</td>
                      <td>{{ $order->contract_no}}</td>
                      <td>{{ $order->project_no}}</td>
                      <td>{{ $order->date_required}}</td>
                      <td>{{ $order->date_completed}}</td>
                      <td>[<a href="/order/{{ $order->contract_no }}">View</a>]</td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
