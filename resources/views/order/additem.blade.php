@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Add Items') }}</div>
                <div class="card-body">
                  @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  @if(session()->has('message'))
                  <div class="alert alert-success">
                    {{ session()->get('message') }}
                  </div>
                  @endif

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
                  <dd class="col-sm-9">{{ $order->date_completed? : "-" }}</dd>
                </dl>

                {{ Form::open(array('url' => 'order/'.$order->order_no.'/additem')) }}

                <div class="form-group row">
                  {{ Form::label('item_no', 'Item',['class'=>'col-sm-3 col-form-label']) }}
                  <div class="col-sm-6">
                    {{ Form::select('item_no',$items_ddl,'',['class'=>'form-control']) }}
                  </div>
                </div>
                <div class="from-group row">
                  {{ Form::label('order_qty', 'Order Quantity',['class'=>'col-sm-3 col-form-label']) }}
                  <div class="col-sm-6">
                    {{ Form::number('order_qty',1,['class'=>'form-control'])}}
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                  {{ Form::submit('Add',['class'=>'btn btn-primary']) }}
                  </div>
                </div>
                {{ Form::close() }}


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
                  <p>No items for this order.</p>
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
