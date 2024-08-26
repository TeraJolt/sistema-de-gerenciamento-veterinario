<!-- Script PHP para conectar com o Banco de Dados -->
<?php
    include('../conect.php');
    $id=$_GET['id'];
    $query="SELECT * FROM costumers WHERE id=$id";
    $result=mysqli_query($con,$query);
    $row=mysqli_fetch_assoc($result);
    mysqli_close($con);

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        //chama a conexão com o Banco de Dados
        include('../conect.php');

        //instancia as variáveis com os valores dos campos
        $id=$_GET['id'];
        $name=$_POST['name'];
        $bornDate=$_POST['bornDate'];
        $email=$_POST['email'];
        $phone=$_POST['phone'];
        $cep=$_POST['cep'];
        $street=$_POST['street'];
        $neighborhood=$_POST['neighborhood'];
        $city=$_POST['city'];
        $uf=$_POST['uf'];
        $number=$_POST['number'];
        $complement=$_POST['complement'];
        $reference=$_POST['reference'];

        $query="UPDATE costumers SET 
            name='$name',
            bornDate='$bornDate',
            email='$email',
            phone='$phone',
            cep='$cep',
            street='$street',
            neighborhood='$neighborhood',
            city='$city',
            uf='$uf',
            number='$number',
            complement='$complement',
            reference='$reference'
            WHERE id=$id";

        $resu=mysqli_query($con,$query);
        
        if($resu){
            echo "<script>alert('Atualização feita com sucesso!!');</script>";
        }else{
            echo "<script>alert('ERRO ao atualizar os dados: ".mysqli_error($con)."');</script>";
        }
        mysqli_close($con);

        header("Location: costumerProfile.php?id=".$row['id']);
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SGVet - Cadastro de Clientes</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Script do ViaCEP utilizando JavaScript -->
    <script>
        function limpa_formulario_cep(){
            //Limpa valores do formulário de cep.
            document.getElementById('idStreet').value=("");
            document.getElementById('idNeighborhood').value=("");
            document.getElementById('idCity').value=("");
            document.getElementById('idUf').value=("");
        }

        function meu_callback(conteudo){
            if (!("erro" in conteudo)){
                //Atualiza os campos com os valores.
                document.getElementById('idStreet').value=(conteudo.logradouro);
                document.getElementById('idNeighborhood').value=(conteudo.bairro);
                document.getElementById('idCity').value=(conteudo.localidade);
                document.getElementById('idUf').value=(conteudo.uf);
            } //end if.
            else{
                //CEP não encontrado
                limpa_formulario_cep();
                alert("CEP não encontrado.");
            }
        }

        function pesquisa_cep(valor){

            //Nova variável "cep somente com dígitos"
            var idCep = valor.replace(/\D/g, '');

            //Verifica se campo cep possui valor informado
            if (idCep != ""){

                //Expressão regular para validar o CEP.
                var validaCep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validaCep.test(idCep)){

                    //Preenche os campos com "..." enquanto consulta webservice.
                    document.getElementById('idStreet').value="...";
                    document.getElementById('idNeighborhood').value="...";
                    document.getElementById('idCity').value="...";
                    document.getElementById('idUf').value="...";

                    //Cria um elemento javascript.
                    var script = document.createElement('script');

                    //Sincroniza com o callback.
                    script.src = 'https://viacep.com.br/ws/'+idCep+'/json/?callback=meu_callback';

                    //Insere script no documento e carrega o conteúdo.
                    document.body.appendChild(script);
                } //end if.
                else{
                    //cep é inválido.
                    limpa_formulario_cep();
                    alert("Formato de CEP inválido.");
                }
            } //end if.
            else{
                //cep sem valor, limpa formulário.
                limpa_formulario_cep();
            }
        };
    </script>
</head>
<body>
    <?php include('../frame/frame.php');
        include('../functions/functions.php');
    ?>
    <main class="mainSide">
        <article class="mainArticle">
            <header class="mainHeader">Atualização de Cadastro:</header>
            <article class="mainForm">
                <form method="POST">
                    <fieldset class="formFieldset">
                        <legend class="formLabel"><p>Dados Pessoais </p></legend>
                        <section class="formSection">
                            <section>
                                    <p class="formLabel">Prontuário:</p>
                                    <p><input class="formCamp" type="text" name="id" maxlength="5" size="5" value="<?php echo $row['id'];?>" disabled></p>
                            </section>
                            <section>
                                    <p class="formLabel">Nome:</p>
                                    <p><input class="formCamp" type="text" name="name" maxlength="50" size="35" value="<?php echo $row['name'];?>"></p>
                            </section>
                            <section>
                                    <p class="formLabel">Data de Nascimento:</p>
                                    <p><input class="formCamp" type="date" name="bornDate" value="<?php echo $row['bornDate'];?>"></p>
                            </section>
                            <section>
                                    <p class="formLabel">CPF:</p>
                                    <p><input class="formCamp" type="text" name="cpf" maxlength="15" size="15" value="<?php echo cpfFormater($row['cpf']);?>" disabled></p>
                            </section>
                        </section>
                    </fieldset>
                    <fieldset class="formFieldset">  
                        <legend class="formLabel"><p>Contato</p></legend>
                        <section  class="formSection">
                            <section>
                                <p class="formLabel">Email:</p>
                                <p><input class="formCamp" type="text" name="email" maxlength="50" size="35" value="<?php echo $row['email'];?>"></p>
                            </section>
                            <section>
                                <p class="formLabel">Telefone:</p>
                                <p><input class="formCamp" type="text" name="phone" maxlength="11" size="11" placeholder="xxxxxxxxxxx" value="<?php echo $row['phone'];?>"></p>
                            </section>
                        </section>
                    </fieldset>
                    <fieldset class="formFieldset">
                        <legend class="formLabel"><p>Endereço</p></legend>
                        <section class="formSection">
                            <section>
                                <p class="formLabel">CEP:</p>
                                <p><input class="formCamp" type="text" name="cep" id="idCep" maxlength="8" size="8" onblur=pesquisa_cep(this.value); value="<?php echo $row['cep'];?>"></p>
                            </section>
                        </section>
                        <section class="formSection">
                            <section>
                                <p class="formLabel">Estado:</p>
                                <p><input  class="formCamp" type="text" name="uf" id="idUf" maxlength="2" size="2" value="<?php echo $row['uf'];?>"></p>
                            </section>
                            <section>
                                <p class="formLabel">Cidade:</p>
                                <p><input class="formCamp" type="text" name="city" id="idCity" maxlength="50" size="35" value="<?php echo $row['city'];?>"></p>
                            </section>
                            <section>
                                <p class="formLabel">Bairro:</p>
                                <p><input class="formCamp" type="text" name="neighborhood" id="idNeighborhood" maxlength="50" size="35" value="<?php echo $row['neighborhood'];?>"></p>
                            </section>
                        </section>
                        <section class="formSection">
                            <section>
                                <p class="formLabel">Rua:</p>
                                <p><input class="formCamp" type="text" name="street" id="idStreet" maxlength="50" size="35" value="<?php echo $row['street'];?>"></p>
                            </section>
                            <section>
                                <p class="formLabel">Número:</p>
                                <p><input class="formCamp" type="text" name="number" maxlength="4" size="4" value="<?php echo $row['number'];?>"></p>
                            </section>
                        </section>
                        <section class="formSection">
                            <section>
                                <p class="formLabel">Complemento:</p>
                                <p><input class="formCamp" type="text" name="complement" maxlength="50" size="35" value="<?php echo $row['complement'];?>"></p>
                            </section>
                            <section>
                                <p class="formLabel">Ponto de Referência:</p>
                                <p><input class="formCamp" type="text" name="reference" maxlength="50" size="35" value="<?php echo $row['reference'];?>"></p>
                            </section>
                        </section>
                    </fieldset>
                    <section class="buttonsSection">
                        <p><input class="button buttonSubmit" type="submit" value="Atualizar"></p>
                        <p><a href="./costumerProfile.php?id=<?php echo $row['id']?>" class="button linkButton buttonCancel">Cancelar</a></p>
                    </section>
                </form>
            </article>
        </article>
    </main>
</body>
</html>