@extends('admin.template.adminTemplate')
@extends('admin.userFullData.headerTemplate')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title text-bold">Edit user full data</h3>
        </div>
        <div class="card-body">
            <form action="{{route("user-full-data.update", ['user_full_datum'=>$userFullData->user_id])}}"
                  class="form-horizontal" method="POST">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group row">
                        <label for="user_id" class="col-sm-2 col-form-label">User :</label>
                        <div class="col-sm-8">
                            {{$userFullData->user->name}} ({{$userFullData->user->email}})
                            <input hidden name="user_id" type="text" id="user_id"
                                   class="form-control" value="-1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label" title="Имя">Name :</label>
                        <div class="col-sm-8">
                            <input name="name" type="text" id="name"
                                   class="form-control
                            @error('name')
                                border-danger
                            @enderror"
                                   value="{{$userFullData->name}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lastName" class="col-sm-2 col-form-label" title="Фамилия">Last Name :</label>
                        <div class="col-sm-8">
                            <input name="lastName" type="text" id="lastName"
                                   class="form-control
                            @error('lastName')
                                border-danger
                            @enderror"
                                   value="{{$userFullData->lastName}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="middleName" class="col-sm-2 col-form-label" title="Отчество">Middle Name :</label>
                        <div class="col-sm-8">
                            <input name="middleName" type="text" id="middleName"
                                   class="form-control
                            @error('middleName')
                                border-danger
                            @enderror"
                                   value="{{$userFullData->middleName}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="contact" class="col-sm-2 col-form-label" title="Контактная информация">Contact :</label>
                        <div class="col-sm-10">
                            <input name="contact" type="text" id="contact"
                                   class="form-control
                            @error('contact')
                                border-danger
                            @enderror"
                                   value="{{$userFullData->contact}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label" title="Адрес">Address :</label>
                        <div class="col-sm-10">
                            <input name="address" type="text" id="address"
                                   class="form-control
                            @error('address')
                                border-danger
                            @enderror"
                                   value="{{$userFullData->address}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dateOfBirth" class="col-sm-2 col-form-label" title="Дата рождения">Date of Birth :</label>
                        <div class="col-sm-2">
                            <input name="dateOfBirth" type="date" id="dateOfBirth"
                                   class="form-control
                            @error('dateOfBirth')
                                border-danger
                            @enderror"
                                   value="{{$userFullData->dateOfBirth}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="mainSkills" class="col-sm-2 col-form-label" title="Ключевые навыки">Main Skills :</label>
                        <div class="col-sm-10">
                        <textarea name="mainSkills" type="text" id="mainSkills"
                                  class="form-control
                            @error('mainSkills')
                                border-danger
                            @enderror">@if($userFullData->mainSkills){{
                                implode("\r\n", $userFullData->mainSkills)
                                }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="education" class="col-sm-2 col-form-label" title="Образование">Education :</label>
                        <div class="col-sm-10">
                        <textarea name="education" type="text" id="education"
                                  class="form-control
                            @error('education')
                                border-danger
                            @enderror">@if($userFullData->education){{
                                implode("\r\n", $userFullData->education)
                                }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="workLocation" class="col-sm-2 col-form-label" title="Локация работы">Work Location :</label>
                        <div class="col-sm-10">
                        <textarea name="workLocation" type="text" id="workLocation"
                                  class="form-control
                            @error('workLocation')
                                border-danger
                            @enderror">@if($userFullData->workLocation){{
                                implode("\r\n", $userFullData->workLocation)
                                }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jobTitle" class="col-sm-2 col-form-label" title="Должность">Job Title :</label>
                        <div class="col-sm-10">
                        <textarea name="jobTitle" type="text" id="jobTitle"
                                  class="form-control
                            @error('jobTitle')
                                border-danger
                            @enderror">@if($userFullData->jobTitle){{
                                implode("\r\n", $userFullData->jobTitle)
                                }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="achievements" class="col-sm-2 col-form-label" title="Достижения">Achievements :</label>
                        <div class="col-sm-10">
                         <textarea name="achievements" type="text" id="achievements"
                                   class="form-control
                            @error('achievements')
                                border-danger
                            @enderror">@if($userFullData->achievements){{
                                implode("\r\n", $userFullData->achievements)
                                }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="personalQualities" class="col-sm-2 col-form-label" title="Личные Качества" >Personal Qualities :</label>
                        <div class="col-sm-10">
                        <textarea name="personalQualities" type="text" id="personalQualities"
                                  class="form-control
                            @error('personalQualities')
                                border-danger
                            @enderror">@if($userFullData->personalQualities){{
                                implode("\r\n", $userFullData->personalQualities)
                                }}@endif</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="other" class="col-sm-2 col-form-label" title="Прочие">Other :</label>
                        <div class="col-sm-10">
                        <textarea name="other" type="te" id="other"
                                  class="form-control
                            @error('other')
                                border-danger
                            @enderror">@if($userFullData->other){{
                                implode("\r\n", $userFullData->other)
                                }}@endif</textarea>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a type="submit" href="{{route('user-full-data.index')}}" class="btn btn-warning ml-3">Cancel</a>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection


