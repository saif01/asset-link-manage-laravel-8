@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="float-right">
                    <a class="btn btn-success" href="{{ route('create') }}" > <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Asset</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible">
                {{ $message }}
            </div>
        @endif

        <input type="text" class="form-control my-2" id="searchArticles" onkeyup="searchArticles()"  placeholder="Search Here.....">
        
        
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="articles">
                <tr>
                    <th>URL</th>
                    <th>Doc-Type</th>
                    <th>Document</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($assets as $asset)
                <tr>
                    @if($asset->status == 1 )
                        <td>{{ url( "/documents/"."$asset->file") }}</td>
                    @else
                        <td class="text-muted">Unavailable</td>
                    @endif

                    <td>{{ $asset->doc_type }}</td>
                    
                    <td><img src="/documents/{{ $asset->file }}" height="70px"></td>
                    
                    <td>{{ $asset->name }}</td>
                    
                    @if($asset->status == 1 )
                        <td><a class="btn btn-success" href="{{ route('status',$asset->id) }}">Active</a></td>
                    @else
                        <td><a class="btn btn-warning" href="{{ route('status',$asset->id) }}">Inactive</a></td>
                    @endif

                    <td>
                        <form action="{{ route('delete',$asset->id) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('edit',$asset->id) }}"><i class="fas fa-edit"></i></a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        {{-- <div class="d-flex justify-content-center">
                {{ $assets->links() }}
        </div> --}}
    </div>
@endsection
