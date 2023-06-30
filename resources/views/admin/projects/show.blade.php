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


@endsection