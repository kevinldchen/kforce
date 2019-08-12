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
                    <dt class="col-sm-3">Contract No:</dt>
                    <dd class="col-sm-9">{{ $contract->contract_no }}</dd>

                    <dt class="col-sm-3">Date of Contract:</dt>
                    <dd class="col-sm-9">{{ $contract->date_of_contract }}</dd>

                    <dt class="col-sm-3">Supplier No:</dt>
                    @if($contract->supplier_no)
                      <dd class="col-sm-9"><a href="/supplier/{{$contract->supplier_no}}">{{ $contract->supplier_no ? : "-" }}</a></dd>
                    @else
                      <dd class="col-sm-9">-</dd>
                    @endif
                    <dt class="col-sm-3">Supplier Name:</dt>
                    <dd class="col-sm-9">{{ $contract->supplier_name ? : "-" }}</dd>

                    <dt class="col-sm-3">Supplier Address:</dt>
                    <dd class="col-sm-9">{!! nl2br(e($contract->supplier_address? : "-")) !!}</dd>
                  </dl>

                {{ Form::open(array('url' => 'contract/'.$contract->contract_no.'/additem')) }}

                <div class="form-group row">
                  {{ Form::label('item_no', 'Item',['class'=>'col-sm-3 col-form-label']) }}
                  <div class="col-sm-6">
                    {{ Form::select('item_no',$items_ddl,'',['class'=>'form-control']) }}
                  </div>
                </div>
                <div class="form-group row">
                  {{ Form::label('contract_price', 'Contract Price',['class'=>'col-sm-3 col-form-label']) }}
                  <div class="col-sm-6">
                  {{ Form::number('contract_price','',['class'=>'form-control']) }}
                </div>
                </div>
                <div class="form-group row">
                  {{ Form::label('contract_amount', 'Contract Amount',['class'=>'col-sm-3 col-form-label']) }}
                  <div class="col-sm-6">
                  {{ Form::number('contract_amount','',['class'=>'form-control']) }}
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
                  <p>No items for this contract.</p>
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
