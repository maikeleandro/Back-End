# Back-End
Projeto Back-End


Este projeto é baseado em conexão com Web Service.
Utilizando as funções curl_setopt do php.
Todo o projeto está baseado em orientação a objeto, a classe connect “class.connect.php” é onde faz a conexão com o Web Service, no entanto url que irá buscar está em outra classe “class.url.php”.
A classe lib “ClassLib.php” é a classe que será usada como meio campo, por ela que iremos acessar as demais classes.

Na pasta include, esta as funções que irá chamar a conexão e irá passar os dados ao web service, consequente o include gerar log, irá gerar um log na pasta log.

O projeto possui uma página index.php, onde o usuário poderá ele mesmo realizar a pesquisa que ele quiser.
Mostrando o resultado na tela e no final da tela, possui um campo referente ao log, se ele foi gerado correntemente ou não.
