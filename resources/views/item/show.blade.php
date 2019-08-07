@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $item->item_description }}</div>
                <b>Item No:</b>
                {{ $item->item_no }}
                <b>Item Name:</b>
                {{ $item->item_description }}
                <br><br>
                <div>
                <b>Contracts</b>
                @if(count($contracts) > 0)
                  <table>
                    <tr><th>Contract No</th><th>Date of Contract</th><th>Contract Price</th><th>Contract Amount</th></tr>
                    @foreach($contracts as $contract)
                      <tr>
                        <td>{{ $contract->contract_no }}</td>
                        <td>{{ $contract->date_of_contract}}</td>
                        <td>{{ $contract->contract_price}}</td>
                        <td>{{ $contract->contract_amount}}</td>
                        <td>[<a href="/contract/{{ $contract->contract_no }}">View</a>]</td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <br>No contracts for this item.
                @endif
              </div><br>
              <div>
                <b>Orders</b>
                @if(count($orders) > 0)
                  <table>
                    <tr><th>Order No</th><th>Contract No</th><th>Project No</th><th>Date Required</th><th>Date Completed</th><th>Order Quantity</th></tr>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->contract_no}}</td>
                        <td>{{ $order->project_no}}</td>
                        <td>{{ $order->date_required}}</td>
                        <td>{{ $order->date_completed}}</td>
                        <td>{{ $order->order_qty}}</td>
                        <td>[<a href="/order/{{ $order->order_no }}">View</a>]</td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <br>No orders for this item.
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
