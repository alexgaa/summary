@extends('admin.template.adminTemplate')
@extends('admin.work.headerTemplate')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-bold">Edit work</h3>
        </div>
        <div class="card-body">
            <form action="{{route("work.update", ['work'=>$work->id])}}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input name="name" type="text" id="name" class="form-control
                        @error('name')
                            border-danger
                        @enderror"
                           value="{{$work->name}}"
                    >
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input name="description" type="text" id="description" class="form-control
                        @error('description')
                            border-danger
                        @enderror"
                           value="{{$work->comment}}">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a type="submit" href="{{route('work.index')}}" class="btn btn-warning ml-3">Cancel</a>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
