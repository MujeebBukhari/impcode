@extends('layout.default')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('workers.create.step.three.post') }}" method="post" >
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header">Step 3: Review Details</div>
   
                    <div class="card-body">
  
                            <table class="table">
                                <tr>
                                    <td>worker Name:</td>
                                    <td><strong>{{$worker->name}}</strong></td>
                                </tr>
                                <tr>
                                    <td>worker Amount:</td>
                                    <td><strong>{{$worker->amount}}</strong></td>
                                </tr>
                                <tr>
                                    <td>worker status:</td>
                                    <td><strong>{{$worker->status ? 'Active' : 'DeActive'}}</strong></td>
                                </tr>
                                <tr>
                                    <td>worker Description:</td>
                                    <td><strong>{{$worker->description}}</strong></td>
                                </tr>
                                <tr>
                                    <td>worker Stock:</td>
                                    <td><strong>{{$worker->stock}}</strong></td>
                                </tr>
                            </table>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('workers.create.step.two') }}" class="btn btn-danger pull-right">Previous</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection