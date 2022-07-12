<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Личный кабинет | Дополнительные данные</title>
    <meta charset='utf-8'/>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="stylesheet" href="http://194.67.116.171/css/lk_new_dopdan.css"/>
    <link rel="stylesheet" href="http://194.67.116.171/css/navbar_cabinet.css"/>
</head>
<body>
<!-- - - - - - - - - - - - - - - N A V B A R- - - - - - - - - - - - - - - --->
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
<!-- - - - - - - - - - - - - - - N A V B A R- - - - - - - - - - - - - - - --->
<div class = "container-fluid">
    <div class="row">
        <div class="col-md-12 mt-4 mb-3 text-center title_lk">
            <h1 class = "py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
        </div>
    </div>
    <div class="col-md-12 mt-4 mb-3 text-center title_lk">
        <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЛИЧНЫЙ КАБИНЕТ</a>/ИЗМНЕНЕНИЕ ДОПОЛНИТЕЛЬНЫХ ДАННЫХ</h5>
    </div>

    <!--............................................... М О Д А Л Ь Н Ы Е  О К Н А ...............................................-->

    <!-- М О Д А Л Ь Н О Е  О К Н О   ДОБАВЛЕНИЯ ПАСПОРТА -->
    <div class="modal fade" id="PassportAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Введите данные паспорта (серия и номер)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="passport-form-wrapper">
                        <form id="passport_dataID">
                            @csrf
                            <input type="hidden" name="additional_type" value="passport_data">
                            <input id = "passport" name="data" class="form-control" type="text" onkeyup="this.value = this.value.replace(/[^\d]/g,'');" maxlength="10" placeholder=" _ _ _ _ - _ _ _ _ _ _ ">
                        </form>
                    </div>
                    <p id = "sms_passport" class = "mt-3" style="font-size: 15px;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-confirm" id="submit_button_1">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- М О Д А Л Ь Н О Е  О К Н О   УДАЛЕНИЯ ПАСПОРТА -->
    <div class="modal fade" id="PassportDelete" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вы уверены, что хотите удалить данные?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ОТМЕНА</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="yes_passport">Да, удалить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- М О Д А Л Ь Н О Е  О К Н О   ДОБАВЛЕНИЯ СНИЛС -->
    <div class="modal fade " id="SnilsAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Введите номер своего СНИЛС</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="inipa-form-wrapper">
                        <form id="INIPAID">
                            @csrf
                            <input type="hidden" name="additional_type" value="INIPA">
                            <input id = "snils" class="form-control" type="text" name="data" onkeyup="this.value = this.value.replace(/[^\d]/g,'');" maxlength="11" placeholder=" _ _ _ _ - _ _ _ _ _ _ ">
                        </form>
                    </div>
                    <p id = "sms_snils" class = "mt-3" style="font-size: 15px;"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-confirm" id="submit_button_4">Подтвердить</button>
                </div>
            </div>
        </div>
    </div>

    <!-- М О Д А Л Ь Н О Е  О К Н О   ДОБАВЛЕНИЯ СПРАВКИ О СУДИМОСТИ -->
    <div class="modal fade " id="CriminalAdd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">СПРАВКА О СУДИМОСТИ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id = "sms_criminal" style="font-size: 15px;"></p>
                    <div class="criminal-form-wrapper">
                        <form id="criminal_recordID" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="additional_type" value="criminal_record">
                            <input type="file" class="form-control" id="criminal_id" name="file">
                        </form>
                    </div>
                        <div>
                            <b style = "color: grey; font-size: 13px;">Документ должен быть в формате pdf, png или jpg!</b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-confirm" id="submit_button_5">Подтвердить</button>
                        </div>
                    </div>
                </div>
            </div>
    </div>

            <!-- М О Д А Л Ь Н О Е  О К Н О   УДАЛЕНИЯ СПРАВКИ О СУДИМОСТИ -->
            <div class="modal fade" id="CriminalDelete" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Вы уверены, что хотите удалить данные?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ОТМЕНА</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="yes_criminal">Да, удалить</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- М О Д А Л Ь Н О Е  О К Н О   ДОБАВЛЕНИЯ 2-НДФЛ -->
            <div class="modal fade " id="NdflAdd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">2-НДФЛ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p id = "sms_ndfl" style="font-size: 15px;"></p>
                            <div class="ndfl-form-wrapper">
                                <form id="income_statementID" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="additional_type" value="income_statement">
                                    <input id="ndfl_id" class="form-control" name="file" type="file">
                                </form>
                            </div>
                            <b style = "color: grey; font-size: 13px;">Документ должен быть в формате pdf, png или jpg!</b>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary btn-confirm" id="submit_button_3">Подтвердить</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- М О Д А Л Ь Н О Е  О К Н О   УДАЛЕНИЯ СПРАВКИ О СУДИМОСТИ -->
            <div class="modal fade" id="NdflDelete" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Вы уверены, что хотите удалить данные?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ОТМЕНА</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="yes_ndfl">Да, удалить</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--............................................... М О Д А Л Ь Н Ы Е  О К Н А ...............................................-->

            <div class = "row py-4 check_lk position-relative">
                <div class = "col-4 col-sm-4 col-md-3 col-lg-3 col-xl-3 py-3"></div>
                <div class = "col-8 col-sm-8 col-md-3 col-lg-3 col-xl-3 py-3">
                    <input disabled type="checkbox" id="checkbox-id-1" name="check-1" @if(!empty($passport_data)) checked @endif/>
                    <label for="checkbox-id-1">Паспорт</label>
                    </br>
                    <div class="passport-output output">
                        @if(!empty($passport_data)) {{$passport_data}} @endif
                    </div><!--ДЛЯ BACK-END <3 -->
                    </br>
                    <div class="row position-relative">
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="add-button-1" style="display: @if(!empty($passport_data)) none; @else block; @endif" type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#PassportAdd">
                                Добавить
                            </button>
                        </div></br>
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="delete-button-1" style="display: @if(empty($passport_data)) none; @else block; @endif" type="button" class="btn btn-danger delete-button" data-bs-toggle="modal" data-bs-target="#PassportDelete">
                                Удалить
                            </button>
                        </div>
                    </div></br>
                </div>
                <div class = "col-4 col-sm-4 col-md-2 col-lg-1 col-xl-1 py-3"></div>
                <div class = "col-8 col-sm-8 col-md-4 col-lg-5 col-xl-5 py-3">
                    <input disabled type="checkbox" id="checkbox-id-2" name="check-2" checked  />
                    <label for="checkbox-id-2">ИНН</label>
                    </br>
                    <div class="output">
                    @if(!empty($ITN)) {{$ITN}} @endif<!-- номер ИНН пользователя   ДЛЯ BACK-END <3 -->
                    </div>
                </div>
                <div class = "col-4 col-sm-4 col-md-3 col-lg-3 col-xl-3 py-3"></div>
                <div class = "col-8 col-sm-8 col-md-3 col-lg-3 col-xl-3 py-3">
                    <input disabled type="checkbox" id="checkbox-id-3" name="check-3" @if(!empty($data->income_statement))  checked  @endif/>
                    <label for="checkbox-id-3">2-НДФЛ</label>
                    </br>
                    <div class="ndfl_output output"></div>
                    </br>
                    <div class="row position-relative">
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="add-button-3" type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#NdflAdd" style="display: @if(empty($INIPA) || !empty($data->income_statement)) none; @else block; @endif">
                                Добавить
                            </button>
                        </div></br>
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="delete-button-3" type="button" class="btn btn-danger delete-button" data-bs-toggle="modal" data-bs-target="#NdflDelete" style="display:@if(empty($INIPA) || empty($data->income_statement)) none; @else block; @endif">
                                Удалить
                            </button>
                        </div></br>
                    </div>
                </div>
                <div class = "col-4 col-sm-4 col-md-2 col-lg-1 col-xl-1 py-3"></div>
                <div class = "col-8 col-sm-8 col-md-4 col-lg-5 col-xl-5 py-3">
                    <input disabled type="checkbox" id="checkbox-id-4" name="check-4" @if(!empty($INIPA))  checked  @endif/>
                    <label for="checkbox-id-4">СНИЛС</label>
                    </br>
                    <div id = "back-end-snils" class="output">@if(!empty($INIPA))  {{$INIPA}}  @endif   </div>
                    </br>
                    <div class="row position-relative">
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="add-button-4" type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#SnilsAdd" style="display: @if(!empty($INIPA)) none; @else block; @endif">
                                Добавить
                            </button>
                        </div></br>
                    </div>
                </div>
                <div class = "col-4 col-sm-4 col-md-3 col-lg-3 col-xl-3 py-3"></div>
                <div class = "col-8 col-sm-8 col-md-3 col-lg-3 col-xl-3 py-3">
                    <input disabled type="checkbox" id="checkbox-id-5" name="check-5" @if(!empty($data->criminal_record))  checked  @endif/>
                    <label for="checkbox-id-5">Справка о судимости</label>
                    </br>
                    <div class="criminal_output output"></div>
                    </br>
                    <div class="row position-relative">
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="add-button-5" type="button" class="btn btn-primary add-button" data-bs-toggle="modal" data-bs-target="#CriminalAdd" style="display: @if(empty($INIPA) || !empty($data->criminal_record)) none; @else block; @endif">
                                Добавить
                            </button>
                        </div></br>
                        <div class="col-6 col-sm-6 col-md-3 col-lg-3 col-xl-3 px-5 mx-2 position-absolute">
                            <button id="delete-button-5" type="button" class="btn btn-danger delete-button" data-bs-toggle="modal" data-bs-target="#CriminalDelete" style="display: @if(empty($INIPA) || empty($data->criminal_record)) none; @else block; @endif">
                                Удалить
                            </button>
                        </div></br>
                    </div>
                </div>
                <div class = "col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 py-3">
                    <div class="lk_buttons">
                        <button type="button" id="guarantorButton" class="lk_but p-3" onclick="location.href='http://194.67.116.171/cabinet/additional_data/guarantor'" style="display: @if(empty($INIPA)) none; @else block; @endif">
                            @if(empty($data->guarantor))ДОБАВИТЬ ПОРУЧИТЕЛЯ@else ИЗМЕНИТЬ ПОРУЧИТЕЛЯ@endif
                        </button><br>
                    </div>
                </div>
            </div>

        </div>

<!--300 IQ MOVE-->

<form id="addForm" class="d-none">
    @csrf
    <input type="hidden" name="additional_type" class="add-type">
    <input type="hidden" name="file" class="add-file">
    <input type="hidden" name="data" class="add-data">
</form>

<form id="deleteForm" class="d-none">
    @csrf
    <input type="hidden" name="additional_type" class="remove-type">
</form>

<!--300 IQ MOVE-->

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

<!--MODAL MESSAGE-->
<div class="modal fade" id="msgModal" tabindex="-2" aria-labelledby="msgModalLabel" aria-hidden="true">
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

<div style="padding-bottom: 300px;"></div>

<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - - --->
<footer class="bg-dark text-center text-white fixed-bottom">
    <div class = "container-fluid">
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
        <div class ="row">
            <div class="container-fluid text-center p-3" style="background-color: black;">
                © 2022. Tiunoff bank, официальный сайт.
            </div>
        </div>
    </div>
</footer>
<!-- - - - - - - - - - - - - - - - -  F  O  O  T  E  R - - - - - - - - - - - - - - - - - - --->

</body>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="http://194.67.116.171/js/bootstrap.bundle.js"></script>
<script src="http://194.67.116.171/js/user/notifications.js"></script>
<script src="http://194.67.116.171/js/user/cabinet_additional.js"></script>

</html>
