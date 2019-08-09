@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Orders</div>
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Order No</th>
                      <th scope="col">Contract No</th>
                      <th scope="col">Project No</th>
                      <th scope="col">Date Required</th>
                      <th scope="col">Date Completed</th>
                      <th scope="col"><a href="/order/create" class="btn btn-success btn-sm">New</a></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->order_no }}</td>
                      <td>{{ $order->contract_no}}</td>
                      <td>{{ $order->project_no}}</td>
                      <td>{{ $order->date_required}}</td>
                      <td>{{ $order->date_completed? : "-"}}</td>
                      <td><a href="/order/{{ $order->order_no }}" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
