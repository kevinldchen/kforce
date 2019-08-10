@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Supplier Details</div>
                <div class="card-body">
                  <dl class="row">
                <dt class="col-sm-3">Supplier No:</dt>
                <dd class="col-sm-9">{{ $supplier->supplier_no }}</dd>

                <dt class="col-sm-3">Supplier Name:</dt>
                <dd class="col-sm-9">{{ $supplier->supplier_name }}</dd>

                <dt class="col-sm-3">Supplier Address:</dt>
                <dd class="col-sm-9">{!! nl2br(e($supplier->supplier_address)) !!}</dd>
                </dl>
                <b>Contracts</b>
                @if(count($contracts) > 0)
                  <table class="table table-sm">
                    <thead>
                    <tr>
                      <th scope="col">Contract No</th>
                      <th scope="col">Date of Contract</th>
                      <th scope="col"></th>
                    </tr>
                    </thead>
                    @foreach($contracts as $contract)
                      <tr>
                        <td>{{ $contract->contract_no }}</td>
                        <td>{{ $contract->date_of_contract}}</td>
                        <td><a href="/contract/{{ $contract->contract_no }}">View</a></td>
                      </tr>
                    @endforeach
                  </table>
                @else
                  <p>No contracts for this supplier.</p>
                @endif
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
