<?php
/*
        link de ajuda
        https://pt.stackoverflow.com/questions/363309/curl-passagem-e-recep%C3%A7%C3%A3o-de-par%C3%A2metros
        https://www.php.net/manual/pt_BR/function.curl-setopt.php
    */
require_once('class.url.php');

class connect
{

    function Conectar($tipo = null, $id = null)
    {

        $resultado = '0';
        $erro      = null;
        $info      = null;
        $lsRetorno = new ArrayObject();

        try {

            $url = $GLOBALS["URL"];

            if ($id != "0") {
                $link = $url .''. $tipo.'/'.$id;
                
            }
            else{
                $link = $url .''. $tipo;
                
            }

            // Um manipulador cURL retornado por curl_init().
            $ch = curl_init($link);

            //A URL a ser buscada. Isso também pode ser definido ao inicializar uma sessão com curl_init().
            curl_setopt($ch, CURLOPT_URL, $link);

            // true para fazer um POST HTTP regular. 
            //Este POST é o tipo application/x-www-form-urlencoded normal, mais comumente usado por formulários HTML.
            curl_setopt($ch, CURLOPT_POST,  true);

            // true para incluir o cabeçalho na saída.
            curl_setopt($ch, CURLOPT_HEADER, false);

            /* Um método de solicitação personalizado para usar em vez de "GET" 
            ou "HEAD" ao fazer uma solicitação HTTP. Isso é útil para fazer "GET" 
            ou outras solicitações HTTP mais obscuras. Os valores válidos são coisas 
            como "GET", "POST", "CONNECT" e assim por diante; ou seja, não insira uma 
            linha de solicitação HTTP inteira aqui. Por exemplo, inserir "GET /index.html HTTP/1.0\r\n\r\n" seria incorreto.
            Nota:
            Não faça isso sem antes certificar-se de que o servidor 
            oferece suporte ao método de solicitação personalizado. */
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


            /* false para impedir que o cURL verifique o certificado do par. 
            Certificados alternativos para verificação podem ser especificados 
            com a opção CURLOPT_CAINFO ou um diretório de certificados pode ser especificado com a opção CURLOPT_CAPATH.*/
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            /* A quantidade máxima de conexões persistentes permitidas. 
            Quando o limite é atingido, o mais antigo do cache é fechado 
            para evitar o aumento do número de conexões abertas.*/
            curl_setopt($ch, CURLOPT_MAXCONNECTS, 3);

            /* O número de segundos a aguardar durante a tentativa de conexão. 
            Use 0 para esperar indefinidamente.*/
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

            /* O número máximo de milissegundos para permitir que as funções cURL sejam executadas. 
            Se libcurl for construído para usar o resolvedor de nome do sistema padrão, 
            essa parte da conexão ainda usará a resolução de segundo completo para tempos limite 
            com um tempo limite mínimo permitido de um segundo.*/
            curl_setopt($ch, CURLOPT_TIMEOUT_MS, 60000);

            /* A velocidade de transferência, em bytes por segundo, que a transferência deve estar 
            abaixo durante a contagem de CURLOPT_LOW_SPEED_TIME segundos antes do PHP considerar 
            a transferência muito lenta e abortar. */
            curl_setopt($ch, CURLOPT_LOW_SPEED_LIMIT, 1000000);

            /* O número de segundos que a velocidade de transferência deve estar abaixo 
            de CURLOPT_LOW_SPEED_LIMIT antes que o PHP considere a transferência muito lenta e aborte.*/
            curl_setopt($ch, CURLOPT_LOW_SPEED_TIME, 60000);

            /* true para retornar a transferência como uma string do valor de 
            retorno de curl_exec() em vez de emiti-la diretamente.*/
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // pegar URL e passá-lo para o navegador
            $resultado = json_decode(curl_exec($ch), true);

            // Retorna uma string contendo o último erro da sessão atual
            $erro      = curl_error($ch);

            // feche o recurso cURL e libere recursos do sistema
            $info      = curl_getinfo($ch);
            $lsRetornoWebService = new ArrayObject();
        } catch (Exception $e) {
            $resultado = '0';
            $mensagem = curl_error($ch);
            curl_close($ch);
        } finally {
            
            if ($erro == "") {
                $lsRetorno->offsetSet('Resultado', '1');
                $lsRetorno->offsetSet('Mensagem', '');
                $lsRetorno->offsetSet('Retorno', $resultado);
                $lsRetorno->offsetSet('Url', $link);
            } else {
                $lsRetorno->offsetSet('Resultado', '0');
                $lsRetorno->offsetSet('Mensagem', $erro);
                $lsRetorno->offsetSet('Retorno', $info);
                $lsRetorno->offsetSet('Url', $link);
            }

            // Fecha uma sessão cURL
            curl_close($ch);
            return $lsRetorno;
        }
    }
}
