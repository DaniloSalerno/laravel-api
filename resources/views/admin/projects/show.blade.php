@extends('layouts.admin')

@section('content')

<div class="container">

    <div class="py-4 d-flex gap-3">

        <h2 class="text-muted text-uppercase">View of ID: {{$project->id}}</h2>
        
        <a href="{{ route('admin.projects.index') }}" class="text-decoration-none btn btn-primary d-flex justify-content-center align-items-center" >
            <i class="fa-solid fa-table-list"></i>
        </a>

        <a href=" {{route('admin.projects.edit', $project->slug)}} " class="btn btn-success d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-file-pen"></i>
        </a>

        <!-- Modal trigger button -->
        <button type="button" class="btn btn-danger d-flex justify-content-center align-items-center" data-bs-toggle="modal" data-bs-target="#modalId-{{$project->id}}">
            <i class="fa-solid fa-trash-can"></i>
        </button>
        <!-- Modal is here 👇 -->
        @include('admin.projects.partials.modal_delete')
        
    </div>

    <div class="row row-cols-1 row-cols-md-2">
        <div class="col">
            <div>
        
                <div class="card-body">
        
                    <div class="card-title">
                        <div class="badge text-bg-info">Nome del progetto</div>
                        <h2>{{$project->title}}</h2> 
                    </div>
            
                    <div class="card-subtitle py-4 text-muted ">
                        <div class="badge text-bg-info">Descrizione</div>
                        <h5>{{$project->description}}</h5>
                    </div>
            
                    <div class="card-text">
                        <div class="badge text-bg-info">Presentazione</div>
                        <p>{{$project->content}}</p>
                    </div>

                    
                    <div>
                        <span>Type: </span>
                        <span class="badge bg-primary">{{$project->type ? $project->type->name : 'Untypized'}}</span>
                    </div>

                    <div class="d-flex gap-2">
                        <span>Technologies:</span>
                        <ul class="list-unstyled">
                            @forelse ($project->technologies as $technology)
                                <li class="badge bg-primary">
                                    <i class="fas fa-tag fa-xs fa-fw" aria-hidden="true"></i>
                                    {{$technology->name}}
                                </li>
                            @empty
                                <li class="badge bg-primary">Unlabeled</li>
                            @endforelse
                        </ul>
                    </div>
            
                    <div class="links d-flex flex-column gap-2 py-4">
                        <a class="btn" href="{{$project->git_url}}" target="_blank">
                            <i class="fa-brands fa-github"></i>
                            View on GitHub
                        </a>
            
                        <a class="btn" href="{{$project->project_url}}" target="_blank">
                            <i class="fa-solid fa-globe"></i>
                            View projects page
                        </a>
                    </div>
        
                </div>
        
            </div>

        </div>

        <div class="col">
        <img width="400" class="img-fluid" src="{{$project->thumb}}" alt="">

        </div>
    </div>



</div>

@endsection