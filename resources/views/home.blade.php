@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/supplier/index">Suppliers</a><br>
                    <a href="/item/index">Items</a><br>
                    <a href="/project/index">Project</a><br>
                    <a href="/contract/index">Contract</a><br>
                    <a href="/order/index">Order</a><br>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
