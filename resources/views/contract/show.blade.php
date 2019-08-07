@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contract Details') }}</div>
                <b>Contract No:</b>
                {{ $contract->contract_no }}
                <b>Supplier No:</b>
                {{ $contract->supplier_no }}
                <b>Date of Contract:</b>
                {{ $contract->date_of_contract }}
                <br><br>
                <div>
                <b>Items</b><br>
                @if(count($items) > 0)
                  <table>
                    <tr><th>Item No</th><th>Item Description</th><th>Contract Price</th><th>Contract Amount</th></tr>
                    @foreach($items as $item)
                      <tr>
                        <td>{{ $item->item_no }}</td>
                        <td>{{ $item->item_description}}</td>
                        <td>{{ $item->contract_price}}</td>
                        <td>{{ $item->contract_amount}}</td>
                        <td>[<a href="/item/{{ $item->item_no }}">View</a>]</td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  No items for this contract.
                @endif
              </div><br>
              <div>
                <b>Fulfilling Orders:</b>
                @if(count($orders) > 0)
                  <table>
                    <tr><th>Order No</th><th>Item No</th><th>Project No</th><th>Date Required</th><th>Date Completed</th><th>Order Quantity</th></tr>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->item_no}}</td>
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
