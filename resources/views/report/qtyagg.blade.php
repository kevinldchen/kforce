@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Order Totals by Contract and Item') }}</div>
                <table class="table table-hover">
                  <thead>
                  <tr>
                    <th scope="col">Contract No</th>
                    <th scope="col">Item No</th>
                    <th scope="col">Total Quantity Sold</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $datum)
                    <tr>
                      <td><a href="/contract/{{$datum->contract_no}}">{{ $datum->contract_no }}</a></td>
                      <td><a href="/item/{{$datum->item_no}}">{{ $datum->item_no }}</a></td>
                      <td>{{ $datum->sales }}</td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
