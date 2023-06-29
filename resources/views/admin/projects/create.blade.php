@extends("layouts.dashboard")

@section("title")
    Laravel Auth | Project Create
@endsection

@section("content")

  <h1>Create a new project</h1>

    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="m-3">
        <label for="project-title" class="form-label">Title</label>
        <input type="text"
          class="form-control" name="title" id="project-title" aria-describedby="helpId" placeholder="Insert title project">
      </div>

      <div class="m-3">
        <label for="" class="form-label">Content</label>
        <textarea class="form-control" name="content" id="project-content" rows="3" placeholder="Insert content project"></textarea>
      </div>

      <!-- <div class="m-3">
        <label for="project-title" class="form-label">Slug</label>
        <input type="text"
          class="form-control" name="slug" id="project-title" aria-describedby="helpId" placeholder="Insert slug">
      </div> -->

      <div class="m-3">
        <label for="project-cover-image" class="form-label">Cover Image</label>
        <input type="file" class="form-control" name="cover_image" id="project-cover-image" placeholder="" aria-describedby="fileHelpId">
      </div>

      <div class="m-3">
        <label for="projects-types" class="form-label">Tipologia</label>
        <select class="form-select form-select-lg @error ('types_id') is-invalid @enderror" name="type_id" id="projects-types">
          <option value="">Seleziona il tipo</option>
          @foreach ($types as $type)
            <option value="{{$type->id}}">{{ $type->name }}</option>
          @endforeach
        </select>
        <div>
          @error ("types_id")
            <div class="alert alert-danger">
              {{ $message }}
            </div>
          @enderror
        </div>
      </div>


      <div class="form-group m-3">
        @foreach ($technologies as $elem)
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $elem->id }}" id="project-checkbox-{{$elem->id}}">
            <label class="form-check-label" for="project-checkbox-{{$elem->id}}">
              {{$elem->name}}
            </label>
          </div>
        @endforeach
      </div>



      <button type="submit" class="btn btn-success">Create project</button>

    </form>


@endsection