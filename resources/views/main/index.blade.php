@extends('template.mainTemplate')

@section('content')

    <div class="flex-shrink-0 p-3">
        <div class="border-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 text-center">
                        <h1>Гамов Алексей</h1>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6 text-center">
                        <p class="fs-4">PHP Developer</p>
                    </div>
                    <div class="col-3"></div>
                </div>
            </div>

            <p class="fw-bold text-secondary">Тел.: 067-272-42-50, alexgamow1982@gmail.com, Telegram, Viber</p>
        </div>
            <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                    <span class="fs-5 fw-semibold text-success">Опыт работы </span>
                </button>
                @foreach($experiences as $experience)
                    <div class="collapse mb-2" id="home-collapse" style="">
                        <b>{{$experience->start_date}} -
                            @if($experience->end_date)
                                {{$experience->end_date}}
                            @else
                                настоящее время
                            @endif
                        </b>: {{$experience->company_name}}<br>
                        <b>Должность: </b>{{$experience->position}}<br>
                        <b>Используемые технологии:</b>
                        @foreach($technologies as $technology)
                            @if($experience->id == $technology->id)
                                {{$technology->technology_name}},
                            @endif
                        @endforeach
                        <br>
                        <b>Обязанности, проделанная работа:</b><br>
                        <ul>
                            @foreach($works as $work)
                                @if($experience->id == $work->id)
                                    <li>
                                        @if($work->description)
                                            {{$work->description}}
                                        @else
                                            {{$work->work_name}}
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </li>


            <li class="border-top my-3"></li>{{--  линия   --}}
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse1" aria-expanded="false">
                    <span class="fs-5 fw-semibold text-success">Образование </span>

                </button>
                <div class="collapse" id="account-collapse1" style="">
                    <ul>
                        <li>2004г. Национальный Университет Кораблестроения Николаев, специальность Информационный управляющий системы и технологии</li>
                        <li>2005г. Национальный Университет Кораблестроения Николаев, специальность Финансы</li>
                    </ul>
                </div>
            </li>


            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse2" aria-expanded="false">
                    <span class="fs-5 fw-semibold text-success">Ключевые навыки </span>
                </button>
                <div class="collapse" id="account-collapse2" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li>PHP 7.2 -7.4,</li>
                        <li>Mysql</li>
                        <li>Symfony 4.1 - 5.4</li>
                        <li>Laravel 8.0</li>
                        <li>Doctrine</li>
                        <li>Docker /Docker-compose</li>
                        <li>PhpUnit (unit and function testing)</li>
                        <li>German</li>
                        <li>Redis</li>
                        <li>Html5, CSS3, Bootstrap, Twig, Js</li>
                        <li>Unix, Git, Composer, Jira,  PhpStorm</li>
                    </ul>
                </div>
            </li>

            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse3" aria-expanded="false">
                    <span class="fs-5 fw-semibold text-success">Достижения: </span>
                </button>
                <div class="collapse" id="account-collapse3" style="">
                    <div>
                        <p>Последние полгода меня курировал Senior Developer(12+ лет опыта), я научился писать качественный
                            масштабируемый код в соответствии с принципами SOLID и стандартами  PSR-12.
                            Получил большой опыт по рефакторингу чужого кода, покрытия кода тестами,
                            поиска и устранения узких мест.
                        </p>
                        <p>Придумал и лично реализовал следующие проекты, которыми успешно пользовались/пользуются сотрудники компании, что позволило сократить расходы на обработку данных 40%  и ускорить в 3 раза скорость добавления товаров на сайт:
                        Brand Manager – написано и внедрено в 2021 году (июнь релиз). PHP+MySQL (Symfony). На данный момент имеет более 200+ пользователей.
                        Importer Tool – написано в 2020 году на PHP+MySQL на сегодняшний день 100+ активных пользователей.
                        Check Tool – написано в конце 2019 года PHP+MySQL с мая 2021 года было передано на сопровождение Desktop разработчикам, (до передачи было 120 активных пользователей)
                        Через 9 месяцев с момента начала работы в компании в отделе импорта, был назначен TL команды импорта, дважды был отмечен как лучший TL года, был инициатором «перестройки» работы команд импорта, за время работы многократно награждён бонусами за значительные идеи по улучшению рабочих процессов в компании. Постоянно был был куратором по разработке и внедрению проектов по автоматизации внутренних процессов компании.
                        </p>
                        <p>Большой опыт работы e-commerce связанной с торговлей автозапчастей (7+ лет) для США и Канады.</p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
@endsection
