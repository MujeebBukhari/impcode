@extends('layout.default')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{ route('workers.create.step.two.post') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">Step 2: Status & Stock</div>
  
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
                                <label for="description">worker Status</label><br/>
                                <label class="radio-inline"><input type="radio" name="status" value="1" {{{ (isset($worker->status) && $worker->status == '1') ? "checked" : "" }}}> Active</label>
                                <label class="radio-inline"><input type="radio" name="status" value="0" {{{ (isset($worker->status) && $worker->status == '0') ? "checked" : "" }}}> DeActive</label>
                            </div>
  
                            <div class="form-group">
                                <label for="description">worker Stock</label>
                                <input type="text"  value="{{{ $worker->stock ?? '' }}}" class="form-control" id="workerAmount" name="stock"/>
                            </div>
  
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-md-6 text-left">
                                <a href="{{ route('workers.create.step.one') }}" class="btn btn-danger pull-right">Previous</a>
                            </div>
                            <div class="col-md-6 text-right">
                                <button type="submit" class="btn btn-primary">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection