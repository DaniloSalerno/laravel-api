@extends('layouts.admin')

@section('content')

<div class="container py-4">

        @include('admin.projects.partials.session_message')

        <h2 class="text-muted text-uppercase">Projects table</h1>

        <div id="icons">
            <a class="btn btn-primary d-inline-flex align-items-center justify-items-center p-2" href="{{ route('admin.projects.create') }}">
                <i class="fa-solid fa-plus"></i>
            </a>
    
            <a class="btn btn-danger d-inline-flex align-items-center justify-items-center p-2" href="{{ route('admin.trash') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                    <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"/>
                  </svg>
            </a>
        </div>
        {{-- /#icons --}}

        <div class="pt-4"> {{$projects->links('pagination::bootstrap-5')}} </div>

        <div class="shadow">
            <table class="table table-light table-hover table-striped table-bordered table align-middle">
                <thead>
                    <tr class="table-dark text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Created</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse ($projects as $project)
    
                    <tr>
                        <td scope="row"> {{$project->id}} </td>
                        <td> {{$project->title}} </td>

                        <td>
    
                            <img width="100" class="img-fluid" src="{{$project->thumb}}" alt="">

                        </td>

                        <td> {{$project->description}} </td>

                        <td class="text-center">
                             <div class="d-flex align-items-center justify-content-center gap-1">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{$project->created_at->format('d-m-Y')}}
                            </div>
                             <div class="d-flex align-items-center justify-content-center gap-1">
                                <i class="fa-regular fa-clock"></i>
                                {{$project->created_at->format('H:i')}}
                            </div>
                        </td>
                        
                        <td>

                            <div class="d-flex gap-2">
                                <a href=" {{route('admin.projects.show', $project->slug)}} " class="btn btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a> 
                                <a href=" {{route('admin.projects.edit', $project->slug)}} " class="btn btn-outline-success">
                                    <i class="fa-solid fa-file-pen"></i>
                                </a> 
    
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$project->id}}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <!-- Modal is here 👇 -->
                                @include('admin.projects.partials.modal_delete')

                            </div>                            

                        </td>

                    </tr>
                        
                    @empty
                        No projects yet
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="pt-4"> {{$projects->links('pagination::bootstrap-5')}} </div>
</div>
    

@endsection