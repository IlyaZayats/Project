<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
    <link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
    <link rel="stylesheet" href="http://194.67.116.171/css/registration.css">
    <title>Регистрация</title>
</head>
<body>
<div class="container-fluid">

    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="responseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title response-title" id="responseModalLabel"></h5>
                </div>
                <div class="modal-body response-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn modal-button w-100"></button>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex">
        <div class="bg-black upper-back d-flex d-lg-none"></div>
        <div class="col-12 col-lg-4 px-lg-0 text-center text-lg-start px-0 px-lg-2 mt-lg-4">
            <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn back-button px-0 px-lg-2 py-3 py-lg-0">
                <img class="d-none d-lg-inline img-arrows" src="http://194.67.116.171/img/arrows_to_left.png" alt="arrow_to_left">
                На главную
            </a>
        </div>
        <div class="col-12 col-lg-4 main-title mx-auto mb-3 mt-lg-2 text-center text-bold px-0">
            Регистрация
        </div>
        <div class="col-12 col-lg-4">

        </div>
        <div class="col-10 col-md-8 col-xl-4 mx-auto justify-content-center align-items-center">
            <form id="registrationForm" accept-charset="UTF-8">
                <div class="form-row">
                    @csrf
                    <div class="surname-wrapper">
                        <label class="" for="userSurname">Фамилия</label><br/>
                        <input class="col-12 form-control data" id="userSurname" type="text" name="userSurname" placeholder="Введите фамилию">
                        <div class="error text-end surname"></div>
                    </div>
                    <div class="name-wrapper mt-3">
                        <label class="" for="userName">Имя</label><br/>
                        <input class="col-12 form-control data" id="userName" type="text" name="userName" placeholder="Введите имя">
                        <div class="error text-end name"></div>
                    </div>
                    <div class="second-name-wrapper mt-3">
                        <label class="" for="userSecondName">Отчество</label><br/>
                        <input class="col-12 form-control data" id="userSecondName" type="text" name="userSecondName" placeholder="Введите отчество">
                        <div class="error text-end second-name"></div>
                    </div>
                    <div class="passport-wrapper mt-3">
                        <label class="" for="userPassport">Пасспорт</label><br/>
                        <input class="col-12 form-control data" id="userPassport" type="text" name="userPassport" placeholder="Введите пасспорт(серия,номер)">
                        <div class="error text-end passport"></div>
                    </div>
                    <div class="itn-wrapper mt-3">
                        <label class="" for="userITN">ИНН</label><br/>
                        <input class="col-12 form-control data" id="userITN" name="userITN" type="text" placeholder="Введите ИНН">
                        <div class="error text-end itn"></div>
                    </div>
                    <div class="email-wrapper mt-3">
                        <label class="" for="userEmail">Адрес электронной почты</label><br/>
                        <input class="col-12 form-control data" id="userEmail" name="userEmail" type="email" placeholder="Введите адрес электронной почты">
                        <div class="error text-end email"></div>
                    </div>
                    <div class="login-wrapper mt-3">
                        <label class="" for="userLogin">Логин</label><br/>
                        <input class="col-12 form-control data" id="userLogin" name="userLogin" type="text" placeholder="Введите логин">
                        <div class="error text-end login"></div>
                    </div>
                    <div class="password-wrapper mt-3">
                        <label class="" for="userPassword">Пароль</label><br/>
                        <input class="col-12 form-control data" id="userPassword" name="userPassword" type="password" placeholder="Введите пароль">
                        <input class="col-12 mt-1 form-control data" id="userPasswordCheck" type="password" placeholder="Подтвердите пароль">
                        <div class="error text-end password"></div>
                    </div>
                    <div class="check-wrapper mt-3">
                        <input type="checkbox" id="userPolicy" class="form-check-input">
                        <label for="userPolicy" class="form-check-label">Даю согласие на обработку</label>
                        <a class="text-decoration-none form-check-label" href="https://www.youtube.com/watch?v=dQw4w9WgXcQ">персональных данных</a>
                        <div class="error text-end policy"></div>
                    </div>
                    <div class="confirm-button-wrapper text-center">
                        <input type="button" class="btn col-8 mt-3 confirm-button" id="confirmButton" value="Продолжить">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
<script src="http://194.67.116.171/js/bootstrap.js"></script>
<script src="http://194.67.116.171/js/admin_registration_editing.js"></script>
</body>
</html>