@extends('admin.template.adminTemplate')
@extends('admin.experience.headerTemplate')

@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-bold">Sorting technologies</h3>
        </div>
        <div class="card-body">
            <form action="{{route("experience.sortingTechnologiesUpdate", ['id'=>$experience->id])}}" method="POST"
                  class="form-horizontal">
                @csrf
                <div class="card-body">
                     <div class="form-group row">
                        <label for="start_date" class="col-sm-2 col-form-label">Start Date :</label>
                        <div class="col-sm-10">
                        <input disabled name="start_date" type="date" id="start_date"
                               class="form-control" value="{{$experience->start_date}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="end_date" class="col-sm-2 col-form-label">End Date :</label>
                        <div class="col-sm-10">
                            <input disabled name="end_date" type="date" id="end_date"
                                   class="form-control" value="{{$experience->end_date}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="company_name" class="col-sm-2 col-form-label">Company :</label>
                        <div class="col-sm-10">
                            <input disabled name="company_name" type="text" id="company_name"
                                   class="form-control" value="{{$experience->company_name}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="position" class="col-sm-2 col-form-label">Position :</label>
                        <div class="col-sm-10">
                            <input disabled name="position" type="text" id="position"
                                   class="form-control" value="{{$experience->position}}">
                        </div>
                    </div>

                    <div class="form-group ">
                        <p class="bg-primary p-1 ">Technologies</p>
                        <div class="form-group row mb-0">
                            <div class="col-sm-2">
                                <p class="text-bold mb-1">Technology Name</p>
                            </div>
                            <div class="col-sm-1">
                                <p class="text-bold mb-1"> Priority</p>
                            </div>
                        </div>
                        <div class="form-group row mb-0 bd">
                            <div class="col-sm-3">
                                <hr class="m-0 mb-1">
                            </div>
                        </div>
                        @foreach($experience->technologies as $name)
                            <div class="form-group row mb-1">
                                <label for="technologies{{$name->id}}" class="col-sm-2 col-form-label">{{$name->name}} :</label>
                                <div class="col-sm-1">
                                    <input name="technologies[{{$name->id}}]" type="text" id="technologies{{$name->id}}"
                                           class="form-control pb-1" value="{{$name->pivot->priority}}">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="submit" href="{{route('experience.index')}}" class="btn btn-warning ml-3">Cancel</a>
                </div>
                <!-- /.card-footer -->
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
