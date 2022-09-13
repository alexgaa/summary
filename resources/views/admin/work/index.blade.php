@extends('admin.template.adminTemplate')
@extends('admin.work.headerTemplate')

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title text-bold">List all works</h3>
    </div>
    <div class="card-body">
        @if(!count($works))
            <p>Not found work!</p>
        @else
            <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th style="width: 170px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($works as $work)
            <tr>
                <td>{{$work->id}}</td>
                <td>{{$work->name}}</td>
                <td>{{$work->description}}</td>
                <td style="width: 170px">
                    <a href="{{route('work.edit', ["work"=>$work->id])}}"
                       class="btn btn-info btn-sm float-left mr-1">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                    </a>
                    <form action="{{route('work.destroy', ["work"=>$work->id])}}"
                          method="post" class="float-left mb-0">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you want delete Work?')">
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
        {{$works->links()}}
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection


