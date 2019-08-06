@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Contracts') }}</div>
                <table>
                  <tr><th>Contract No</th><th>Supplier No</th><th>Date of Contract</th><th>Details</th></tr>
                  @foreach($contracts as $contract)
                    <tr>
                      <td>{{ $contract->contract_no }}</td>
                      <td>{{ $contract->supplier_no}}</td>
                      <td>{{ $contract->date_of_contract}}</td>
                      <td>[<a href="/contract/{{ $contract->contract_no }}">View</a>]</td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
