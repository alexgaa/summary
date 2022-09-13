@extends('admin.template.adminTemplate')
@extends('admin.work.headerTemplate')

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold">Add new work</h3>
    </div>
    <div class="card-body">
        <form action="{{route("work.store")}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input name="name" type="text" id="name" class="form-control
                    @error('name')
                        border-danger
                    @enderror"                    value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <input name="description" type="text" id="description" class="form-control
                    @error('description')
                        border-danger
                    @enderror"
                    value="{{old('description')}}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a type="submit" href="{{route('work.index')}}" class="btn btn-warning ml-3">Cancel</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection


