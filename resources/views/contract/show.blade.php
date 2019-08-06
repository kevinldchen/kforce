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
                <b>Items</b>
                @if($contract->items->count() > 0)
                  <table>
                    <tr><th>Item No</th><th>Item Description</th><th>Contract Price</th><th>Contract Amount</th></tr>
                    @foreach($contract->items as $item)
                      <tr>
                        <td>{{ $item->item_no }}</td>
                        <td>{{ $item->item_description}}</td>
                        <td>{{ $item->tosupply->contract_price}}</td>
                        <td>{{ $item->tosupply->contract_amount}}</td>
                        <td>[<a href="/item/{{ $item->item_no }}">View</a>]</td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  No items for this contract.
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
