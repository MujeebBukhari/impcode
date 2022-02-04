@extends('layout.default')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Manage </div>
  
                <div class="card-body">
                      
                    <a href="{{ route('workers.create.step.one') }}" class="btn btn-primary pull-right">Create </a>
  
                    @if (Session::has('message'))
                        <div class="alert alert-info">{{ Session::get('message') }}</div>
                    @endif
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($workers as $worker)
                            <tr>
                                <th scope="row">{{$worker->id}}</th>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->description}}</td>
                                <td>{{$worker->stock}}</td>
                                <td>{{$worker->amount}}</td>
                                <td>{{$worker->status ? 'Active' : 'DeActive'}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 