@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Item Details</div>
                <div class="card-body">
                  <dl class="row">

                <dt class="col-sm-3">Item No:</dt>
                <dd class="col-sm-9">{{ $item->item_no }}</dd>
                <dt class="col-sm-3">Item Name:</dt>
                <dd class="col-sm-9">{{ $item->item_description }}</dd>
              </dl>
                <div>
                <b>Contracts</b>
                @if(count($contracts) > 0)
                  <table class="table table-sm">
                    <thead>
                    <tr>
                      <th scope="col">Contract No</th>
                      <th scope="col">Date of Contract</th>
                      <th scope="col">Contract Price</th>
                      <th scope="col">Contract Amount</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                    @foreach($contracts as $contract)
                      <tr>
                        <td>{{ $contract->contract_no }}</td>
                        <td>{{ $contract->date_of_contract}}</td>
                        <td>{{ $contract->contract_price}}</td>
                        <td>{{ $contract->contract_amount}}</td>
                        <td><a href="/contract/{{ $contract->contract_no }}">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <p>No contracts for this item.</p>
                @endif
              </div><br>
              <div>
                <b>Orders</b>
                @if(count($orders) > 0)
                  <table class="table table-sm">
                    <tr>
                      <th scope="col">Order No</th>
                      <th scope="col">Contract No</th>
                      <th scope="col">Project No</th>
                      <th scope="col">Date Required</th>
                      <th scope="col">Date Completed</th>
                      <th scope="col">Order Quantity</th>
                      <th scope="col"></th>
                    </tr>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->contract_no}}</td>
                        <td>{{ $order->project_no}}</td>
                        <td>{{ $order->date_required}}</td>
                        <td>{{ $order->date_completed ? : "-"}}</td>
                        <td>{{ $order->order_qty}}</td>
                        <td><a href="/order/{{ $order->order_no }}">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <p>No orders for this item.</p>
                @endif
              </div>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
