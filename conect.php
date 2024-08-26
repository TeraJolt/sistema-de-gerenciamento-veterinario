<?php
    $servidor='localhost';
    $usuario='sgvet';
    $senha= '7zdVh(W4EjD8@!.v';
    $db='sysvet';
    $con=mysqli_connect($servidor,$usuario,$senha,$db);
    if (!$con){
        print("Erro na conexão com MySQL");
        print("Erro: " . mysqli_connect_error());
        exit;
    }
    
?>