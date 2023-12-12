<!DOCTYPE html>
<html lang="pt-br">
<?php
/**
 * @author Maike Leandro <maikeleandro996@gmail.com>
 * @copyright (c) Maike Leandro.
 * @see Back-End 1.0
 */
session_start();
require_once('classes/ClassLib.php');
?>

<head>
    <!-- META SECTION -->
    <title>Back-End</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="img/favicon/favicon.ico" type="image/x-icon" />
    <!-- END META SECTION -->


    <!-- CSS INCLUDE -->
    <link rel='stylesheet' type='text/css' href='css/bootstrap4/bootstrap.min.css' />
    <link rel='stylesheet' type='text/css' href='css/theme-task.css' />
    <!-- EOF CSS INCLUDE -->

    <script type='text/javascript' src='js/jquery/jquery.min.js'></script>
</head>

<body>



    <div class='container-fluid'>
        <div class='row-container'>
            <div class='card-body modal-body-result3 divBorda'>
                <i class="fa fa-spinner fa-pulse fa-3x fa-fw" style="display: none;" id="loading"></i>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="edt_barcode_impressora"><b>Informe o Tipo</b></label>
                        <select id="edt_tipo" class="form-control col-2">
                            <option value='people' selected>Pessoa</option>
                            <option value='planets'>Planeta</option>
                            <option value='starships'>Foguete</option>
                        </select>
                        </br>
                        <label for="edt_barcode_impressora"><b>Informe o Índice</b></label>
                        <select id="edt_quantidade" class="form-control col-2">
                            <option value='0' selected>Selecione</option>
                            <option value='1' selected>1</option>
                            <option value='2' selected>2</option>
                            <option value='3' selected>3</option>
                            <option value='4' selected>4</option>
                            <option value='5' selected>5</option>
                            <option value='6' selected>6</option>
                            <option value='7' selected>7</option>
                            <option value='8' selected>8</option>
                            <option value='9' selected>9</option>
                        </select>
                    </div>

                    <div class="form-group row col-10">
                        <div class="col col-sm-12 col-md-12">
                            <button type="button" class="btn btn-primary" id="edt-pesquisar">Pesquisar</button>
                            <button type="button" class="btn btn-danger" id="edt-limpar">Limpar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class='card-body modal-body-result4'>
                <div class="modal-body">
                    <div class='form-group'>
                        <label><b>Resultado</b></label>
                        <div class='input-group'>
                            <textarea class="form-control" rows='50' disabled id="edt-pesquisa-retorno"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class='card-body modal-body-result2 divBorda'>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 control-label"><strong>Geração do Log</strong></label>
                        <div class="input-group">
                            <input class="form-control" type="text" id="edt-log-retorno" disabled>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>




    <!-- START PLUGINS -->
    <script type="text/javascript" src="js/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery/jquery-stickytableheaders.js"></script>
    <script type="text/javascript" src="js/bootstrap4/bootstrap.min.js"></script>
    <!-- END PLUGINS-->

    <!-- CUSTOM SCRIPT -->
    <script type='text/javascript' src='js/index.js'></script>
    <!-- CUSTOM SCRIPT -->
    <!-- END SCRIPTS -->
</body>

</html>