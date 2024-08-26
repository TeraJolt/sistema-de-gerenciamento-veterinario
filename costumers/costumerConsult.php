<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGVet - Consultar Clientes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <?php include('../frame/frame.php')?>
    <main class="mainSide">
        <article class="mainArticle">
            <header class="mainHeader">Consultar Clientes:</header>
            <article class="mainForm">
                <form>
                    <section class="searchSection">
                        <section>
                            <?php
                                include('../conect.php');
                                include('../functions/functions.php');

                                if(isset($_GET['searchThing']) AND ($_GET['searchThing'])!=''){
                                    ?>
                                        <p><input class="formCamp searchBar" type="text" name="searchThing" size="40" placeholder="Digite o Nome ou CPF para pesquisar!" value="<?php echo $_GET['searchThing']?>"></p>
                                    <?php
                                }else{
                                    ?>
                                        <p><input class="formCamp searchBar" type="text" name="searchThing" size="40" placeholder="Digite o Nome ou CPF para pesquisar!"></p>
                                    <?php
                                }
                            ?>
                        </section>
                        <section>
                            <p><input class="buttonSearch" type="submit" value="Procurar"></p>
                            <p><a href="./costumerAdd.php" class="buttonSearch buttonAdd">Adicionar</a></p>
                        </section>
                    </section>
                </form>
            </article>
        </article>
        <?php
            $query = "SELECT * FROM costumers";

            if(isset($_GET['searchThing']) AND ($_GET['searchThing'])!=''){
                $searchThing = $_GET['searchThing'];
                $query .= " WHERE UPPER(name) LIKE CONCAT('%', UPPER('$searchThing'), '%') OR cpf = '$searchThing' ORDER BY id";
                $result = mysqli_query($con,$query) or die(mysqli_connect_error());
    
                while ($reg = mysqli_fetch_array($result)){
                    ?>
                        <article class="mainArticle searchResult">
                            <fieldset class="formFieldset">
                                <legend class="formLabel"><p><?php echo $reg['name'];?></p></legend>
                                <section class="formSection resultSection">
                                    <section class="formSection resultSection">
                                        <section>
                                            <p class="formLabel resultLabel">Prontuário:</p>
                                            <p class="formLabel resultReturn"><?php echo $reg['id'];?></p>            
                                        </section>
                                        <section>
                                            <p class="formLabel resultLabel">CPF:</p>
                                            <p class="formLabel resultReturn"><?php echo cpfFormater($reg['cpf']);?></p>
                                        </section>
                                        <section>
                                            <p class="formLabel resultLabel">Email:</p>
                                            <p class="formLabel resultReturn"><?php echo $reg['email'];?></p>
                                        </section>
                                        <section>
                                            <p class="formLabel resultLabel">Telefone:</p>
                                            <p class="formLabel resultReturn"><?php echo phoneFormater($reg['phone']);?></p>
                                        </section>
                                    </section>
                                    <section class="buttonsSection buttonInternalSection">
                                        <p><a href="./costumerProfile.php?id=<?php echo$reg['id'];?>" class="buttonUpdate" >Visualizar</a></p>
                                    </section>
                                </section>
                            </fieldset>
                        </article>
                    <?php
                }
            }
            mysqli_close($con);
        ?>
    </main>
</body>
</html>