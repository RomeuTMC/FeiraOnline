<?php
define("SISTEM", "Amazing Thailand Virtual Trade Meet");
define("SIS_VER", "Versão 1.0"); // VERSÃO DO SISTEMA ADMIN
define("SIS_COPYRIGHT", "Copyright TMC Comunicação - 06/2020 - Proibido Cópia Total ou Parcial");
define("URL","https://tmccomunicacao.com.br/feiraonline/"); //URL da RAIZ do SISTEMA
define("_FS","/home/tmcco608/public_html/feiraonline/");
define("DATA_FIM_CADASTRO", '2020-08-23');
define("EMAIL_FROM","FeiraOnLine <romeu@tmccomunicacao.com.br>");
define("EMAIL","romeu@tmccomunicacao.com.br");
define("SERVERDB","127.0.0.1");
define("DBNAME","tmcco608_feira");
define("DBUSER","tmcco608_feira");
define("DBPASSW","xoxota2020");
define("SSID", "FRL.".md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT']));

ini_set('session.name','TMCloginControl');
date_default_timezone_set('America/Sao_Paulo'); //garante que a TIMEZONE esteja correta
$cookieParams['lifetime'] = 0;
$cookieParams['domain'] = 'tmccomunicacao.com.br';
$cookieParams['secure'] = true;
$cookieParams['httponly'] = true;
$cookieParams['samesite'] = "Lax";
session_set_cookie_params($cookieParams);
session_name('TMCloginControl');
?>