@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $supplier->supplier_name }}</div>
                <b>Supplier No:</b>
                {{ $supplier->supplier_no }}
                <b>Supplier Name:</b>
                {{ $supplier->supplier_name }}
                <b> Supplier Address:</b>
                {{ $supplier->supplier_address }}
                <br><br>
                <b>Contracts</b>
                @if($supplier->contracts->count() > 0)
                  <table>
                    <tr><th>Contract No</th><th>Date of Contract</th></tr>
                    @foreach($supplier->contracts as $contract)
                      <tr>
                        <td>{{ $contract->contract_no }}</td>
                        <td>{{ $contract->date_of_contract}}</td>
                        <td>[<a href="/contract/{{ $contract->contract_no }}">View</a>]</td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  No contracts for this supplier.
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
