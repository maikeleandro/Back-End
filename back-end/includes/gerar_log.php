<?php

/**
 * @author Maike Leandro <maikeleandro996@gmail.com>
 * @copyright (c) Maike Leandro.
 * @see Back-End 1.0
 */

//****************************************************************//
//--------------------- ATUALIZAR HEADER
//****************************************************************//   

header('Content-Type: text/html; charset=utf-8');

//****************************************************************//
//---------------------INICIAR SESSAO
//****************************************************************//   

session_start();

//****************************************************************//
//---------------------FUNÇÕES
//****************************************************************// 

function CriarLog($Url = null, $msg = null, $tipo = null, $id = null)
{
    date_default_timezone_set('America/Sao_Paulo');

    $data = date("d-m-y");
    $hora = date("H:i:s");
    //$ip = $_SERVER['REMOTE_ADDR'];

    //Nome do arquivo:
    $arquivo = "../log/Log_$data.txt";

    //Texto a ser impresso no log:
    $texto = "Execução: $hora \nURL de Envio: $Url\nRequisição:: [Tipo: $tipo] [Id: $id] \nRetorno: $msg";

    $manipular = fopen("$arquivo", "a+b");
    fwrite($manipular, $texto);
    fclose($manipular);
}

try {

    $resultado = '1';
    $mensagem = 'Sucesso, log gerado com êxito!';
    $lsRetorno = new ArrayObject();

    //****************************************************************//
    //--------------------- INCLUIR CONEXAO 
    //****************************************************************//   

    require_once("../classes/ClassLib.php");

    //****************************************************************//
    //--------------------- BUSCAR PARAMETROS 
    //****************************************************************//   

    $cUrl = trim((isset($_POST['Url']) ? $_POST['Url'] : '0'));
    $cMsg = trim((isset($_POST['Msg']) ? $_POST['Msg'] : '0'));
    $cTipo = trim((isset($_POST['Tipo']) ? $_POST['Tipo'] : '0'));
    $nId = trim((isset($_POST['Id']) ? $_POST['Id'] : '0'));

    //****************************************************************//
    //--------------------- EXECUTAR FUNÇÃO
    //****************************************************************//

    if($nId == 0){
        $nId = "";
    }

    CriarLog($cUrl,$cMsg, $cTipo, $nId);

    $lsRetorno->offsetSet('Resultado', $resultado);
    $lsRetorno->offsetSet('Mensagem', $mensagem);
} catch (Exception $e) {
    $resultado = '0';
    $mensagem = "Atenção. Problemas ao processar, tente novamente mais tarde! Motivo: " . $e->getMessage();
} finally {

    echo json_encode(
        array(
            'Resultado' => $lsRetorno['Resultado'],
            'Mensagem' => $lsRetorno['Mensagem'],
        )
    );
}
