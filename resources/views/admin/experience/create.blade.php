@extends('admin.template.adminTemplate')
@extends('admin.experience.headerTemplate')

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title text-bold">Add new experience</h3>
    </div>
    <div class="card-body">
        <form action="{{route("experience.store")}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date :</label>
                <input name="start_date" type="date" id="start_date"
                    class="form-control
                        @error('start_date')
                            border-danger
                        @enderror"
                   value="{{old('start_date')}}"
                >
            </div>
            <div class="mb-3">
                <label for="end_date" class="form-label">End Date :</label>
                <input name="end_date" type="date" id="end_date"
                    class="form-control
                        @error('end_date')
                            border-danger
                        @enderror"
                       value="{{old('end_date')}}"
                >
            </div>
            <div class="mb-3">
                <label for="position" class="form-label">Position:</label>
                <input name="position" type="text" id="position"
                    class="form-control
                        @error('position')
                            border-danger
                        @enderror"
                    value="{{old('position')}}"
                >
            </div>
            <div class="mb-3">
                <div class="form-group ">
                    <label for="technologies">Technologies</label>
                    <select name="technologies[]"
                        class="select2
                            @error('technologies')
                                border-danger
                            @enderror"
                        multiple="multiple" id="technologies" data-placeholder="Select technologies"
                        style="width: 100%;"
                    >
                        @foreach($technologies as $technologyId => $technologyName)
                            <option value="{{$technologyId}}">{{$technologyName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <div class="form-group ">
                    <label for="works">Works</label>
                    <select name="works[]"
                            class="select2
                            @error('works')
                                border-danger
                            @enderror"
                            multiple="multiple" id="works" data-placeholder="Select works"
                            style="width: 100%;"
                    >
                        @foreach($works as $workId => $workName)
                            <option value="{{$workId}}">{{$workName}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Save</button>
            <a type="submit" href="{{route('experience.index')}}" class="btn btn-warning ml-3">Cancel</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection


