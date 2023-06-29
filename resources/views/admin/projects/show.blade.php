@extends("layouts.dashboard")

@section("title")
    Laravel Auth | Project Show
@endsection

@section("content")

    <h1>Singolo project: {{ $project->title}}</h1>

    <img class="img-fluid" src="{{ asset('storage/' . $project->cover_image)}}" alt="">

    <p class="mt-3">
        {{ $project->content}}
    </p>

    <h2 class="mt-3">Projects</h2>
    @if( $project->project )
        <div>Name: {{ $project->project->name }}</div>
        <div>Slug: {{ $project->project->slug }}</div>
    @endif
    <h2 class="mt-3">Technologies</h2>

    @if( $project->technologies )
    	@foreach ( $project->technologies as $elem )
    		<div>Tag Name: {{ $elem->name }} </div>
    	@endforeach
    @endif

@endsection