@extends('layouts.admin')

@section('content')
<div class="container">
    
    <h2 class="fs-4 text-secondary my-4">
        {{__('Welcome')}}  {{ Auth::user()->name }}
    </h2>

    <div class="row row-cols-sm-2 row-cols-md-3 g-5">
        <div class="col">
            <div class="card text-center hover_shadow">
                <a class="text-dark text-decoration-none" href="{{ route('admin.projects.index') }}">
                    <div class="card-header text-uppercase d-flex justify-content-center align-items-center gap-2">
                        <span>projects</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                            <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                          </svg>
                    </div>
                </a>
                    <div class="card-body">
                        
                        <div>
                            {{$total_projects}}
                        </div>  
                       
                    </div>
                    {{-- /.card-body --}}
                </div>
            
            {{-- /.card --}}
        </div>
        {{-- /.col --}}

        <div class="col">
            <div class="card text-center hover_shadow">
                <a class="text-dark text-decoration-none" href="##">
                    <div class="card-header text-uppercase">
                        users <i class="fa-solid fa-user-group fa-xs"></i>
                    </div>
                </a>

                <div class="card-body">
                    
                    <div>
                        {{$total_users}}
                    </div>

                   
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}

        <div class="col">
            <div class="card text-center hover_shadow">
                <a class="text-dark text-decoration-none" href="{{ route('admin.types.index') }}">
                    <div class="card-header text-uppercase">
                        Types <i class="fa-solid fa-font-awesome fa-xs"></i>
                    </div>
                </a>

                <div class="card-body">
                    
                    <div>
                        {{$total_types}}
                    </div>

                   
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}

        <div class="col">
            <div class="card text-center hover_shadow">
                <a class="text-dark text-decoration-none" href="{{ route('admin.technologies.index') }}">
                    <div class="card-header text-uppercase">
                        technologies <i class="fa-solid fa-laptop-code fa-xs"></i>
                    </div>
                </a>

                <div class="card-body">
                    
                    <div>
                        {{$total_technologies}}
                    </div>

                   
                </div>
                {{-- /.card-body --}}
            </div>
            {{-- /.card --}}
        </div>
        {{-- /.col --}}
    </div>
</div>
@endsection
