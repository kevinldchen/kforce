@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Suppliers') }}</div>
                <table class="table">
                  <thead>
                  <tr>
                    <th scope="col">Supplier No</th>
                    <th scope="col">Supplier Name</th>
                    <th scope="col">Supplier Address</th>
                    <th scope="col"><a href="/supplier/create">New</a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($suppliers as $supplier)
                    <tr>
                      <td>{{ $supplier->supplier_no }}</td>
                      <td>{{ $supplier->supplier_name}}</td>
                      <td>{{ $supplier->supplier_address}}</td>
                      <td><a href="/supplier/{{ $supplier->supplier_no }}">View</a></td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
