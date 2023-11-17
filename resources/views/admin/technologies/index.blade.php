@extends('layouts.admin')

@section('content')

<div class="container py-4">

        @include('admin.projects.partials.session_message')

        <h2 class="text-muted text-uppercase">Technologies table</h1>

        <div id="icons">
            <a class="btn btn-primary d-inline-flex align-items-center justify-items-center p-2" href="{{ route('admin.technologies.create') }}">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
        {{-- /#icons --}}

        <div class="pt-4"> {{$technologies->links('pagination::bootstrap-5')}} </div>

        <div class="shadow">
            <table class="table table-light table-hover table-striped table-bordered table align-middle">
                <thead>
                    <tr class="table-dark text-center">
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Created</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @forelse ($technologies as $technology)
    
                    <tr>
                        <td scope="row"> {{$technology->id}} </td>
                        <td> {{$technology->name}} </td>

                        <td class="text-center">
                             <div class="d-flex align-items-center justify-content-center gap-1">
                                <i class="fa-solid fa-calendar-days"></i>
                                {{$technology->created_at->format('d-m-Y')}}
                            </div>
                             <div class="d-flex align-items-center justify-content-center gap-1">
                                <i class="fa-regular fa-clock"></i>
                                {{$technology->created_at->format('H:i')}}
                            </div>
                        </td>
                        
                        <td>

                            <div class="d-flex justify-content-center gap-4">
                                {{-- <a href=" {{route('admin.technologies.show', $technology->slug)}} " class="btn btn-outline-primary">
                                    <i class="fa-solid fa-eye"></i>
                                </a>  --}}
                                <a href=" {{route('admin.technologies.edit', $technology->slug)}} " class="btn btn-outline-success">
                                    <i class="fa-solid fa-file-pen"></i>
                                </a> 
    
                                <!-- Modal trigger button -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalId-{{$technology->id}}">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                                <!-- Modal is here 👇 -->
                               
                                {{-- MODAL SENZA SOFT DELETE --}}
                                
                                <!-- Modal Body -->
                                <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                                <div class="modal fade" id="modalId-{{$technology->id}}" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId-{{$technology->id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">

                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title d-flex justify-content-center align-items-center gap-3 w-100" id="modalTitleId-{{$technology->id}}">
                                                    <i class="fa-solid fa-triangle-exclamation text-warning"></i> Warning <i class="fa-solid fa-triangle-exclamation text-warning"></i>
                                                </h5>
                                            </div>
                                            {{-- /.modal-header --}}

                                            <div class="modal-body text-center">
                                                Are you sure to delete?
                                            </div>
                                            {{-- /.modal-body --}}

                                            <div class="modal-footer d-flex justify-content-center align-items-center gap-3">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <form action="{{route('admin.technologies.destroy', $technology->slug)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Confirm</button>
                                                </form>

                                            </div>
                                            {{-- /.modal-footer --}}

                                        </div>
                                        {{-- /.modal-content --}}

                                    </div>
                                    {{-- /.modal-dialog --}}
                                    
                                </div>
                                {{-- /.modal --}}

                            </div>                            

                        </td>

                    </tr>
                        
                    @empty
                        No types yet
                    @endforelse

                </tbody>
            </table>
        </div>
        <div class="pt-4"> {{$technologies->links('pagination::bootstrap-5')}} </div>
</div>
    

@endsection