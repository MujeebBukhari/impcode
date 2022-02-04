@extends('layout.default')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('workers.create.step.one.post') }}" method="POST">
                @csrf
  
                <div class="card">
                    <div class="card-header">Step 1: Basic Info</div>
  
                    <div class="card-body">
  
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
  
                            <div class="form-group">
                                <label for="title">Worker Name:</label>
                                <input type="text" value="{{ $Worker->name ?? '' }}" class="form-control" id="taskTitle"  name="name">
                            </div>
                            <div class="form-group">
                                <label for="description">Worker Amount:</label>
                                <input type="text"  value="{{{ $Worker->amount ?? '' }}}" class="form-control" id="WorkerAmount" name="amount"/>
                            </div>
   
                            <div class="form-group">
                                <label for="description">Worker Description:</label>
                                <textarea type="text"  class="form-control" id="taskDescription" name="description">{{{ $Worker->description ?? '' }}}</textarea>
                            </div>
                          
                    </div>
  
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection