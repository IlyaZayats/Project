<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Личный кабинет | Договор | Заявка №{{$id}}</title>
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="http://194.67.116.171/css/lk_main.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/navbar_cabinet.css"/>
</head>

<style>
    .error{
        color: red;
        font-size:14px;
        font-weight: bold;
    }
</style>

<body>

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
            </ul>
            <div style="display: inline-block;" class="mt-2 mt-xl-0">
                <button class="btn btn-warning btn-exit" type="button" onclick="location.href='http://194.67.116.171/leave'">Выйти</button>
            </div>
        </div>
    </div>
</nav>

<div class="container-fluid d-block">
    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
    </div>
    <div class="col-md-12 mt-5 mb-5 text-center">
        <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЗАЯВКА №{{$id}}</a>/<a class="text-danger" href="#" onclick="history.go(-1);">ФОРМИРОВАНИЕ ОТВЕТА ПО КРЕДИТУ</a>/ЗАКЛЮЧЕНИЕ ДОГОВОРА</h5>
    </div>
    <div class="row col col-lg-8 mx-auto">
        <div class="col-md-12 col-xl-4 mt-5 mb-5">
            <h5>Статус подписания договора клиентом: </h5>
        </div>
        <div class="col-md-12 col-xl-5 mt-5 mb-5 status_podpisaniya">
            <b>
                @if(is_null($confirm))
                    Клиент пока не подписал договор
                @elseif($confirm==0)
                    Клиент отказался подписывать договор
                @elseif($confirm==1)
                    Клиент подписал <a style="font-weight: bold" href = "http://194.67.116.171/files/{{$contract}}">договор</a>
                @else
                    Статус неизвестен, произошла ошибка
                @endif
            </b>
        </div>


    @if($confirm == 1)
    <form id="contractForm">
        @csrf
        <div class="row mt-3">
            <label for="userITN" class="col-4 col-form-label">ИНН</label>
            <div class="col">
                <input type="text" name="ITN" class="form-control data" id="userITN">
            </div>
            <div class="error loan-itn text-end"></div>
        </div>
        <div class="row mt-3">
            <label for="sumLoan" class="col-4 col-form-label">Сумма кредита</label>
            <div class="col">
                <input type="text" name="sum" class="form-control data" id="sumLoan">
            </div>
            <div class="error loan-sum text-end"></div>
        </div>
        <div class="row mt-3">
            <label for="loanType" class="col-4 col-form-label">Вид кредита</label>
            <div class="col">
                <select class="form-select data" name="loan_type" aria-label="Default select example" id="loanType">
                    <option selected></option>
                    <option value="1">Кредит наличными</option>
                    <option value="2">Кредитная карта</option>
                    <option value="3">Кредит "Мечта"</option>
                </select>
            </div>
            <div class="error loan-type text-end"></div>
        </div>
        <div class="row mt-3">
            <label for="termLoan" class="col-4 col-form-label">Срок</label>
            <div class="col">
                <input type="text" name="term" class="form-control data" id="termLoan">
            </div>
            <div class="error loan-term text-end"></div>
        </div>
        <div class="row mt-3">
            <label for="userFee" class="col-4 col-form-label">Ежемесячный платёж</label>
            <div class="col">
                <input type="text" name="fee" class="form-control data" id="userFee">
            </div>
            <div class="error fee text-end"></div>
        </div>
        <div class="col-8 mx-auto">
        <input type="button" class="btn btn-style mt-4 w-100" value="Заключить договор" id="contractButton" style="background-color: yellow; border-radius: 25px">
        <input type="button" class="btn btn-style my-2 w-100" value="Связаться с клиентом" id="contactButton" onclick="location.href='http://194.67.116.171/loan_response_message'" style="background-color: yellow; border-radius: 25px">
        <input type="button" class="btn btn-style mb-4 w-100" value="Закрыть заявку" id="refuseButton" onclick="location.href='http://194.67.116.171/cabinet/loan_response/contract/refuse'" style="background-color: yellow; border-radius: 25px">
        </div>
    </form>
        <div style="padding-bottom: 200px;"></div>
    @endif
    </div>

</div>



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
<script src="http://194.67.116.171/js/bootstrap.js"></script>
<script src="http://194.67.116.171/js/leave.js"></script>
<script src="http://194.67.116.171/js/loan_officer/loan_response_contract.js"></script>

</html>

