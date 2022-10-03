@extends('template.mainTemplate')
@include('template.menu-left')

@section('content')

    <div class="flex-shrink-0 p-3">
        @if(!$userFullData)
            <h1 class="text-success text-center">
                Hello!<br> Summary not found!
                Creat your summary.
            </h1>
        @else
            <div class="border-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-6 text-center">
                            <h1>{{$userFullData->lastName}} {{$userFullData->name}}</h1>
                        </div>
                        <div class="col-3"></div>
                    </div>
                </div>
                @if($userFullData->jobTitle)
                <div class="container">
                    <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 text-center">
                        <p class="fs-4">
                            @foreach($userFullData->jobTitle as $jobTitle)
                            {{$jobTitle}}
                                @if(!$loop->last)
                                    <br>
                                @endif
                            @endforeach
                        </p>
                    </div>
                    <div class="col-3"></div>
                </div>
                </div>
                @endif
                @if($userFullData->contact)
                    <div class="container">
                        <div class="row">
                            <div class="col-3"></div>
                            <div class="col-6 text-center">
                                <p class="fs-6 fw-bold text-secondary">
                                    {{$userFullData->contact}}
                                </p>
                            </div>
                            <div class="col-3"></div>
                        </div>
                    </div>
                @endif
            </div>
            <div>
                <div class="container">
                    <div class="row mt-1">
                        <div class="col-3"></div>
                        <div class="col-6 text-center">
                            <p class="fs-2 fw-bold">
                                Опыт работы
                            </p>
                        </div>
                        <div class="col-3"></div>
                    </div>
                    @if(count($userFullData->user->experience))
                        @foreach($userFullData->user->experience as $experience)
                            <div class="row mt-0">
                                <div class="">
                                    <p class="">
                                        <strong>
                                            {{$experience->formatStartDate()}} -
                                            @if($experience->end_date)
                                                {{$experience->formatEndDate()}}
                                                @else настоящее время
                                            @endif
                                        </strong> - {{$experience->company_name}}
                                    <br>
                                    <strong>Должность: </strong>{{$experience->position}}<br>

                                        <strong>Используемые технологии:</strong><br>
                                        @foreach($technologies as $technology)
                                            @if($experience->id == $technology->id)
                                                {{$technology->technology_name}},
                                            @endif
                                        @endforeach
                                        <br>
                                    <span class="fw-bold">Обязанности, проделанная работа: </span> <br>@foreach($works as $work)
                                            @if($experience->id == $work->id)
                                                {{$work->description}}<br>
                                            @endif
                                        @endforeach</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if($userFullData->education)
                    <div class="row mt-1">
                        <div class="col text-center">
                            <p class="fs-2 fw-bold">
                                Образование
                            </p>
                        </div>
                        <div>
                            @foreach($userFullData->education as $education)
                                {{$education}}
                            @endforeach
                        </div>
                    </div>
                    @endif
                    @if($userFullData->mainSkills)
                        <div class="row mt-1">
                            <div class="col text-center">
                                <p class="fs-2 fw-bold">
                                    Ключевые навыки:
                                </p>
                            </div>
                            <div>
                                @foreach($userFullData->mainSkills as $mainSkills)
                                    {{$mainSkills}}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($userFullData->achievements)
                        <div class="row mt-1">
                            <div class="col text-center">
                                <p class="fs-2 fw-bold">
                                    Достижения:
                                </p>
                            </div>
                            <div>
                                @foreach($userFullData->achievements as $achievement)
                                    {{$achievement}}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($userFullData->personalQualities)
                        <div class="row mt-1">
                            <div class="col text-center">
                                <p class="fs-2 fw-bold">
                                    Личные качества:
                                </p>
                            </div>
                            <div>
                                @foreach($userFullData->personalQualities as $personalQualities)
                                    {{$personalQualities}}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    @if($userFullData->other)
                        <div class="row mt-1">
                            <div class="col text-center">
                                <p class="fs-2 fw-bold">
                                    Прочие:
                                </p>
                            </div>
                            <div>
                                @foreach($userFullData->other as $other)
                                    {{$other}}<br>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        @endif
     </div>
@endsection
