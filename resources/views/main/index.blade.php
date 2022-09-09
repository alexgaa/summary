@extends('template.mainTemplate')

@section('content')

    <div class="flex-shrink-0 p-3">
        <h1 class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">Гамов Алексей</h1>
        <ul class="list-unstyled ps-0">
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="false">
                    <span class="fs-5 fw-semibold">Опыт работы </span>
                </button>
                <div class="collapse" id="home-collapse" style="">
                    <p> <b>Декабрь 2021 -  настоящее время</b>, SELL TEAM, PARTS iD, Inc.(https://www.carbid.com)<br>
                        <b>Должность: </b>Junior PHP Developer,<br>
                        <b>Используемые технологии:</b> Php, Symfony, Laravel, Mysql, Docker, German, PhpUnit(Mockery)<br>
                        <b>Обязанности, проделанная работа:</b><br>
                    <ul>
                        <li>Рефакторинг приложения на Laravel + написание функциональных тестов.</li>
                        <li>Рефакторинг приложений на Symfony 4.4-5.1:</li>
                        <li>Написание  клиентов для  Ebay (запрос, получение Инвентори информации).</li>
                        <li>Написание монитора для отслеживания запрошенных Инвентори тасков Ebay.</li>
                        <li>Написание клиента для обновления токенов для Ebay.</li>
                        <li>Написание монитора для отслеживания запущенных в демоне процессов с логированием на почту, Telegram. Написание клиента Telegram для отправки сообщений.</li>
                        <li>Рефакторинг существующего кода приведение к стандартам PSR-12.</li>
                        <li>Покрытие Unit / Functional  тестами существующего кода</li>
                    </ul>
                  </div>
            </li>


         <li class="border-top my-3"></li>{{--  линия   --}}
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#account-collapse" aria-expanded="false">
                    Account
                </button>
                <div class="collapse" id="account-collapse" style="">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">New...</a></li>
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Profile</a></li>
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Settings</a></li>
                        <li><a href="#" class="link-dark d-inline-flex text-decoration-none rounded">Sign out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
@endsection
