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
            <p><a href="" class="page atualPage">Dados Pessoais</a></p>
            <p><a href="./costumerAnimals.php?id=<?php echo $row['id']?>" class="page">Animais</a></p>
        </article>
        <article class="mainArticle">
            <section class="buttonsSection">
                <p><a href="./costumerUpdate.php?id=<?php echo $row['id'];?>" class="button linkButton buttonSubmit">Atualizar ></a></p>
            </section>
            <article class="mainForm">
                <fieldset class="formFieldset">
                    <legend class="formLabel"><p>Dados Pessoais </p></legend>
                    <section class="formSection">
                        <section>
                                <p class="formLabel resultLabel">Prontuário:</p>
                                <p class="formLabel resultReturn"><?php echo $row['id'];?></p>
                        </section>
                        <section>
                                <p class="formLabel resultLabel">Data de Nascimento:</p>
                                <p class="formLabel resultReturn"><?php echo dateFormater($row['bornDate']);?></p>
                        </section>
                        <section>
                                <p class="formLabel resultLabel">CPF:</p>
                                <p class="formLabel resultReturn"><?php echo cpfFormater($row['cpf']);?></p>
                        </section>
                    </section>
                </fieldset>
                <fieldset class="formFieldset">  
                    <legend class="formLabel"><p>Contato</p></legend>
                    <section  class="formSection">
                        <section>
                            <p class="formLabel resultLabel">Email:</p>
                            <p class="formLabel resultReturn"><?php echo $row['email'];?></p>
                        </section>
                        <section>
                            <p class="formLabel resultLabel">Telefone:</p>
                            <p class="formLabel resultReturn"><?php echo phoneFormater($row['phone']);?></p>
                        </section>
                    </section>
                </fieldset>
                <fieldset class="formFieldset">
                    <legend class="formLabel"><p>Endereço</p></legend>
                    <section class="formSection">
                        <section>
                            <p class="formLabel resultLabel">CEP:</p>
                            <p class="formLabel resultReturn"><?php echo cepFormater($row['cep']);?></p>
                        </section>
                    </section>
                    <section class="formSection">
                        <section>
                            <p class="formLabel resultLabel">Estado:</p>
                            <p class="formLabel resultReturn"><?php echo $row['uf'];?></p>
                        </section>
                        <section>
                            <p class="formLabel resultLabel">Cidade:</p>
                            <p class="formLabel resultReturn"><?php echo $row['city'];?></p>
                        </section>
                        <section>
                            <p class="formLabel resultLabel">Bairro:</p>
                            <p class="formLabel resultReturn"><?php echo $row['neighborhood'];?></p>
                        </section>
                    </section>
                    <section class="formSection">
                        <section>
                            <p class="formLabel resultLabel">Rua:</p>
                            <p class="formLabel resultReturn"><?php echo $row['street'];?></p>
                        </section>
                        <section>
                            <p class="formLabel resultLabel">Número:</p>
                            <p class="formLabel resultReturn"><?php echo $row['number'];?></p>
                        </section>
                    </section>
                    <section class="formSection">
                        <section>
                            <p class="formLabel resultLabel">Complemento:</p>
                            <p class="formLabel resultReturn"><?php echo $row['complement'];?></p>
                        </section>
                        <section>
                            <p class="formLabel resultLabel">Ponto de Referência:</p>
                            <p class="formLabel resultReturn"><?php echo $row['reference'];?></p>
                        </section>
                    </section>
                </fieldset>
            </article>
        </article>
    </main>
</body>
<?php mysqli_close($con);?>
</html>