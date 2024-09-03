<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGVet - Perfil de Cliente</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
    include('../conect.php');
    include('../functions/functions.php');
    $id=$_GET['id'];

    $query="SELECT * FROM costumers WHERE id=$id";

    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
?>
<body>
    <?php include('../frame/frame.php')?>
    <main class="mainSide">
        <article class="mainArticle">
            <section class="buttonsSection buttonsTopSection">
                <p><a href="./costumerConsult.php?searchThing=<?php echo $row['cpf'];?>" class="button linkButton buttonCancel">< Voltar</a></p>
            </section>
            <header class="mainHeader"><?php echo $row['name'];?></header>  
        </article>
        <article class="buttonsFold">
            <p><a href="./costumerProfile.php?id=<?php echo $row['id']?>" class="page">Dados Pessoais</a></p>
            <p><a href="" class="page atualPage">Animais</a></p>
        </article>
        <article class="mainArticle">
            
        </article>
    </main>
</body>
<?php mysqli_close($con);?>
</html>