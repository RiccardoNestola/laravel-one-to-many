@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Dashboard') }}
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div>
                        <p><strong> Benvenuto, </strong> {{  $user->name }}</p>
                    </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{route("admin.projects.index")}}" class="btn btn-secondary me-md-2 btn-sm" type="button">Visualizza i tuoi progetti</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
