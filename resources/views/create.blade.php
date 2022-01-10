@extends('layouts.app')

 

@section('content')

    <div class="d-flex justify-content-between">
        <div>
            <h4>Add New Asset</h4>
        </div>

        <div>
            <a class="btn btn-outline-dark" href="{{ route('home') }}"> Back</a>
        </div>
    </div>

   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="font-weight-bold">File:</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <div class="form-group">
            <label class="font-weight-bold">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter a name" required>
        </div>


        <button type="submit" class="btn btn-success w-100 mt-2">Submit</button>
        
    </form>
@endsection