<?php

session_start();

session_destroy();



//Remove todas as informações contidas na variaveis globais

unset($_SESSION);
//redirecionar o usuário para a página de login

header("Location: index.php");

?>