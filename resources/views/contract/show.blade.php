@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Contract Details') }}</div>
                <div class="card-body">
                <dl class="row">
                  <dt class="col-sm-3">Contract No:</dt>
                  <dd class="col-sm-9">{{ $contract->contract_no }}</dd>

                  <dt class="col-sm-3">Date of Contract:</dt>
                  <dd class="col-sm-9">{{ $contract->date_of_contract }}</dd>

                  <dt class="col-sm-3">Supplier No:</dt>
                  <dd class="col-sm-9"><a href="/supplier/{{$contract->supplier_no}}">{{ $contract->supplier_no }}</a></dd>

                  <dt class="col-sm-3">Supplier Name:</dt>
                  <dd class="col-sm-9">{{ $contract->supplier_name }}</dd>

                  <dt class="col-sm-3">Supplier Address:</dt>
                  <dd class="col-sm-9">{!! nl2br(e($contract->supplier_address)) !!}</dd>
                </dl>
                <div>
                <b>Items</b><br>
                @if(count($items) > 0)
                  <table class="table table-sm">
                    <thead>
                    <tr>
                      <th scope="col">Item No</th>
                      <th scope="col">Item Description</th>
                      <th scope="col">Contract Price</th>
                      <th scope="col">Contract Amount</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                    @foreach($items as $item)
                      <tr>
                        <td>{{ $item->item_no }}</td>
                        <td>{{ $item->item_description}}</td>
                        <td>{{ $item->contract_price}}</td>
                        <td>{{ $item->contract_amount}}</td>
                        <td><a href="/item/{{ $item->item_no }}">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <p>No items for this contract.</p>
                @endif
              </div><br>
              <div>
                <b>Fulfilling Orders:</b>
                @if(count($orders) > 0)
                  <table class="table table-sm">
                    <thead>
                    <tr>
                      <th scope="col">Order No</th>
                      <th scope="col">Item No</th>
                      <th scope="col">Project No</th>
                      <th scope="col">Date Required</th>
                      <th scope="col">Date Completed</th>
                      <th scope="col">Order Quantity</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                    @foreach($orders as $order)
                      <tr>
                        <td>{{ $order->order_no }}</td>
                        <td>{{ $order->item_no}}</td>
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
