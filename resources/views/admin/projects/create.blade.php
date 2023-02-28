@extends('layouts.admin')
@section('title', 'Crea nuovo progetto')
@section('content')

<div class="container">
    <div class="d-flex">
              <div class="py-4 d-flex justify-content-between">
                   <h3>Crea un nuovo progetto</h3>
              </div>
                
            </div>
    @include('admin.projects.partials.create_edit_form',['route'=> 'admin.projects.store','method'=>'POST', 'project'=> $project ])
</div>

@endsection