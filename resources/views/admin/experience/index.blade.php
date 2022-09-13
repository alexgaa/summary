@extends('admin.template.adminTemplate')
@extends('admin.experience.headerTemplate')

@section('content')
        <!-- Default box -->
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title text-bold">List all experience</h3>

                    </div>
                    <div class="card-body">

                        @if(!count($experiences))
                            <p class="text-bold text-blue">Not found Experience!</p>
                        @else
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Position</th>
                                <th style="width: 300px">Technologies</th>
                                <th style="width: 300px">Works</th>
                                <th style="width: 170px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($experiences as $experience)
                            <tr>
                                <td>{{$experience->id}}</td>
                                <td>{{$experience->start_date}}</td>
                                <td>{{$experience->end_date}}</td>
                                <td>{{$experience->position}}</td>
                                <td style="width: 300px">{{$experience->technologies->pluck('name')->join(', ')}}</td>
                                <td style="width: 300px">{{$experience->works->pluck('name')->join(', ')}}</td>
                                <td style="width: 170px">
                                    <a href="{{route('experience.edit', ["experience"=>$experience->id])}}"
                                       class="btn btn-info btn-sm float-left mr-1"
                                    >
                                        <i class="fas fa-pencil-alt"></i>
                                        Edit
                                    </a>
                                    <form action="{{route('experience.destroy', ["experience"=>$experience->id])}}"
                                          method="post" class="float-left mb-0"
                                    >
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you want delete Experience?')">
                                            <i class="fas fa-trash-alt"></i>
                                            Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        {{$experiences->links()}}
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!-- /.card -->
@endsection


