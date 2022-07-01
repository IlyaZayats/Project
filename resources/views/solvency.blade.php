<!DOCTYPE html>
<html lang="ru">
    <head>
        <title>Личный кабинет | Проверка платежеспособности</title>
		<meta charset='utf-8'/>
		<meta http-equiv='X-UA-Compatible' content='IE=edge'/>
		<link href="http://194.67.116.171/css/bootstrap.css" rel="stylesheet">
		<link rel="shortcut icon" href="http://194.67.116.171/img/tiunoff.png" type="image/png">
        <link rel="stylesheet" href="http://194.67.116.171/css/solvency.css"/>
        <link rel="stylesheet" href="http://194.67.116.171/css/nav-style.css"/>
    </head>
    <body>

        <!-- - - - - - - - - - - - - - - - - - - N A V B A R - - - - - - - - - - - - - - - - - - - - - -->
        
        
        <nav class="navbar navbar-expand-lg" style="background-color: black;"></nav>
        
        <div class="p-3 mb-2 bg-dark">
            <ul class="nav justify-content-end">
            <li class="nav-item col-12 col-md-11">
            <a class="nav-link text-white" href="http://194.67.116.171">Главная</a>
            </li>
            <li class="nav-item col-12 col-md-1">
            <button onclick="location.href='http://194.67.116.171/leave'" class="btn btn-style">Выйти</button>
            </li>
            </ul>
        </div>
        
    
        <!-- - - - - - - - - - - - - - - - - S O L V E N C Y - - - - - - - - - - - - - - - - - - - -->
        
        
        <div class = "container-fluid mb-3">
            <div class="row">
                <div class="col-md-12 mt-4 mb-3 text-center title_lk">
                    <h1 class="py-3">ЛИЧНЫЙ КАБИНЕТ</h1>
                </div>
            </div>
            <div class="col-md-12 mt-3 mb-5 text-center">
                <h5 style="font-weight: bold"><a class="text-danger" href="http://194.67.116.171/cabinet">ЗАЯВКА №{{$id}}</a>/<a class="text-danger" href="#" onclick="history.go(-1);">ПРОВЕРКА ДАННЫХ</a>/ПРОВЕРКА ПЛАТЁЖЕСПОСОБНОСТИ</h5>
            </div>

            <div class="col-11 col-lg-8 mx-auto">
                <form id="solvencyForm" accept-charset="UTF-8">
                    @csrf
                    <div class="row mb-3 col-12">
                        <label for="inputIncome" class="col-12 col-lg label-solvency">Ежемесячный доход:</label>
                        <div class="col-12 col-lg">
                            <input type="text" class="form-control data" name="income" id="inputIncome">
                            <div class="error income"></div>
                        </div>
                    </div>
                    <div class="row mb-3 col-12">
                        <label for="inputDuty" class="col-12 col-lg label-solvency">Ежемесячный долг:</label>
                        <div class="col-12 col-lg">
                            <input type="text" class="form-control data" name="duty" id="inputDuty">
                            <div class="error duty"></div>
                        </div>
                    </div>
                    <div class="col-8 mx-auto">
                        <input type="button" id="getSolvencyButton" class="btn btn-get my-2 w-100" value="РАССЧИТАТЬ">
                    </div>
                </form>
                <div class="row mt-3 col-12">
                    <label for="outputSolvency" class="col-12 col-lg label-solvency">Максимально возможная ежемесячная платежеспособность клиента:</label>
                    <div class="col-12 col-lg">
                        <input type="text" class="form-control data" name="duty" id="outputSolvency" value="" disabled>
                    </div>
                </div>
            </div>

        </div>
      
        
    
        <!-- - - - - - - - - - - - - - - - - - F  O  O  T  E  R - - - - - - - - - - - - - - - - - - - - -->
    
    
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
                        <button type="button" class="btn modal-button w-100"></button>
                    </div>
                </div>
            </div>
        </div>

    </body>
	<script src="http://194.67.116.171/js/jquery_v3.6.0.js"></script>
	<script src="http://194.67.116.171/js/bootstrap.js"></script>
    <script src="http://194.67.116.171/js/loan_officer/solvency.js"></script>
	<script src="http://194.67.116.171/leave.js"></script>
</html>
