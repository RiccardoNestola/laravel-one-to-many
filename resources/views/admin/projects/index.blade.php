@extends('layouts.admin')
@section('title', 'Elenco - Progetti')
@section('content')
{{-- @include('admin.projects.partials.popup') --}}
<div class="container">

   
            <div class="d-flex">
              <div class="py-4 d-flex justify-content-between flex-grow-1">
                   <h3>Elenco Prodotti</h3>
              </div>
              <div class="py-4 d-flex">
                  <a class="btn btn-secondary btn-sm p-2 g-2 bs-info-text" href="{{ route ("admin.dashboard")}}">Dashboard</a>
                  <a class="btn btn-danger btn-sm p-2 ms-2" href="{{ route ("admin.projects.trashed")}}"><i class="fa-solid fa-trash p-1"></i>Cestino</a>
                  <a class="btn btn-success btn-sm ms-2" href="{{ route ("admin.projects.create")}}"><i class="fa-solid fa-plus text-white p-2"></i>Aggiungi nuovo</a>
              </div>
                
            </div>

            @if (session('alert-message'))
              <div id="popup_message" class="d-none" data-type="{{ session('alert-type') }}" data-message="{{ session('alert-message') }}"></div>
            @endif

            

            <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titolo</th>
                    <th scope="col" class="d-none d-md-table-cell">Descrizione</th>
                    <th scope="col" class="d-none d-md-table-cell">Categoria</th>
                    <th scope="col" class="d-none d-md-table-cell">Anno</th>
                    <th scope="col" class="d-none d-md-table-cell">Tecnologia</th>
                    <th scope="col" class="d-none d-md-table-cell">Data Progetto</th>
                    <th scope="col" class="d-none d-md-table-cell">Immagine</th>
                    <th scope="col" class="d-none d-md-table-cell"><i class="bi bi-pencil-fill"></i></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                  <tr>
                    <th scope="row">{{$project->id}}</th>
                    <td class="">{{$project->title}}</td>
                    <td class="d-none d-md-table-cell w-25">{{ Str::limit($project->description,50)}}</td>
                    <td class="d-none d-md-table-cell">{{$project->category}}</td>
                    <td class="d-none d-md-table-cell">{{$project->year}}</td>
                    <td class="d-none d-md-table-cell">{{$project->technology_used}}</td>
                    <td class="d-none d-md-table-cell w-25">{{$project->date_added}}</td>
                    {{-- <td class="d-none d-md-table-cell">
                      <img class="img-fluid rounded " src="{{ asset("storage/". $project->thumb  ) }}" alt="{{$project->title}}"></td>
                    <td> --}}
                    <td class="d-none d-md-table-cell">
                      @if (str_starts_with($project->thumb, 'http'))
                        <img src=" {{$project->thumb}}"
                        @else
                        <img src="{{asset('storage/'. $project->thumb)}}"
                        @endif
                        alt="{{$project->title}}" class="img-fluid rounded ">
                    <td>



                      <a href="{{ route("admin.projects.show", $project->id) }}" class="btn btn-primary btn-sm"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                    </td>
                    <td>
                      <form action="{{ route ("admin.projects.edit", $project->id) }}" method="GET">
                        
                        <button class="btn btn-warning btn-sm" type="submit"><i class="fa-solid fa-pen-to-square text-white"></i></button>
                      
                      </form>
                        
                    </td>
                    <td>
                        <form class="form-delete delete" data-element-name="{{ $project->title}}" action="{{ route('admin.projects.destroy', $project->id)}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button  class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              <div>
                  {{ $projects->links() }}
              </div>
             
        </div>

        

        
@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection