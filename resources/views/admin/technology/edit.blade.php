@extends('admin.template.adminTemplate')
@extends('admin.technology.headerTemplate')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-bold">Edit technology</h3>
        </div>
        <div class="card-body">
            <form action="{{route("technology.update", ['technology'=>$technology->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input name="name" type="text" id="name" class="form-control
                        @error('name')
                            border-danger
                        @enderror"
                           value="{{$technology->name}}"
                    >
                </div>
                <div class="mb-3">
                    <label for="comment" class="form-label">Comment:</label>
                    <input name="comment" type="text" id="comment" class="form-control
                        @error('comment')
                            border-danger
                        @enderror"
                           value="{{$technology->comment}}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a type="submit" href="{{route('technology.index')}}" class="btn btn-warning ml-3">Cancel</a>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection


