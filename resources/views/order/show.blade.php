@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Order Details') }}</div>
                <b>Order No:</b>
                {{ $order->order_no }}
                <b>Contract No:</b>
                {{ $order->contract_no }}
                <b>Project No:</b>
                {{ $order->project_no }}
                <b>Date Required:</b>
                {{ $order->date_required }}
                <b>Date Completed:</b>
                {{ $order->date_completed }}
                <br><br>
                <b>Items</b>
                @if(count($items) > 0)
                  <table>
                    <tr><th>Item No</th><th>Item Description</th><th>Order Quantity</th></tr>
                    @foreach($items as $item)
                      <tr>
                        <td>{{ $item->item_no }}</td>
                        <td>{{ $item->item_description}}</td>
                        <td>{{ $item->order_qty}}</td>
                        <td>[<a href="/item/{{ $item->item_no }}">View</a>]</td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  No items for this order.
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
