@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Suppliers') }}</div>
                <table>
                  <tr><th>Supplier No</th><th>Supplier Name</th><th>Supplier Address</th><th>Details</th></tr>
                  @foreach($suppliers as $supplier)
                    <tr>
                      <td>{{ $supplier->supplier_no }}</td>
                      <td>{{ $supplier->supplier_name}}</td>
                      <td>{{ $supplier->supplier_address}}</td>
                      <td>[<a href="/supplier/{{ $supplier->supplier_no }}">View</a>]</td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
