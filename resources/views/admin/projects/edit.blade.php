@extends("layouts.dashboard")

@section("title")
    Laravel Auth | Project Edit
@endsection

@section("content")

    <h1>Edit Project: {{$project->title}}</h1>

    @if ($errors->any() )
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $elem)
            <li>{{$elem}}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="m-3">
          <label for="project-title" class="form-label">Title</label>
          <input type="text"
            class="form-control" name="title" id="project-title" aria-describedby="helpId" value="{{ old('title') ?? $project->title}}">
        </div>

        <div class="m-3">
          <label for="" class="form-label"></label>
          <textarea class="form-control" name="content" id="project-content" rows="3">{{ old('content') ?? $project->content}}</textarea>
        </div>

        <div class="m-3">
          <label for="project_cover_image" class="form-label">Cover Image</label>
          <input type="file" class="form-control" name="cover_image" id="project_cover_image" placeholder="" aria-describedby="fileHelpId">
        </div>

        <button class="btn btn-success">Create project</button>

    </form>


@endsection