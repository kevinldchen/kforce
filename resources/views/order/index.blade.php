@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Orders</div>
                <div class="card-body mb-0 pb-0">
                <nav aria-label="...">
                  <ul class="pagination justify-content-end">
                    <li class="page-item">
                      <a class="page-link" href="/order/index/1" tabindex="-1">First</a>
                    </li>
                    @for($i=0; $i<$nav_size; $i++)
                      @if(($nav_offset + $i) == $current_page)
                      <li class="page-item active">
                        <a class="page-link" href="/order/index/{{$current_page}}">{{$current_page}}<span class="sr-only">(current)</span></a>
                      @else
                        <li class="page-item"><a class="page-link" href="/order/index/{{$nav_offset + $i}}">{{($nav_offset + $i)}}</a></li>
                      @endif
                    </li>
                    @endfor
                    <li class="page-item">
                      <a class="page-link" href="/order/index/{{$num_pages}}">Last</a>
                    </li>
                  </ul>
                </nav>
              </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Order No</th>
                      <th scope="col">Contract No</th>
                      <th scope="col">Project No</th>
                      <th scope="col">Date Required</th>
                      <th scope="col">Date Completed</th>
                      <th scope="col"><a href="/order/create">New</a></th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($orders as $order)
                    <tr>
                      <td>{{ $order->order_no }}</td>
                      <td>{{ $order->contract_no}}</td>
                      <td>{{ $order->project_no}}</td>
                      <td>{{ $order->date_required}}</td>
                      <td>{{ $order->date_completed? : "-"}}</td>
                      <td><a href="/order/{{ $order->order_no }}">View</a></td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
