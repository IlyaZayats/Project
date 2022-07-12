<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Личный кабинет | Добавление в ЧС банка | Заявка №{{$id}}</title>
        <meta charset='utf-8'/>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
        <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
        <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
        <link rel="stylesheet" href="http://194.67.116.171/css/black_list.css"/>
        <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
        <link rel="stylesheet" href="http://194.67.116.171/css/navbar_cabinet.css"/>
    </head>

    <body>


    <!-- - - - - - - - - - - - - - - - - - - N A V B A R - - - - - - - - - - - - - - - - - - - - - -->


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


    <!-- - - - - - - - - - - - - - - - - B L A C K _ D I C K S - - - - - - - - - - - - - - - - - - - -->


    <div class = "container-fluid">
        <div class="row justify-content-center text-center">
            <div class="col-md-12 mt-4 mb-3 text-center title_lk">
                <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
            </div>
        </div>
        <div class="col-md-12 mt-3 mb-5 text-center">
            <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЗАЯВКА №{{$id}}</a>/<a class="text-danger" href="#" onclick="history.go(-1);">ПРОВЕРКА ДАННЫХ</a>/ВНЕСЕНИЕ В ЧС</h5>
        </div>


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-10 col-md-10 col-12">
                    <form name="form" id="addToBlackList">
                        @csrf
                        <div class="inn-wrapper mt-3">
                            <label class="mb-2" for="userInn">ИНН</label><br/>
                            <input class="form-control data" id="userInn" type="text" name="ITN" placeholder="Введите ИНН">
                            <div class="error itn text-end"></div>
                        </div>

                        <div class="text-wrapper">
                            <label class="pt-4 mb-2" for="userText">Текст ответа</label>
                            <textarea class="data form-control" id="userText" name="text" rows="10" placeholder="Введите текст ответа"></textarea>
                            <div class="error text text-end"></div>
                        </div>
                        <input type="button" class="btn w-100" id="addIntoBlackList" value="Отправить">
                    </form>
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


    <!-- - - - - - - - - - - - - - - - - - F  O  O  T  E  R - - - - - - - - - - - - - - - - - - - - -->

    <footer class="bg-dark text-center text-white">
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
    </body>
    <script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
    <script src="http://194.67.116.171/js/bootstrap.js"></script>
    <script src="http://194.67.116.171/js/loan_officer/black_list.js"></script>
    <script src="http://194.67.116.171/js/leave.js"></script>
</html>