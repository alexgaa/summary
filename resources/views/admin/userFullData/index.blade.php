@extends('admin.template.adminTemplate')
@extends('admin.userFullData.headerTemplate')

@section('content')
<!-- Default box -->
<div class="card">
    <div class="card-header bg-primary">
        <h3 class="card-title text-bold">List all User Data</h3>
    </div>
    <div class="card-body">
        @if(!count($usersFullData))
            <p>Not found User Data!</p>
        @else
            @foreach($usersFullData as $userData)
            <table class="table table-hover">
            <thead>
            <tr>
                <th style="width: 200px" class="align-top">Data key</th>
                <th>Value
                    <form action="{{route('user-full-data.destroy', ["user_full_datum"=>$userData->user_id])}}"
                          method="post" class="float-right mb-0">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you want delete User Data?')">
                            <i class="fas fa-trash-alt"></i>
                            Delete
                        </button>
                    </form>
                    <a href="{{route('user-full-data.edit', ["user_full_datum"=>$userData->user_id])}}"
                       class="btn btn-info btn-sm float-right mr-1">
                        <i class="fas fa-pencil-alt"></i>
                        Edit
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-gray">User login: </td>
                    <td>{{$userData->user->name}} ({{$userData->user->email}})</td>
               </tr>

                <tr>
                    <td class="text-gray">Experiences:
                        <a class="btn btn-info btn-sm float-right mr-1" href="{{route("experience.create")}}"> Add new</a>
                    </td>
                    <td>
                        <div class="card-body">
                        @if(!count($userData->user->experience))
                            <p class="text-bold text-blue">Not found Experience!</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Company</th>
                                            <th>Position</th>
                                            <th style="width: 150px">Technologies</th>
                                            <th style="width: 300px">Works</th>
                                            <th style="width: 170px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userData->user->experience as $experience)
                                        <tr>
                                            <td>{{$experience->id}}</td>
                                            <td>{{$experience->start_date}}</td>
                                            <td>{{$experience->end_date}}</td>
                                            <td>{{$experience->company_name}}</td>
                                            <td>{{$experience->position}}</td>
                                            <td style="width: 150px">
                                                @foreach($technologies as $technology)
                                                    @if($experience->id == $technology->id)
                                                        {{$technology->technology_name}},
                                                    @endif
                                                @endforeach
                                                <a href="{{route('experience.sortingTechnologies', ["id"=>$experience->id])}}"
                                                   title="Sort by priority">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>

                                            <td style="width: 300px">
                                                @foreach($works as $work)
                                                    @if($experience->id == $work->id)
                                                        {{$work->work_name}},
                                                    @endif
                                                @endforeach
                                                <a href="{{route('experience.sortingWorks', ["id"=>$experience->id])}}"
                                                   title="Sort by priority">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                            <td style="width: 170px">
                                                <a href="{{route('experience.edit', ["experience"=>$experience->id])}}"
                                                   class="btn btn-info btn-sm float-left mr-1">
                                                    <i class="fas fa-pencil-alt"></i>
                                                    Edit
                                                </a>
                                                <form action="{{route('experience.destroy', ["experience"=>$experience->id])}}"
                                                      method="post" class="float-left mb-0">
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
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Name: </td>
                    <td>{{$userData->name}}</td>
                </tr>
                <tr>
                    <td class="text-gray">Last Name: </td>
                    <td>{{$userData->lastName}}</td>
                </tr>
                <tr>
                    <td class="text-gray">Middle Name: </td>
                    <td>{{$userData->middleName}}</td>
                </tr>
                <tr>
                    <td class="text-gray">Contact : </td>
                    <td>{{$userData->contact}}</td>
                </tr>
                <tr>
                    <td class="text-gray">Address : </td>
                    <td>{{$userData->address}}</td>
                </tr>
                <tr>
                    <td class="text-gray">Date of Birth : </td>
                    <td>
                        @if($userData->dateOfBirth)
                            {{ floor((time() - strtotime($userData->dateOfBirth)) / (60 * 60 * 24 * 365.25))}}
                            ({{date('d.m.Y', strtotime($userData->dateOfBirth))}})
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Main Skills : </td>
                    <td>
                        <p>
                            @if($userData->mainSkills)
                                @foreach($userData->mainSkills as $mainSkills)
                                    {{$mainSkills}}<br>
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Education : </td>
                    <td>
                        <p>
                            @if($userData->education)
                                @foreach($userData->education as $education)
                                    {{$education}}<br>
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Work Location : </td>
                    <td>
                        <p>
                            @if($userData->workLocation)
                                @foreach($userData->workLocation as $workLocation)
                                    {{$workLocation}}<br>
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Job Title : </td>
                    <td>
                        <p>
                            @if($userData->jobTitle)
                                @foreach($userData->jobTitle as $jobTitle)
                                    {{$jobTitle}}<br>
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Achievements : </td>
                    <td>
                        <p>
                            @if($userData->achievements)
                                @foreach($userData->achievements as $achievement)
                                    {{$achievement}}<br>
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Personal Qualities : </td>
                    <td>
                        <p>
                            @if($userData->personalQualities)
                                @foreach($userData->personalQualities as $personalQualities)
                                    {{$personalQualities}}<br>
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
                <tr>
                    <td class="text-gray">Other : </td>
                    <td>
                        <p>
                            @if($userData->other)
                                @foreach($userData->other as $other)
                                    {{$other}}
                                    @if(!$loop->last)
                                        <br>
                                    @endif
                                @endforeach
                            @endif
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
            @endforeach
        @endif
    </div>
    <!-- /.card-body -->
    <div class="card-footer clearfix">
        {{$usersFullData->links()}}
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
@endsection


