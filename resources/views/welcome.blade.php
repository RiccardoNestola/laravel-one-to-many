@extends('layouts.app')
@section('content')


<section class="light">
	<div class="container py-2">
		<div class="h1 text-center text-dark" id="pageHeaderTitle">Portfolio</div>
@foreach ($projects as $project)
		<article class="postcard light blue">
			<a class="postcard__img_link" href="#">
				@if (str_starts_with($project->thumb, 'http'))
                        <img src=" {{$project->thumb}}"
                        @else
                        <img src="{{asset('storage/'. $project->thumb)}}"
                        @endif
                        alt="{{$project->title}}" class="postcard__img">
			</a>
			<div class="postcard__text tx-dark">
				<h1 class="postcard__title blue"><a href="#">{{$project->title}}</a></h1>
				<div class="postcard__subtitle small">
					<time datetime="2020-05-25 12:00:00">
						<i class="fas fa-calendar-alt mr-2"></i> <span>{{$project->date_added}}</span>
					</time>
				</div>
				<div class="postcard__bar"></div>
				<div class="postcard__preview-txt">{{ Str::limit($project->description,200)}}...</div>
				<ul class="postcard__tagbox">
					<li class="tag__item"><i class="fas fa-tag mr-2 px-1"></i>{{$project->category}}</li>
					<li class="tag__item"><i class="fa-regular fa-calendar px-1"></i>{{$project->year}}</li>
					<li class="tag__item play blue">
						<a href="#"><i class="fa-solid fa-microchip px-1"></i></i>{{$project->technology_used}}</a>
					</li>
				</ul>
			</div>
		</article>
@endforeach
		{{ $projects->links() }}
</section>
@endsection


