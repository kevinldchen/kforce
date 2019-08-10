@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __('Items') }}</div>
                <table class="table">
                  <thead>
                  <tr>
                    <th scope="col">Item No</th>
                    <th scope="col">Item Description</th>
                    <th scope="col"><a href="/item/create">New</a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($items as $item)
                    <tr>
                      <td>{{ $item->item_no }}</td>
                      <td>{{ $item->item_description}}</td>
                      <td><a href="/item/{{ $item->item_no }}">View</a></td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
