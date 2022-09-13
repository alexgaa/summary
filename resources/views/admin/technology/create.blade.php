@extends('admin.template.adminTemplate')
@extends('admin.technology.headerTemplate')

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold">Add new technology</h3>
    </div>
    <div class="card-body">
        <form action="{{route("technology.store")}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input name="name" type="text" id="name" class="form-control
                    @error('name')
                        border-danger
                    @enderror"
                    value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="comment" class="form-label">Comment:</label>
                <input name="comment" type="text" id="comment" class="form-control
                    @error('comment')
                        border-danger
                    @enderror"
                    value="{{old('comment')}}">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
            <a type="submit" href="{{route('technology.index')}}" class="btn btn-warning ml-3">Cancel</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection


