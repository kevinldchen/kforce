@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Items') }}</div>
                <table>
                  <tr><th>Item No</th><th>Item Description</th><th>Details</th></tr>
                  @foreach($items as $item)
                    <tr>
                      <td>{{ $item->item_no }}</td>
                      <td>{{ $item->item_description}}</td>
                      <td>[<a href="/item/{{ $item->item_no }}">View</a>]</td>
                    </tr>
                  @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
