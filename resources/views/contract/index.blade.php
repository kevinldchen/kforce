@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Contracts') }}</div>
                <table class="table">
                  <thead>
                  <tr>
                    <th scope="col">Contract No</th>
                    <th scope="col">Supplier No</th>
                    <th scope="col">Date of Contract</th>
                    <th scope="col"><a href="/contract/create">New</a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($contracts as $contract)
                    <tr>
                      <td>{{ $contract->contract_no }}</td>
                      <td>{{ $contract->supplier_no? : "-"}}</td>
                      <td>{{ $contract->date_of_contract}}</td>
                      <td><a href="/contract/{{ $contract->contract_no }}">View</a></td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
