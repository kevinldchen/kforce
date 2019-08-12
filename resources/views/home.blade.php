@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Dashboard</div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                      <tbody>
                        <tr>
                          <th scope="row">Suppliers</th>
                          <td><a href="{{route('supplier.index')}}">View All</a></td>
                          <td><a href="{{route('supplier.create')}}">Create New</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Items</th>
                          <td><a href="{{route('item.index')}}">View All</a></td>
                          <td><a href="{{route('item.create')}}">Create New</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Projects</th>
                          <td><a href="{{route('project.index')}}">View All</a></td>
                          <td><a href="{{route('project.create')}}">Create New</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Contracts</th>
                          <td><a href="{{route('contract.index')}}">View All</a></td>
                          <td><a href="{{route('contract.create')}}">Create New</a></td>
                        </tr>
                        <tr>
                          <th scope="row">Orders</th>
                          <td><a href="{{route('order.index',1)}}">View All</a></td>
                          <td><a href="{{route('order.create')}}">Create New</a></td>
                        </tr>
                      </tbody>
                    </table>
                    <div class="p-2"><strong>Reports</strong><br>
                      <a href="{{route('report.qtyagg')}}">Order Totals by Contract and Item</a></div>
            </div>
        </div>
    </div>
</div>
@endsection
