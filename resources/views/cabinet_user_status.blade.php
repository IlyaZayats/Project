
<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Личный кабинет | Статусы кредитов</title>
    <meta charset='utf-8'/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="stylesheet" href="http://194.67.116.171/css/lk_statuses_credit.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/navbar_cabinet.css"/>
</head>

<body>
<!-- - - - - - - - - - - - - - - - -  N A V B A R - - - - - - - - - - - - - - - - - -  -  -->
<div class="d-none d-md-flex" style="padding-top: 0.5rem; padding-bottom: 0.5rem; background-color: black;"></div>
<nav class="navbar navbar-expand-xl navbar-dark bg-dark pt-0">
    <div class="p-3 bg-dark container-fluid">
        <div class="col-3 col-md-4 navbar-brand text-light me-0">
            <a class="row text-white col col-lg-5 text-decoration-none" href="http://194.67.116.171">
                <div class="col-3 col-lg-1 pe-3 pe-lg-5">
                    <img class="bg-white border-white rounded" src="http://194.67.116.171/img/tiunoff_promo.png" alt="promo" height="60" width="60">
                </div>
                <div class="col-4 col-lg-4 ps-2 ps-md-3 ps-lg-4 my-auto text-brand">
                    TIUNOFF BANK
                </div>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarToggler">
            <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                <li class="nav-item text-navbar text-light order-0 mt-2 mt-xl-0 navbar-text " style="display: inline-block;">
                    <div>
                        Добро пожаловать, {{$name}}!
                    </div>
                </li>
                <li class="dropdown px-0 px-xl-4 nav-item order-3 order-lx-2 mt-2 mt-xl-0" style="display: inline-block;">
                    <button class="btn btn-dark dropdown-toggle text-navbar ps-0 ps-xl-auto" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="vertical-align: baseline;">
                        Ссылки
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="http://194.67.116.171">Главная</a>
                        <a class="dropdown-item" href="http://194.67.116.171/#credits">Виды кредитов</a>
                        <a class="dropdown-item" href="http://194.67.116.171/#faq">FAQ</a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="http://194.67.116.171/cabinet">Личный кабинет</a>
                    </div>
                </li>
                <li class="pe-4 nav-item order-2 order-xl-3 mt-2 mt-xl-0" style="display: inline-block;">
                    <button class="btn btn-dark text-navbar px-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNotifications" aria-controls="offcanvasNotifications" style="vertical-align: baseline;">
                        Уведомления
                        <span class="badge bg-danger rounded-pill">
                            {{$amount}}
                        </span>
                    </button>
                </li>
            </ul>
            <div style="display: inline-block;" class="mt-2 mt-xl-0">
                <button class="btn btn-warning btn-exit" type="button" onclick="location.href='http://194.67.116.171/leave'">Выйти</button>
            </div>
        </div>
    </div>
</nav>
<!-- - - - - - - - - - - - - - - - -  N A V B A R - - - - - - - - - - - - - - - - - -  -  -->

<div class="container-fluid">
    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
    </div>
    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЛИЧНЫЙ КАБИНЕТ</a>/СТАТУСЫ КРЕДИТОВ</h5>
    </div>

    <div class = "row justify-content-center">
        <div class = "col-12 col-lg-8 col-xl-8 mt-2">
            <div class = "text-center">
                <h4>АКТИВНЫЕ КРЕДИТЫ</h4>
            </div>
            @if(!empty($active))
            <table class="table table-bordered border-dark mb-3 mt-3">
                <thead class = "text-center">
                <tr>
                    <th scope="col" class="text_size">Вид кредита</th>
                    <th scope="col" class="text_size">Срок кредита</th>
                    <th scope="col" class="text_size">Исходная сумма кредита</th>
                    <th scope="col" class="text_size">Оставшаяся сумма погашения</th>
                    <th scope="col" class="text_size">Ежемесячный платёж</th>
                    <th scope="col" class="text_size">Дата получения кредита</th>
                </tr>
                </thead>
                <tbody>
                @foreach($active as $item)
                <tr>
                    <td>@switch($item->loan_type) @case(1) Кредитная карта @break @case(2) Кредит наличными @break @case(3) Кредит "На исполнение мечты" @break @default Bruh @break @endswitch</td>
                    <td>{{$item->term}}</td>
                    <td>{{$item->loan_sum}}</td>
                    <td>{{$item->loan_debt}}</td>
                    <td>{{$item->loan_fee}}</td>
                    <td>{{$item->issue_date}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
            @else
            <h3 class="text-center">
                У вас нет активных кредитов
            </h3>
            @endif
        </div>
        <div class = "col-12 col-lg-8 col-xl-8 mt-3">
            <div class = "text-center">
                <h4>ПОГАШЕННЫЕ КРЕДИТЫ</h4>
            </div>
            @if(!empty($passive))
            <table class="table table-bordered border-dark mb-5 mt-3">
                <thead class = "text-center">
                <tr>
                    <th scope="col" class="text_size">Вид кредита</th>
                    <th scope="col" class="text_size">Срок кредита</th>
                    <th scope="col" class="text_size">Исходная сумма кредита</th>
                    <th scope="col" class="text_size">Дата получения кредита</th>
                </tr>
                </thead>
                <tbody>
                @foreach($passive as $item)
                    <tr>
                        <td>@switch($item->loan_type) @case(1) Кредитная карта @break @case(2) Кредит наличными @break @case(3) Кредит "На исполнение мечты" @break @default Bruh @break @endswitch</td>
                        <td>{{$item->term}}</td>
                        <td>{{$item->loan_sum}}</td>
                        <td>{{$item->issue_date}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">
                    У вас нет погашенных кредитов
                </h3>
            @endif
        </div>
        @if(!empty($apps))
            <div class = "col-12 col-lg-8 col-xl-8 mt-2">
                <div class = "text-center">
                    <h4>ОДОБРЕННЫЕ ЗАЯВКИ, ТРЕБУЮЩИЕ ПОДПИСАНИЯ ДОГОВОРА</h4>
                </div>
                <div class="accordion" id="accordionContract">
                    @foreach($apps as $item)
                        <div class="card">

                            <div class="card-header p-0" id="heading{{$item->id_app}}">
                                <h2 class="mb-0">
                                    <div class="btn btn-block w-100 collapsed py-2 px-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$item->id_app}}" aria-expanded="false" aria-controls="collapse{{$item->id_app}}">
                                        <div class="row"><div class="col-6 text-start">Заявка №{{$item->id_app}} | @switch($item->loan_type) @case(1) Кредитная карта @break @case(2) Кредит наличными @break @case(3) Кредит "На исполнение мечты" @break @default Bruh @break @endswitch</div><div class="col-6 text-end">{{$item->send_app}}</div></div>
                                    </div>
                                </h2>
                            </div>
                            <div id="collapse{{$item->id_app}}" class="collapse" aria-labelledby="heading{{$item->id_app}}" data-parent="#accordionContract">
                                <div class="card-body">
                                    <div class="col-12 mx-auto">
                                        <div class="row">
                                            <div class="col-10 mx-auto text-center" style="font-size: 24px; font-weight: bold;">
                                                Подписание договора
                                            </div>
                                            <div class="col-10 mx-auto" >
                                                <div class="text-center" style="font-size: 18px; font-weight: bold;">
                                                    Для заключения кредитного договора, вам необходимо:
                                                </div>
                                                <ul class="" style="font-size: 16px;">
                                                    <li>
                                                        Скачать и заполнить <a href="http://194.67.116.171/files/download/loan_statement.pdf">документ</a>
                                                    </li>
                                                    <li>
                                                        Прикрепить заполненный и подписанный <a href="http://194.67.116.171/files/download/loan_statement.pdf">договор</a>
                                                    </li>
                                                    <li>
                                                        Нажать кнопку "заключить кредитный договор"
                                                    </li>
                                                </ul>
                                                <div style="font-size: 18px;">
                                                    После проверки правильности заполнения <a href="http://194.67.116.171/files/download/loan_statement.pdf">договора</a>, вы получите кредит/кредитную карту.
                                                </div>

                                            </div>
                                            <div class="col-10 mx-auto my-2">
                                                <form id="contractForm{{$item->id_app}}" enctype="multipart/form-data" class="contract-form">
                                                    @csrf
                                                    <input type="file" class="form-control form-control-file w-100" id="contract{{$item->id_app}}" name="contract">
                                                    <input type="hidden" class="id-file" name="id_app">
                                                </form>
                                                <div style="color: red; font-size: 14px; font-weight: bold" class="contract-err text-start"></div>
                                            </div>
                                            <div class="col-10 mx-auto row">
                                                <div class="col-5 mx-auto">
                                                    <a type="button" class="btn btn-warning btn-exit w-100 btn-refuse" style="font-size: 18px">Отказаться<div class="d-none id-app">{{$item->id_app}}</div></a>
                                                </div>
                                                <div class="col-5 mx-auto">
                                                    <a class="btn btn-warning btn-exit w-100 btn-contract" type="button" style="font-size: 18px">Заключить кредитный договор</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>

<!--OFFCANVAS-->
<div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasNotifications" aria-labelledby="offcanvasLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasLabel">Ваши уведомления</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body pe-0">
        @php $i=0 @endphp
        @foreach($msg as $item)
            @if($item['shown'] == 1)
                <div class="col-12 message-wrapper ps-4 message">
                    <div class="message-inners">
                        <div id="headerMsg" class="message-header @if($item['viewed'] == 0) new-msg @else old-msg @endif pt-2 row me-0">
                            <div class="col text-msg-header">
                                @switch($item[0]->msg_type)
                                    @case(2)
                                        Ответ на заявку №{{$item[0]->msg_topic}}
                            </div>
                            <div class="col-4 text-msg-bottom text-end send-date">
                                {{$item[0]->send_date}}
                            </div>
                        </div>
                        <div class="message-body text-msg-body text-secondary msg-extra-bar">
                            Работник банка дал ответ
                        </div>
                        @break
                        @case(1)
                            Запрос в ЦПП №{{$item[0]->id_message}}
                    </div>
                    <div class="col-4 text-msg-bottom text-end send-date">
                        {{$item[0]->send_date}}
                    </div>
                </div>
                <div class="message-body text-msg-body text-secondary msg-extra-bar">
                    Сотрудник ЦПП дал ответ
                </div>
                @break
                @default
                    Оповещение
    </div>
    <div class="col-4 text-msg-bottom text-end send-date">
        {{$item[0]->send_date}}
    </div>
</div>
<div class="message-body text-msg-body text-secondary msg-extra-bar">
    Системное оповещение
</div>
@break
@endswitch
<div class="message-bottom pb-2 row me-0">
    <a class="col-2 text-msg-bottom text-danger text-decoration-none delete">
        Удалить
    </a>
</div>
<div class="d-none msg-main-text">{{$item[0]->text}}</div>
<div class="d-none msg-id">{{$item[0]->id_message}}</div>
</div>
</div>
@endif
@php $i++; @endphp
@endforeach
</div>
</div>

<form id='refuse'>
    @csrf
    <input name="id_app" type="hidden" class="id-form">
</form>

<!--FORMS-->
<form id='viewed'>
    @csrf
    <input name="id" type="hidden" class="id_v">
    <input name="type" type="hidden" class="type_v">
</form>

<form id='shown'>
    @csrf
    <input name="id" type="hidden" class="id_s">
    <input name="type" type="hidden" class="type_s">
</form>

<div style="padding-bottom: 300px"></div>

<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - -  -  -->
<footer class="bg-dark text-center text-white fixed-bottom">
    <div class="container p-4">

        <section>
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Контактная информация:</h5>
                    +7-918-931-39-32
                </div>
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase">Адрес:</h5>
                    г. Краснодар, ул. Красная 32
                </div>
            </div>
        </section>
    </div>

    <div class="text-center p-3" style="background-color: black;">
        © 2022. Tiunoff bank, официальный сайт.
    </div>
</footer>

<!--MODAL MESSAGE-->
<div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="msgModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-content-msg">
            <div class="d-flex" style="padding-top: 0.5rem; padding-bottom: 0.5rem; background-color: black;"></div>
            <div class="modal-header pt-2 pb-0 ps-0 pe-0 ms-4">
                <div class="container-fluid row px-0">

                    <div class="col-8 modal-title msg-title" id="msgModalLabel">

                    </div>
                    <button type="button" class="btn col-2 p-0 text-center ms-auto msg-close" style="color:#0d6efd; font-size: 20px;">
                        Назад
                    </button>
                    <div class="col-6 text-start msg-extra">

                    </div>
                    <div class="col-6 text-end msg-date">

                    </div>
                </div>
            </div>
            <div class="modal-body border-top-0">
                <div class="container-fluid">
                    <div class="msg-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title response-title" id="responseModalLabel"></h5>
            </div>
            <div class="modal-body response-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn modal-button w-100" style="background-color: yellow;">Понятно</button>
            </div>
        </div>
    </div>
</div>

</body>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="http://194.67.116.171/js/bootstrap.bundle.js"></script>
<script src="http://194.67.116.171/js/user/notifications.js"></script>
<script src="http://194.67.116.171/js/user/cabinet_user_status.js"></script>
</html>
