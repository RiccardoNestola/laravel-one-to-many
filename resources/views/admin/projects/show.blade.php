@extends('layouts.admin')
@section('title', 'Visualizza')
@section('content')
 <div class="container my-5">
  <div class="d-flex">
              <div class="py-4 d-flex justify-content-between">
                  <h2 class="text-uppercase">{{$project->title}}</h2>
              </div>
                
            </div>
        <div class="row">
          <div class="col-md-6">
            @if (str_starts_with($project->thumb, 'http'))
                        <img src=" {{$project->thumb}}"
                        @else
                        <img src="{{asset('storage/'. $project->thumb)}}"
                        @endif
                        alt="{{$project->title}}" class="img-fluid rounded ">
          </div>
          <div class="col-md-6">
            {{-- <h2 class="mb-3">{{$project->title}}</h2> --}}
            <h4>Descrizione</h4>
            </p> {{$project->description}}</p>
            <h4>Categoria</h4>
            <p>{{$project->category}}</p>
            <h4>Anno</h4>
            <p>{{$project->year}}</p>
            <h4>Tecnologia usata</h4>
            <p>{{$project->technology_used}}</p>
            <h4>Data Progetto</h4>
            <p>{{$project->date_added}}</p>
            <p class="fw-bold">ID:{{$project->id}}</p>
            

            <form class="d-inline-block" action="{{ route ("admin.projects.index") }}" method="GET">
                        
              <button class="btn btn-secondary btn-sm" type="submit"><i class="fa-solid fa-chevron-left text-white"></i></button>
            
            </form>


            <form class="d-inline-block" action="{{ route ("admin.projects.edit", $project->id) }}" method="GET">
                        
              <button class="btn btn-warning btn-sm" type="submit"><i class="fa-solid fa-pen-to-square text-white"></i></button>
            
            </form>


            <form class="d-inline-block form-delete delete" data-element-name="{{ $project->title}}" action="{{ route('admin.projects.destroy', $project->id)}}" method="POST">
              @csrf
              @method("DELETE")
              <button  class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-trash-can"></i></button>
            </form>
          </div>



        </div>
      </div>

@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection