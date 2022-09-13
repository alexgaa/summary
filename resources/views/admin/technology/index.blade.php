@extends('admin.template.adminTemplate')
@extends('admin.technology.headerTemplate')

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title text-bold">List all technologies</h3>
    </div>
    <div class="card-body">
        @if(!count($technologies))
            <p>Not found technology!</p>
        @else
            <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Comment</th>
                <th style="width: 170px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($technologies as $technology)
            <tr>
                <td>{{$technology->id}}</td>
                <td>{{$technology->name}}</td>
                <td>{{$technology->comment}}</td>
                <td style="width: 170px">
                    <a href="{{route('technology.edit', ["technology"=>$technology->id])}}"
                       class="btn btn-info btn-sm float-left mr-1">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                    </a>
                    <form action="{{route('technology.destroy', ["technology"=>$technology->id])}}"
                          method="post" class="float-left mb-0">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you want delete Technology?')">
                            <i class="fas fa-trash-alt"></i>
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{$technologies->links()}}
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection


