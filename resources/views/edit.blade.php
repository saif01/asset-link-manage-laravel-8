@extends('layouts.app')

 

@section('content')
    <div class="d-flex justify-content-between">
        <div>
            <h4>Edit Asset</h2>
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

  

    <form action="{{ route('update',$assets->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" placeholder="Enter a name" value="{{ $assets->name }}">
        </div>

        <div class="form-group">
            <label>File:</label>
            <input type="file" name="file" class="form-control mb-2" accept="{{"image/".$assets->doc_type}}">
            <img src="/documents/{{ $assets->file }}" width="100px">
        </div>

        <button type="submit" class="btn btn-success w-100 mt-2">Submit</button>
            
    </form>
@endsection