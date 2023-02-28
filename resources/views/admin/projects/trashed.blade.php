@extends('layouts.admin')
@section('title', 'Cestino')
@section('content')
<div class="container">
            <div class="d-flex">
              <div class="py-4 d-flex justify-content-between flex-grow-1">
                   <h3>Cestino</h3>
              </div>
              <div class="py-4 d-flex">
                <a class="btn btn-secondary btn-sm p-2 g-2" href="{{ route ("admin.projects.index")}}">Indietro</a>
                <a class="btn btn-danger btn-sm p-2 ms-2 position-relative" href="{{ route ("admin.projects.trashed")}}"><i class="fa-solid fa-trash p-1"></i>Cestino
                
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary">
                      {{count($projects)}}
                    </span>
                </a>
                {{-- <a class="btn btn-success btn-sm ms-2" href="{{ route ("admin.projects.create")}}"><i class="fa-solid fa-trash-can-arrow-up p-2"></i>Ripristina tutto</a> --}}


                @if (count($projects))
                  <form class="d-inline delete double-confirm" action="{{route('admin.restore-all')}}" method="POST" > @csrf
                    <button type="submit" class="btn btn-success btn-sm p-2 ms-2" title="restore all"><i class="fa-solid fa-recycle p-1"></i>Ripristina tutto</button>
                  </form>            
                @endif                   

              </div>
                
            </div>


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
                  {{--  <th scope="col" class="d-none d-md-table-cell">Immagine</th> --}}
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
                    <td class="d-none d-md-table-cell">{{$project->date_added}}</td>
{{--                     <td class="d-none d-md-table-cell"><img class="img-fluid rounded " src="{{$project->thumb}}" alt="{{$project->title}}"></td>
 --}}                
                    <td>
                      <form action="{{ route ("admin.projects.restore", $project->id) }}" method="GET">
                        
                        <button class="btn btn-success btn-sm" type="submit"><i class="fa-solid fa-trash-can-arrow-up"></i>Ripristina</button>
                      
                      </form>
                        
                    </td>
                    <td>
                        <form class="form-delete delete" data-element-name="{{ $project->title}}" action="{{ route('admin.projects.force-delete', $project->id )}}" method="post">
                          @csrf
                          @method('DELETE')
                          <button  class="btn btn-danger btn-sm" type="submit"><i class="fa-solid fa-trash"></i> Elimina</button>
                        </form>
                    </td>
                    @endforeach
                  </tr>
                </tbody>
              </table>
              {{ $projects->links() }}
        </div>


@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection