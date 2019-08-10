@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Order Details') }}</div>
                <div class="card-body">
                  <dl class="row">
                <dt class="col-sm-3">Order No:</dt>
                <dd class="col-sm-9">{{ $order->order_no }}</dd>
                <dt class="col-sm-3">Contract No:</dt>
                <dd class="col-sm-9"><a href="/contract/{{$order->contract_no}}">{{ $order->contract_no }}</a></dd>
                <dt class="col-sm-3">Project No:</dt>
                <dd class="col-sm-9"><a href="/project/{{$order->project_no}}">{{ $order->project_no }}</a></dd>
                <dt class="col-sm-3">Date Required:</dt>
                <dd class="col-sm-9">{{ $order->date_required }}</dd>
                <dt class="col-sm-3">Date Completed:</dt>
                <dd class="col-sm-9">{{ $order->date_completed ? : "-"}}</dd>
                </dl>
                <b>Items</b>
                @if(count($items) > 0)
                  <table class="table table-sm">
                    <thead>
                    <tr>
                      <th scope="col">Item No</th>
                      <th scope="col">Item Description</th>
                      <th scope="col">Order Quantity</th>
                      <th scope="col">Item Price</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                    @foreach($items as $item)
                      <tr>
                        <td>{{ $item->item_no }}</td>
                        <td>{{ $item->item_description}}</td>
                        <td>{{ $item->order_qty}}</td>
                        <td>{{ $item->contract_price}}</td>
                        <td><a href="/item/{{ $item->item_no }}">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <p>No items for this order.</p>
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
