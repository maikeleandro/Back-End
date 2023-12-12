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

try {

    $resultado = "1";
    $mensagem = "<strong>Atenção!</strong> Problemas ao processar requisição, contate o Administrador do Sistema.";
    $lsRetorno = new ArrayObject();

    //****************************************************************//
    //--------------------- INCLUIR CONEXAO 
    //****************************************************************//   

    require_once("../classes/ClassLib.php");

    //****************************************************************//
    //--------------------- BUSCAR PARAMETROS 
    //****************************************************************//   

    $cTipo = trim((isset($_POST['Tipo']) ? $_POST['Tipo'] : '0'));
    $nId = trim((isset($_POST['Id']) ? $_POST['Id'] : '0'));


    //****************************************************************//
    //--------------------- EXECUTAR FUNÇÃO
    //****************************************************************//

    $con = new connect;

    if ($nId != 0) {
        $mensagem = $con->Conectar($cTipo, $nId);
    } else {
        $mensagem = $con->Conectar($cTipo);
    }   
    
    $lsRetorno->offsetSet('Resultado', $mensagem['Resultado']);
    $lsRetorno->offsetSet('Mensagem', $mensagem['Mensagem']);
    $lsRetorno->offsetSet('Retorno', $mensagem['Retorno']);
    $lsRetorno->offsetSet('Url', $mensagem['Url']);
    
} catch (Exception $e) {
    
    $resultado = '0';
    $mensagem = "<strong>Atenção!</strong> Problemas ao processar, tente novamente mais tarde! <br/><br/><strong>Motivo:</strong> " . $e->getMessage();

} finally {

    echo json_encode(
        array(
            'Resultado' => $lsRetorno['Resultado'],
            'Mensagem' => $lsRetorno['Mensagem'],
            'Retorno' => $lsRetorno['Retorno'],
            'Url' => $lsRetorno['Url']
        )
    );
}
