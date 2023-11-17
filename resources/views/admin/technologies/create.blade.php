@extends('layouts.admin')

@section('content')

<section class="create col-10 mx-auto">

    <div class="container">

        <div class="py-4">
            <h2 class="text-muted text-uppercase">Add a new Technology</h2>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{$error}} </li>
                    @endforeach
                </ul>
            </div>
        @endif



        <form action=" {{route('admin.technologies.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row row-cols-1 row-cols-md-2">
                <div class="col">
                    <div>
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="" aria-describedby="helpId" value="{{old('name')}}" required>
                        <small id="nameHelper" class="text-muted">Type a name of Technology</small>
                        @error('name')
                            <div class="text-danger"> {{$message}} </div>
                        @enderror
                    </div>
                </div>
                <!-- /.col -->
            </div>
            
            <div class="py-4">
                <a class="text-decoration-none btn btn-primary" href="{{ route('admin.technologies.index') }}">
                    <i class="fa-solid fa-left-long"></i>
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>
    
        </form>
    </div>
</section>


@endsection