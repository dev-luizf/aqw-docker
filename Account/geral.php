<?php
	#CONEXÃO COM O BANCO DE DADOS (env-aware for Docker)
	define('DB_HOST', getenv('MYSQL_HOST') !== false && getenv('MYSQL_HOST') !== '' ? getenv('MYSQL_HOST') : '127.0.0.1');
	define('DB_USER', getenv('MYSQL_USER') !== false && getenv('MYSQL_USER') !== '' ? getenv('MYSQL_USER') : 'root');
	define('DB_PASS', getenv('MYSQL_PASSWORD') !== false ? getenv('MYSQL_PASSWORD') : '');
	define('DB_DATA', getenv('MYSQL_DATABASE') !== false && getenv('MYSQL_DATABASE') !== '' ? getenv('MYSQL_DATABASE') : 'mextv3');
	
	#NA STRING ABAIXO FICA OS PLAYERS QUE NÃO PODEM LOGAR
	#PODE ACRESCENTAR MAIS NOMES NA LISTA
	#TODOS TEM QUE FICAR SEPARADOS POR VÍRUGA E SEM ESPAÇOS ENTRE AS VIRGULAS E O NOME
	$locked = "";
?>
