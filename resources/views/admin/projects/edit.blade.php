@extends('layouts.admin')
@section('title', 'Modifica')
@section('content')

<div class="container">
    <div class="d-flex">
              <div class="py-4 d-flex justify-content-between">
                   <h3>Modifica progetto</h3>
              </div>
                
            </div>
    @include('admin.projects.partials.create_edit_form',['route'=> 'admin.projects.update', 'method'=> 'PUT', "project"=> $project])
</div>

@endsection

@section('script')
    @vite('resources/js/confirmDelete.js')
@endsection