@extends('layouts.admin')

@section('content')

<section class="create col-10 mx-auto">
    <div class="container">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{$error}} </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="py-4">
            <h2 class="text-muted text-uppercase">Edit Type: {{$type->name}}</h2>
        </div>


        <form action=" {{route('admin.types.update', $type)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
    
            <div class="row row-cols-1 row-cols-md-2">

                <div class="col">
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value=" {{old('name', $type->name)}}" required>
                        <small id="nameHelper" class="text-muted">Type a name of Type</small>
                        @error('name')
                            <div class="text-danger"> {{$message}} </div>
                        @enderror
                    </div>
                </div>
                <!-- /.col -->
            </div>

            

            <div class="py-4">
                <a class="text-decoration-none btn btn-primary" href="{{ route('admin.types.index') }}">
                    <i class="fa-solid fa-table-list"></i>
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa-regular fa-square-check fa-lg"></i>
                </button>
            </div>
    
        </form>
    </div>
</section>


@endsection