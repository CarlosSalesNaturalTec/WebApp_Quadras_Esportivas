<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('dbconnection.php');

Class WebService{

    function login(){
        session_start();
        //verifica se está logado
        if (!isset($_SESSION["SECusername"])) {
            header('Location: /index.php');
        }
        
    }

    function login_nivel($level){
        //verifica nível de usuário
        $nivel = $_SESSION["SECuserlevel"];
        if ($nivel > $level ) {
            header('Location: /sorry.php');
        }
    }

    function cad_clientes_corpo($aux0,$aux){

        if ($aux0 == "nome") {
            if ($aux == "Todos") {
                $sql = "select id_cli, nome, bairro,telefone,contatos,email ";
                $sql .= "from tbl_clientes ";
                $sql .= "order by nome";
            } else {
                $sql = "select id_cli, nome, bairro,telefone,contatos,email ";
                $sql .= "from tbl_clientes ";
                $sql .= "where nome like '$aux%' ";
                $sql .= "order by nome";
            }
        }

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('lbl_filtro').innerHTML='- (".$aux.")';");
        echo ("</script>");

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Editar' ";
            $bt1 .= "href='/cad_clientes_ficha.php?v1=".$row["id_cli"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt3 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Histórico de Locações' ";
            $bt3 .= "href='/locacoes_listagem.php?param=".$row["id_cli"]."'><i class='fa fa-calendar' 
            aria-hidden='true'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' title='Excluir' 
            onclick='Excluir(".$row["id_cli"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";
            
            echo( "<tr>");
            echo ("<td>".$bt3.$bt1.$bt2.$row["nome"]."</td>");
            echo ("<td>".$row["bairro"]."</td>");
            echo ("<td>".$row["telefone"]."</td>");
            echo ("<td>".$row["contatos"]."</td>");
            echo ("<td>".$row["email"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_clientes_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select nome, nascimento, CPF, rg, ";
        $sql .= "endereco, numero, cep, bairro, cidade, uf,  ";
        $sql .= "contatos, telefone , email,  ";
        $sql .= "observacoes, instagram ";
        $sql .= "from tbl_clientes ";
        $sql .= "where id_cli = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_nome').value='".$row["nome"]."';");
            echo("document.getElementById('input_matricula').value='".$id_aux."';");
            echo("document.getElementById('input_nascim').value='".$row["nascimento"]."';");
            echo("document.getElementById('input_cpf').value='".$row["CPF"]."';");
            echo("document.getElementById('input_rg').value='".$row["rg"]."';");
            echo("document.getElementById('input_end').value='".$row["endereco"]."';");
            echo("document.getElementById('input_numero').value='".$row["numero"]."';");
            echo("document.getElementById('input_cep').value='".$row["cep"]."';");
            echo("document.getElementById('input_bairro').value='".$row["bairro"]."';");
            echo("document.getElementById('input_cidade').value='".$row["cidade"]."';");
            echo("document.getElementById('input_uf').value='".$row["uf"]."';");
            echo("document.getElementById('input_contatos').value='".$row["contatos"]."';");
            echo("document.getElementById('input_whats').value='".$row["telefone"]."';");
            echo("document.getElementById('input_email').value='".$row["email"]."';");

            $texto = str_replace("\n"," - ",$row["observacoes"]);
            $texto1 = str_replace("\r","",$texto);
            echo("document.getElementById('input_obs').value='".$texto1."';");

            echo("document.getElementById('input_instagram').value='".$row["instagram"]."';");
        }
        mysqli_free_result($query); 

        echo ("document.getElementById('input_nome').focus();");
        echo ("</script>");

    }

    function cad_locacoes_corpo(){

        $sql = "select t2.nome as quadra, ";
        $sql .= "t1.id_loc as idAux, date_format(t1.data_locacao,'%d/%m/%y') as d1, ";
        $sql .= "t1.hora1 as inicio, t1.hora2 as termino, ";
        $sql .= "t1.tipo, t1.obs, t1.valor_total, t1.id_cli as id_cliente, t1.cliente, ";
        $sql .= "t3.nome as usuario ";
        $sql .= "from tbl_locacoes t1 ";
        $sql .= "inner join tbl_quadras t2 on ( t1.id_quadra = t2.id_quadra ) ";
        $sql .= "inner join tbl_usuarios t3 on ( t1.id_user = t3.id_user ) ";
        $sql .= "where t1.data_locacao >= CURDATE() ";
        $sql .= "order by t1.data_locacao, hour(t1.hora1)";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            
            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Editar' ";
            $bt1 .= "href='/cad_locacoes_ficha.php?v1=".$row["idAux"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' title='Excluir' 
            onclick='Excluir(".$row["idAux"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            $valor1 = number_format($row["valor_total"],2,",",".");
            
            echo( "<tr>");
            echo ("<td>".$bt1.$bt2.$row["quadra"]."</td>");
            echo ("<td>".$row["d1"]."</td>");
            echo ("<td>".$row["inicio"]."</td>");
            echo ("<td>".$row["termino"]."</td>");
            echo ("<td>".$valor1."</td>");
            echo ("<td>".$row["tipo"]."</td>");
            echo ("<td>".$row["id_cliente"]."</td>");
            echo ("<td>".$row["cliente"]."</td>");
            echo ("<td>".$row["obs"]."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_locacoes_corpo2(){

        $sql = "select t2.nome as quadra, ";
        $sql .= "t1.id_loc as idAux, date_format(t1.data_locacao,'%d/%m/%y') as d1, ";
        $sql .= "t1.hora1 as inicio, t1.hora2 as termino, ";
        $sql .= "t1.tipo, t1.obs, t1.valor_total, t1.id_cli as id_cliente, t1.cliente, ";
        $sql .= "t3.nome as usuario ";
        $sql .= "from tbl_locacoes t1 ";
        $sql .= "inner join tbl_quadras t2 on ( t1.id_quadra = t2.id_quadra ) ";
        $sql .= "inner join tbl_usuarios t3 on ( t1.id_user = t3.id_user ) ";
        $sql .= "where t1.data_locacao <= CURDATE() ";
        $sql .= "order by t1.data_locacao, hour(t1.hora1)";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Editar' ";
            $bt1 .= "href='/cad_locacoes_ficha.php?v1=".$row["idAux"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' title='Excluir' 
            onclick='Excluir(".$row["idAux"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            $valor1 = number_format($row["valor_total"],2,",",".");
            
            echo( "<tr>");
            echo ("<td>".$bt2.$row["quadra"]."</td>");
            echo ("<td>".$row["d1"]."</td>");
            echo ("<td>".$row["inicio"]."</td>");
            echo ("<td>".$row["termino"]."</td>");
            echo ("<td>".$valor1."</td>");
            echo ("<td>".$row["tipo"]."</td>");
            echo ("<td>".$row["id_cliente"]."</td>");
            echo ("<td>".$row["cliente"]."</td>");
            echo ("<td>".$row["obs"]."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_locacoes_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select id_quadra, date_format(data_locacao,'%Y-%m-%d') as d1, hora1, hora2, ";
        $sql .= "valor_total, pago, cliente, obs ";
        $sql .= "from tbl_locacoes ";
        $sql .= "where id_loc = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_quadra').value='".$row["id_quadra"]."';");
            echo("document.getElementById('input_data_loc').value='".$row["d1"]."';");    
            echo("document.getElementById('input_ini').value='".$row["hora1"]."';");
            echo("document.getElementById('input_fim').value='".$row["hora2"]."';");
            echo("document.getElementById('input_total').value='".$row["valor_total"]."';");
            echo("document.getElementById('input_pago').value='".$row["pago"]."';");
            echo("document.getElementById('input_cli').value='".$row["cliente"]."';");
            echo("document.getElementById('input_obs').value='".$row["obs"]."';");
        }
        mysqli_free_result($query); 

        echo ("document.getElementById('input_quadra').focus();");
        echo ("</script>");

    }

    function select_quadras(){

        $sql = "select id_quadra, nome ";
        $sql .= "from tbl_quadras order by nome";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo ("<option value='".$row["id_quadra"]."'>".$row["nome"]."</option>");
        }
        mysqli_free_result($query); 

    }

    function select_clientes(){

        $sql = "select id_cli, nome ";
        $sql .= "from tbl_clientes order by nome";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo ("<option value='".$row["id_cli"]."'>".$row["nome"]."</option>");
        }
        mysqli_free_result($query); 

    }

    function usuarios_corpo(){

        $sql = "select id_user, nome, usuario, nivel ";
        $sql .= "from tbl_usuarios ";
        $sql .= "where nivel>0 ";
        $sql .= "order by nome";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' ";
            $bt1 .= "href='/cad_usuarios_ficha.php?v1=".$row["id_user"]."'><i class='fa fa-edit' aria-hidden='true'
            data-toggle='tooltip' title='Alterar'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' onclick='Excluir(".$row["id_user"].")'>
            <i class='fa fa-trash-o' aria-hidden='true' data-toggle='tooltip' title='Excluir'></i></a>&nbsp;&nbsp;";

            echo( "<tr>");
            echo ("<td>".$bt1.$bt2.$row["nome"]."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo ("<td>".$row["nivel"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_usuarios_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");

        $sql = "select nome,usuario,nivel,senha ";
        $sql .= "from tbl_usuarios  ";
        $sql .= "where id_user = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_nome').value='".$row["nome"]."';");
            echo("document.getElementById('input_user').value='".$row["usuario"]."';");
            echo("document.getElementById('select_nivel').value='".$row["nivel"]."';");
            echo("document.getElementById('input_pwd').value='".$row["senha"]."';");
        }
        mysqli_free_result($query); 

        echo ("document.getElementById('input_nome').focus();");
        echo ("</script>");

    }

    function cad_quadras_corpo(){

        $sql = "select id_quadra, nome, descricao, valor_hora_avulsa, valor_hora_mensal ";
        $sql .= "from tbl_quadras ";
        $sql .= "order by nome";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Editar' ";
            $bt1 .= "href='/cad_quadras_ficha.php?v1=".$row["id_quadra"]."'>
            <i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' title='Excluir' 
            onclick='Excluir(".$row["id_quadra"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            $valor1 = number_format($row["valor_hora_avulsa"],2,",",".");
            $valor2 = number_format($row["valor_hora_mensal"],2,",",".");

            echo( "<tr>");
            echo ("<td>".$bt1.$bt2.$row["nome"]."</td>");
            echo ("<td>".$row["descricao"]."</td>");
            echo ("<td>".$valor1."</td>");
            echo ("<td>".$valor2."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_quadras_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");

        //obtem url do storage para armazenamento de imagens
        //o nome das imagens (salvas no storage) devem ser iguais aos respectivos id_quadra. Ex: 1.jpg, 2.jpg
        $url_base = "";
        $sql = "select url_storage ";
        $sql .= "from tbl_config ";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $url_base = $row["url_storage"];
        }
        mysqli_free_result($query); 
 
        $sql = "select id_quadra, nome, descricao, valor_hora_avulsa, valor_hora_mensal ";
        $sql .= "from tbl_quadras ";
        $sql .= "where id_quadra = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_nome').value='".$row["nome"]."';");
            echo("document.getElementById('input_id').value='".$row["id_quadra"]."';");

            $texto = str_replace("\n"," - ",$row["descricao"]);
            $texto1 = str_replace("\r","",$texto);
            echo("document.getElementById('input_desc').value='".$texto1."';");

            echo("document.getElementById('input_valor1').value='".$row["valor_hora_avulsa"]."';");
            echo("document.getElementById('input_valor2').value='".$row["valor_hora_mensal"]."';");

            $url_automatic = $url_base."/".$row["id_quadra"].".jpg";
            echo("document.getElementById('input_URL').value='".$url_automatic."';");
            
        }
        mysqli_free_result($query); 

        echo ("var url_Foto = document.getElementById('input_URL').value;");
        echo ("document.getElementById('results').innerHTML = '<img src=\"' + url_Foto + '\"/>';");

        echo ("document.getElementById('input_nome').focus();");
        echo ("</script>");

    }

    function cad_produtos_rel1(){

        $sql = "select categoria, nome, estoque ";
        $sql .= "from tbl_produtos ";
        $sql .= "order by categoria,nome";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo( "<tr>");
            echo ("<td>".$row["categoria"]."</td>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$row["estoque"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_produtos_rel2(){

        $sql = "select categoria, nome, preco ";
        $sql .= "from tbl_produtos ";
        $sql .= "order by categoria,nome";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            
            $valor1 = number_format($row["preco"],2,",",".");

            echo( "<tr>");
            echo ("<td>".$row["categoria"]."</td>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$valor1."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_produtos_rel3(){

        $sql = "select categoria, nome, minimo, estoque ";
        $sql .= "from tbl_produtos ";
        $sql .= "where estoque < minimo ";
        $sql .= "order by categoria,nome";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            
            $reposicao = $row["minimo"] - $row["estoque"];

            echo( "<tr>");
            echo ("<td>".$row["categoria"]."</td>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$row["minimo"]."</td>");
            echo ("<td>".$row["estoque"]."</td>");
            echo ("<td>".$reposicao."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function select_produtos(){

        $sql = "select id_produto, nome ";
        $sql .= "from tbl_produtos order by categoria,nome ";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo ("<option value='".$row["id_produto"]."'>".$row["nome"]."</option>");
        }
        mysqli_free_result($query); 

    }

    function select_fornecedores(){

        $sql = "select id_fornec, nome ";
        $sql .= "from tbl_fornec order by nome ";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo ("<option value='".$row["id_fornec"]."'>".$row["nome"]."</option>");
        }
        mysqli_free_result($query); 

    }

    function cad_fornecedores_corpo(){

        $sql = "select id_fornec, nome, tipo_prod,contatos  ";
        $sql .= "from tbl_fornec ";
        $sql .= "order by nome";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Editar' ";
            $bt1 .= "href='/cad_fornecedores_ficha.php?v1=".$row["id_fornec"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' ";
            $bt2 .= "title='Excluir' onclick='Excluir(".$row["id_fornec"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            echo( "<tr>");
            echo ("<td>".$bt1.$bt2.$row["nome"]."</td>");
            echo ("<td>".$row["tipo_prod"]."</td>");
            echo ("<td>".$row["contatos"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_fornecedores_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select nome, tipo_prod ,contatos ";
        $sql .= "from tbl_fornec ";
        $sql .= "where id_fornec = $id_aux ";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_nome').value='".$row["nome"]."';");
            echo("document.getElementById('input_categoria').value='".$row["tipo_prod"]."';");
            echo("document.getElementById('input_tel').value='".$row["contatos"]."';");
        }
        mysqli_free_result($query); 

        echo ("document.getElementById('input_nome').focus();");
        echo ("</script>");

    }

    function vendas_corpo($param,$param1,$param2){

        echo ("<script type='text/javascript'>");

        switch ($param) {
            case '01':
                //Ultimas Vendas
                echo ("document.getElementById('lbl_filtro').innerHTML='Mais Recentes';");

                $sql = "select t1.id_venda, date_format(t1.data_venda,'%d/%m/%y %T') as d1, t1.desconto, ";
                $sql .= "t2.nome, t1.total , t1.forma_pag, t1.parcelas, t1.carne,";
                $sql .= "t3.nome as usuario ";
                $sql .= "from tbl_vendas t1 ";
                $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
                $sql .= "inner join tbl_usuarios t3 on (t1.id_user = t3.id_user) ";
                $sql .= "order by t1.data_venda desc limit 10";
                break;

            case '02':
                //Histórico - Todas as Vendas
                echo ("document.getElementById('lbl_filtro').innerHTML='Histórico';");

                $sql = "select t1.id_venda, date_format(t1.data_venda,'%d/%m/%y') as d1, t1.desconto, ";
                $sql .= "t2.nome, t1.total , t1.forma_pag, t1.parcelas, t1.carne, ";
                $sql .= "t3.nome as usuario ";
                $sql .= "from tbl_vendas t1 ";
                $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
                $sql .= "inner join tbl_usuarios t3 on (t1.id_user = t3.id_user) ";
                $sql .= "order by t1.data_venda desc";
                break;

            case '03':
                //listagem de vendas do Cliente
                echo ("document.getElementById('lbl_filtro').innerHTML='$param2';");

                $sql = "select t1.id_venda, date_format(t1.data_venda,'%d/%m/%y') as d1, t1.desconto, ";
                $sql .= "t2.nome, t1.total , t1.forma_pag, t1.parcelas, t1.carne, ";
                $sql .= "t3.nome as usuario ";
                $sql .= "from tbl_vendas t1 ";
                $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
                $sql .= "inner join tbl_usuarios t3 on (t1.id_user = t3.id_user) ";
                $sql .= "where t1.matricula = $param1 ";
                $sql .= "order by t1.data_venda desc";
                break;
            default:
                break;
        }

        echo ("</script>");

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Detalhes' ";
            $bt1 .= "href='/vendas_ficha.php?v1=".$row["id_venda"]."'><i class='fa fa-search' aria-hidden='true'></i></a>";

            $bt2 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' title='Excluir' onclick='Excluir(".$row["id_venda"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            if($row["carne"] > 0 ) {
                $bt3 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Imprimir Carnê' ";
                $bt3 .= "href='/carne.php?v1=".$row["id_venda"]."'><i class='fa fa-print' aria-hidden='true'></i></a>";
            } else {
                $bt3 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Imprimir Comprovante' ";
                $bt3 .= "href='/carne.php?v1=".$row["id_venda"]."'><i class='fa fa-print' aria-hidden='true'></i></a>";
            }

            $total = number_format($row["total"],2,",",".");
            $desc = number_format($row["desconto"],2,",",".");

            echo( "<tr>");
            echo ("<td>".$bt1.$bt3.$bt2.$row["d1"]."</td>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$total."</td>");
            echo ("<td>".$row["forma_pag"]."</td>");
            echo ("<td>".$row["parcelas"]."</td>");
            echo ("<td>".$desc."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function vendas_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select t1.matricula, t2.nome, t1.total, t1.forma_pag ";
        $sql .= "from tbl_vendas t1 ";
        $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
        $sql .= "where t1.id_venda = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_matricula').value='".$row["matricula"]."';");
            echo("document.getElementById('input_cliente').value='".$row["nome"]."';");
            echo("document.getElementById('input_total').value='".$row["total"]."';");
            echo("document.getElementById('input_pag').value='".$row["forma_pag"]."';");
        }
        mysqli_free_result($query); 

        echo ("</script>");

    }

    function vendas_itens_corpo($id_aux){

        $sql = "select t2.nome , t1.quant, t1.valor_unit, t1.total ";
        $sql .= "from tbl_vendas_itens t1 ";
        $sql .= "inner join tbl_produtos t2 on (t1.id_produto = t2.id_produto) ";
        $sql .= "where id_venda = $id_aux";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $unitario = number_format($row["valor_unit"],2,",",".");
            $total = number_format($row["total"],2,",",".");

            echo( "<tr>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$row["quant"]."</td>");
            echo ("<td>".$unitario."</td>");
            echo ("<td>".$total."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function limpa_itens_emAberto(){

        session_start();
        $idAux = $_SESSION["SECuserID"]; 

        $sql = "delete from tbl_vendas_itens ";
        $sql .= "where id_user = $idAux ";
        $sql .= "and id_venda = 0";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);
        
    }

    function carnes_corpo($param,$param1,$param2){

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('lbl_filtro').innerHTML='- (".$param1.")';");
        echo ("</script>");

        if($param2 == "todos"){
            $sql = "select id_movimento, parcela, date_format(vencimento,'%d/%m/%y') as d1, ";
            $sql .= "date_format(pagamento,'%d/%m/%y') as d2, valor, valor_pago, realizado, forma_pag, bandeira ";
            $sql .= "from tbl_mov_financ ";
            $sql .= "where matricula = $param and iscarne = 1 ";
            $sql .= "order by parcela,pagamento desc";
        } else {
            $sql = "select id_movimento, parcela, date_format(vencimento,'%d/%m/%y') as d1, ";
            $sql .= "date_format(pagamento,'%d/%m/%y') as d2, valor, valor_pago, realizado, forma_pag, bandeira ";
            $sql .= "from tbl_mov_financ ";
            $sql .= "where matricula = $param and iscarne = 1 ";
            //$sql .= "and pagamento is null ";
            $sql .= "order by parcela,pagamento ";
        }

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            if ($row["realizado"] == 0){
                $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Registrar Recebimento' ";
                $bt1 .= "href='/recebimentos_ficha.php?v1=".$row["id_movimento"]."'><i class='fa fa-2x fa-check-square' aria-hidden='true'></i></a>";    
            } else {
                $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-gray' >";
                $bt1 .= "<i class='fa fa-2x fa-check-square' aria-hidden='true'></i></a>";    
            }
            
            $bt2 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Editar' ";
            $bt2 .= "href='/recebimentos_ficha1.php?v1=".$row["id_movimento"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt3 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' title='Excluir' onclick='Excluir(".$row["id_movimento"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            $valor1 = number_format($row["valor"],2,",",".");
            $valor2 = number_format($row["valor_pago"],2,",",".");

            echo( "<tr>");
            echo ("<td>".$bt1.$bt2.$bt3.$row["parcela"]."</td>");
            echo ("<td>".$row["d1"]."</td>");
            echo ("<td>".$valor1."</td>");
            echo ("<td>".$row["d2"]."</td>");
            echo ("<td>".$valor2."</td>");
            echo ("<td>".$row["forma_pag"]."</td>");
            echo ("<td>".$row["bandeira"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function carnes_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select t2.nome, t1.matricula, t1.parcela, t1.valor, t1.vencimento, t1.id_venda, t1.id_user, t1.parcela ";
        $sql .= "from tbl_mov_financ t1 ";
        $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
        $sql .= "where t1.id_movimento = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            
            echo("document.getElementById('input_nome').value='".$row["nome"]."';");
            echo("document.getElementById('input_mat').value='".$row["matricula"]."';");
            echo("document.getElementById('input_parcela').value='".$row["parcela"]."';");
            echo("document.getElementById('input_valor').value='".$row["valor"]."';");
            echo("document.getElementById('input_venc').value='".$row["vencimento"]."';");

            echo("document.getElementById('IDhidden1').value='".$row["id_venda"]."';");
            echo("document.getElementById('IDhidden2').value='".$row["id_user"]."';");
            echo("document.getElementById('parcelahidden').value='".$row["parcela"]."';");
            
        }
        mysqli_free_result($query); 

        echo ("document.getElementById('input_dinheiro').focus();");
        echo ("</script>");

    }

    function carnes_ficha1($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select t2.nome, t1.matricula, t1.parcela, t1.valor, t1.vencimento, t1.id_venda, t1.id_user, t1.parcela, ";
        $sql .= "t1.valor_pago, t1.forma_pag, t1.bandeira, t1.pagamento ";
        $sql .= "from tbl_mov_financ t1 ";
        $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
        $sql .= "where t1.id_movimento = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            echo("document.getElementById('input_nome').value='".$row["nome"]."';");
            echo("document.getElementById('input_mat').value='".$row["matricula"]."';");
            echo("document.getElementById('input_parcela').value='".$row["parcela"]."';");
            echo("document.getElementById('input_valor').value='".$row["valor"]."';");
            echo("document.getElementById('input_venc').value='".$row["vencimento"]."';");
            echo("document.getElementById('input_pagam').value='".$row["pagamento"]."';");

            if($row["valor_pago"] > 0) {
                switch ($row["forma_pag"]) {
                    case 'Dinheiro':
                        echo("document.getElementById('input_dinheiro').value='".$row["valor_pago"]."';");
                        break;
                    case 'Depósito':
                        echo("document.getElementById('input_deposito').value='".$row["valor_pago"]."';");
                        break;
                    case 'Cartão':  
                        echo("document.getElementById('input_debito').value='".$row["valor_pago"]."';");
                        echo("document.getElementById('input_debito_bandeira').value='".$row["bandeira"]."';");
                        break;
                }
            } 

            echo("document.getElementById('IDhidden2').value='".$row["id_user"]."';");
            
        }
        mysqli_free_result($query); 

        echo ("document.getElementById('input_valor').focus();");
        echo ("</script>");

    }

    function carne_impressao($id_aux){

        //numero do carnê
        $sql = "select id_carne ";
        $sql .= "from tbl_vendas_carne ";
        $sql .= "where id_venda = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $carne = $row["id_carne"];
        }
        mysqli_free_result($query); 

        //dados da venda
        $sql = "select t1.matricula, date_format(t1.vencimento,'%d/%m/%y') as d1, t1.parcela, t1.valor, t1.valor_pago , t1.forma_pag, t1.pagamento, ";
        $sql .= "t2.nome, t2.manequim, t2.calcado ";
        $sql .= "from tbl_mov_financ t1 ";
        $sql .= "inner join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
        $sql .= "where t1.id_venda = $id_aux ";
        $sql .= "order by t1.vencimento";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  

        
        while($row = $query->fetch_assoc()) {
            $matricula = $row["matricula"];
            $vencimento = $row["d1"];
            $pagamento = $row["pagamento"];
            $parcela = $row["parcela"];
            $valor = number_format($row["valor"],2,",",".");

            if($row["valor_pago"] > 0){
                $valor_pago = number_format($row["valor_pago"],2,",",".");
            } else {
                $valor_pago = "";
            }
            
            $forma_pag = $row["forma_pag"];
            $nome = $row["nome"];
            $manequim = $row["manequim"];
            $calcado = $row["calcado"];

            $space1 = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $space1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $space1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $space1 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

            $space2 = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
            $space2 .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

            echo("<br>");

            echo("<div class='w3-row'>");
                echo("<div class='w3-col w3-border' style='width:45%' >");
                    echo("$space1<strong>Vencimento</strong>");
                    echo("<br>");
                    echo("$space1 $vencimento");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Carnê:</strong> $carne / &nbsp;&nbsp;&nbsp;<strong>Parcela:</strong> $parcela");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Nome:</strong> $nome");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Fantasia:</strong> $manequim &nbsp;&nbsp;&nbsp;&nbsp; <strong>Calçado:</strong> $calcado");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Cad:</strong> $matricula &nbsp;&nbsp;&nbsp;&nbsp; <strong>Valor:</strong> $valor");
                    echo("<br>");echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Valor Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pagamento:</strong>");
                    echo("<br>");
                    echo("&nbsp;&nbsp;&nbsp;&nbsp;$valor_pago &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $forma_pag");
                    echo("<br>");
                    echo("&nbsp;&nbsp;&nbsp;&nbsp;Data do Pagamento: $pagamento");
                    echo("<br>");
                    echo("<small>&nbsp;&nbsp;&nbsp;Após vencim. multa de 2% e juros de R$0,10/dia</small>");
                    echo("<br>");
                echo("</div>");

                echo("<div class='w3-col' style='width:5%' >");
                    echo("&nbsp;");
                echo("</div>");

                echo("<div class='w3-col w3-border' style='width:45%' >");
                    echo("$space1<strong>Vencimento</strong>");
                    echo("<br>");
                    echo("$space1 $vencimento");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Carnê:</strong> $carne / &nbsp;&nbsp;&nbsp;<strong>Parcela:</strong> $parcela");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Nome:</strong> $nome");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Fantasia:</strong> $manequim &nbsp;&nbsp;&nbsp;&nbsp; <strong>Calçado:</strong> $calcado");
                    echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Cad:</strong> $matricula &nbsp;&nbsp;&nbsp;&nbsp; <strong>Valor:</strong> $valor");
                    echo("<br>");echo("<br>");
                    echo("<strong>&nbsp;&nbsp;&nbsp;&nbsp;Valor Total:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pagamento:</strong>");
                    echo("<br>");
                    echo("&nbsp;&nbsp;&nbsp;&nbsp;$valor_pago &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $forma_pag");
                    echo("<br>");
                    echo("&nbsp;&nbsp;&nbsp;&nbsp;Data do Pagamento: $pagamento");
                    echo("<br>");
                    echo("<small>&nbsp;&nbsp;&nbsp;Após vencim. multa de 2% e juros de R$0,10/dia</small>");
                    echo("<br>");
                echo("</div>");
            echo("</div>");

            echo("<br>");

        }
        mysqli_free_result($query); 

    }

    function reposicoes_corpo(){

        $sql = "select id_nota, date_format(emissao,'%d/%m/%y') as d1, ";
        $sql .= "numero, t2.nome, valor , obs, t3.nome as usuario ";
        $sql .= "from tbl_notas t1 ";
        $sql .= "inner join tbl_fornec t2 on (t1.id_fornec = t2.id_fornec) ";
        $sql .= "inner join tbl_usuarios t3 on (t1.id_user = t3.id_user) ";
        $sql .= "order by emissao desc";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $valor = number_format($row["valor"],2,",",".");

            $bt1 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' ";
            $bt1 .= "title='Excluir' onclick='Excluir(".$row["id_nota"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            $bt2 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Detalhes' ";
            $bt2 .= "href='/reposicoes_ficha.php?v1=".$row["id_nota"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            echo( "<tr>");
            echo ("<td>".$bt2.$bt1.$row["d1"]."</td>");
            echo ("<td>".$row["numero"]."</td>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$valor."</td>");
            echo ("<td>".$row["obs"]."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function reposicoes_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select t2.nome, date_format(t1.emissao,'%Y-%m-%d') as d1, t1.numero, t1.valor, t1.obs ";
        $sql .= "from tbl_notas t1 ";
        $sql .= "inner join tbl_fornec t2 on (t1.id_fornec = t2.id_fornec) ";
        $sql .= "where t1.id_nota = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $valor = number_format($row["valor"],2,",",".");

            echo("document.getElementById('input_fornec').value='".$row["nome"]."';");
            echo("document.getElementById('input_data').value='".$row["d1"]."';");
            echo("document.getElementById('input_nf').value='".$row["numero"]."';");
            echo("document.getElementById('input_valor').value='".$valor."';");
            echo("document.getElementById('input_obs').value='".$row["obs"]."';");
        }
        mysqli_free_result($query); 

        echo ("</script>");

    }

    function reposicoes_itens_corpo($id_aux){

        $sql = "select t2.nome, t1.valor, t1.quant , t1.total ";
        $sql .= "from tbl_notas_itens t1 ";
        $sql .= "inner join tbl_produtos t2 on (t1.id_produto = t2.id_produto) ";
        $sql .= "where t1.id_nota = $id_aux ";
        $sql .= "order by t2.nome";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $valor = number_format($row["valor"],2,",",".");
            $total = number_format($row["total"],2,",",".");

            echo( "<tr>");
            echo ("<td>".$row["nome"]."</td>");
            echo ("<td>".$valor."</td>");
            echo ("<td>".$row["quant"]."</td>");
            echo ("<td>".$total."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_despesas_corpo($param1,$param2){

        $sql = "select id_movimento, date_format(vencimento,'%d/%m/%y') as d1, date_format(pagamento,'%d/%m/%y') as d2, ";
        $sql .= "t1.obs, t2.nome, valor, valor_pago , forma_pag, ";
        $sql .= "t3.nome as usuario ";
        $sql .= "from tbl_mov_financ  t1 ";
        $sql .= "inner join tbl_fornec t2 on (t1.id_fornec = t2.id_fornec) ";
        $sql .= "inner join tbl_usuarios t3 on (t1.id_user = t3.id_user) ";
        $sql .= "where tipo = 'D' ";
        $sql .= "and ( vencimento >= DATE('$param1') and vencimento <= DATE('$param2') ) ";
        $sql .= "order by vencimento desc";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $valor1 = number_format($row["valor"],2,",",".");
            $valor2 = number_format($row["valor_pago"],2,",",".");

            $bt1 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' ";
            $bt1 .= "title='Excluir' onclick='Excluir(".$row["id_movimento"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            $bt2 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Alterar' ";
            $bt2 .= "href='/cad_despesas_ficha.php?v1=".$row["id_movimento"]."'><i class='fa fa-edit' aria-hidden='true'></i></a>";

            $bt3 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Baixar' ";
            $bt3 .= "href='/cad_despesas_baixa.php?v1=".$row["id_movimento"]."'><i class='fa fa-2x fa-check-square' aria-hidden='true'></i></a>";

            echo( "<tr>");
            echo ("<td>".$bt3.$bt2.$bt1.$row["nome"]."</td>");
            echo ("<td>".$row["d1"]."</td>");
            echo ("<td>".$valor1."</td>");
            echo ("<td>".$row["d2"]."</td>");           
            echo ("<td>".$valor2."</td>");
            echo ("<td>".$row["forma_pag"]."</td>");
            echo ("<td>".$row["obs"]."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function cad_despesas_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");
 
        $sql = "select id_fornec, date_format(vencimento,'%Y-%m-%d') as d1, valor, forma_pag, obs ";
        $sql .= "from tbl_mov_financ ";
        $sql .= "where id_movimento = $id_aux ";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            echo("document.getElementById('input_fornec').value='".$row["id_fornec"]."';");
            echo("document.getElementById('input_vencim').value='".$row["d1"]."';");
            echo("document.getElementById('input_valor').value='".$row["valor"]."';");
            echo("document.getElementById('input_forma').value='".$row["forma_pag"]."';");
            echo("document.getElementById('input_desc').value='".$row["obs"]."';");
        }
        mysqli_free_result($query); 

        echo ("</script>");

    }

    function caixa_corpo($param1,$param2){

        $sql = "select date_format(pagamento,'%d/%m/%y') as d1, forma_pag ,valor_pago,tipo, obs, bandeira, id_venda, ";
        $sql .= "t2.nome as cliente, t2.matricula, ";
        $sql .= "t3.nome as fornecedor ";
        $sql .= "from tbl_mov_financ t1 ";
        $sql .= "left join tbl_clientes t2 on (t1.matricula = t2.matricula) ";
        $sql .= "left join tbl_fornec t3 on (t1.id_fornec = t3.id_fornec) ";
        $sql .= "where realizado = 1 ";
        $sql .= "and ( pagamento >= DATE('$param1') and pagamento <= DATE('$param2') ) ";
        $sql .= "order by pagamento desc";

        $total1 =0; //receita - dinheiro
        $total2 =0; //receita - Cartão
        $total3 =0; //receita - crédito

        $total4 =0; //despesas - dinheiro
        $total5 =0; //despesas - Cheque
        $total6 =0; //despesas - Cartão

        //separação em bandeiras. até 10 diferentes
        $bandeira1="";$bandeira2="";$bandeira3="";$bandeira4="";$bandeira5="";$bandeira6="";$bandeira7="";$bandeira8="";$bandeira9="";$bandeira10="";
        $totalband1=0;$totalband2=0;$totalband3=0;$totalband4=0;$totalband5=0;$totalband6=0;$totalband7=0;$totalband8=0;$totalband9=0;$totalband10=0;$totalband_outros=0;
        $resumobandeiras="R$ 0,00";

        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            $valor = number_format($row["valor_pago"],2,",",".");

            if($row["tipo"] == "D") {

                $col1 = "";
                $col2 = $row["fornecedor"];

                switch ($row["forma_pag"]) {
                    case 'Dinheiro':
                        $total4 = $total4 + $row["valor_pago"];
                        break;
                    case 'Cheque':
                        $total5 = $total5 + $row["valor_pago"];
                        break;
                    case 'Cartão':
                        $total6 = $total6 + $row["valor_pago"];
                        break;
                    default:
                        break;
                }

            } else {

                $col1 = $row["cliente"];
                $col2 = "";

                switch ($row["forma_pag"]) {
                    case 'Dinheiro':
                        $total1 = $total1 + $row["valor_pago"];
                        break;
                    case 'Cartão':
            
                        //separação em bandeiras. até 5 diferentes
                        $bandaux = $row["bandeira"];
                        $totalaux = $row["valor_pago"];
                        
                        if ($bandeira1 == ""){ 
                            $bandeira1= $bandaux;
                            $totalband1=$totalaux;
                        } else {
                            if ($bandaux == $bandeira1) {
                                $totalband1 = $totalband1 + $totalaux;
                            } else {
                                if ($bandeira2 == ""){ 
                                    $bandeira2= $bandaux;
                                    $totalband2=$totalaux;
                                } else {
                                    if ($bandaux == $bandeira2) {
                                        $totalband2 = $totalband2 + $totalaux;
                                    } else {
                                        if ($bandeira3 == ""){ 
                                            $bandeira3= $bandaux;
                                            $totalband3=$totalaux;
                                        } else {
                                            if ($bandaux == $bandeira3) {
                                                $totalband3 = $totalband3 + $totalaux;
                                            } else {
                                                if ($bandeira4 == ""){ 
                                                    $bandeira4= $bandaux;
                                                    $totalband4=$totalaux;
                                                } else {
                                                    if ($bandaux == $bandeira4) {
                                                        $totalband4 = $totalband4 + $totalaux;
                                                    } else {
                                                        if ($bandeira5 == ""){ 
                                                            $bandeira5= $bandaux;
                                                            $totalband5=$totalaux;
                                                        } else {
                                                            if ($bandaux == $bandeira5) {
                                                                $totalband5 = $totalband5 + $totalaux;
                                                            } else {
                                                                if ($bandeira6 == ""){ 
                                                                    $bandeira6= $bandaux;
                                                                    $totalband6=$totalaux;
                                                                } else {
                                                                    if ($bandaux == $bandeira6) {
                                                                        $totalband6 = $totalband6 + $totalaux;
                                                                    } else {
                                                                        if ($bandeira7 == ""){ 
                                                                            $bandeira7= $bandaux;
                                                                            $totalband7=$totalaux;
                                                                        } else {
                                                                            if ($bandaux == $bandeira7) {
                                                                                $totalband7 = $totalband7 + $totalaux;
                                                                            } else {
                                                                                if ($bandeira8 == ""){ 
                                                                                    $bandeira8= $bandaux;
                                                                                    $totalband8=$totalaux;
                                                                                } else {
                                                                                    if ($bandaux == $bandeira8) {
                                                                                        $totalband8 = $totalband8 + $totalaux;
                                                                                    } else {
                                                                                        if ($bandeira9 == ""){ 
                                                                                            $bandeira9= $bandaux;
                                                                                            $totalband9=$totalaux;
                                                                                        } else {
                                                                                            if ($bandaux == $bandeira9) {
                                                                                                $totalband9 = $totalband9 + $totalaux;
                                                                                            } else {
                                                                                                if ($bandeira10 == ""){ 
                                                                                                    $bandeira10= $bandaux;
                                                                                                    $totalband10=$totalaux;
                                                                                                } else {
                                                                                                    if ($bandaux == $bandeira10) {
                                                                                                        $totalband10 = $totalband10 + $totalaux;
                                                                                                    } else {
                                                                                                        $totalband_outros = $totalband_outros + $totalaux;
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                        break;
                    default:
                        $total3 = $total3 + $row["valor_pago"]; 
                        break;
                }

            }
            
            echo( "<tr>");
            echo ("<td>".$row["d1"]."</td>");
            echo ("<td>".$row["matricula"]."</td>");
            echo ("<td>".$col1."</td>");
            echo ("<td>".$col2."</td>");
            echo ("<td>".$row["obs"]."</td>");
            echo ("<td>".$row["forma_pag"]."</td>");
            echo ("<td>".$row["bandeira"]."</td>");
            echo ("<td>".$row["id_venda"]."</td>");
            echo ("<td>".$valor."</td>");
            echo ("<td>".$row["tipo"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
        
        $data_ini = date_format(date_create($param1),"d/m/Y");
        $data_fim = date_format(date_create($param2),"d/m/Y");

        $valor1 = number_format($total1,2,",",".");
        $valor3 = number_format($total3,2,",",".");

        $valor4 = number_format($total4,2,",",".");
        $valor5 = number_format($total5,2,",",".");
        $valor6 = number_format($total6,2,",",".");

        //resumo de bandeiras
        if ($totalband1 !=0 ) { $resumobandeiras = "[".$bandeira1."] = R$ ".number_format($totalband1,2,",",".");}
        if ($totalband2 !=0 ) { $resumobandeiras .= " [".$bandeira2."] = R$ ".number_format($totalband2,2,",",".");}
        if ($totalband3 !=0 ) { $resumobandeiras .= " [".$bandeira3."] = R$ ".number_format($totalband3,2,",",".");}
        if ($totalband4 !=0 ) { $resumobandeiras .= " [".$bandeira4."] = R$ ".number_format($totalband4,2,",",".");}
        if ($totalband5 !=0 ) { $resumobandeiras .= " [".$bandeira5."] = R$ ".number_format($totalband5,2,",",".");}
        if ($totalband6 !=0 ) { $resumobandeiras .= " [".$bandeira6."] = R$ ".number_format($totalband6,2,",",".");}
        if ($totalband7 !=0 ) { $resumobandeiras .= " [".$bandeira7."] = R$ ".number_format($totalband7,2,",",".");}
        if ($totalband8 !=0 ) { $resumobandeiras .= " [".$bandeira8."] = R$ ".number_format($totalband8,2,",",".");}
        if ($totalband9 !=0 ) { $resumobandeiras .= " [".$bandeira9."] = R$ ".number_format($totalband9,2,",",".");}
        if ($totalband10 !=0 ) { $resumobandeiras .= " [".$bandeira10."] = R$ ".number_format($totalband10,2,",",".");}
        if ($totalband_outros !=0 ) { $resumobandeiras .= " [Outras Bandeiras] = R$ ".number_format($totalband_outros,2,",",".");}

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('lbl_periodo').innerHTML='Período : $data_ini a $data_fim';");
        echo ("document.getElementById('lbl_total1').innerHTML='R$ $valor1';");
        echo ("document.getElementById('lbl_total2').innerHTML='$resumobandeiras';");
        echo ("document.getElementById('lbl_total3').innerHTML='R$ $valor3';");
        echo ("document.getElementById('lbl_total4').innerHTML='R$ $valor4';");
        echo ("document.getElementById('lbl_total5').innerHTML='R$ $valor5';");
        echo ("document.getElementById('lbl_total6').innerHTML='R$ $valor6';");
        echo ("</script>");
    }

    function entregas_corpo($param,$param1){

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('lbl_filtro').innerHTML='- (".$param1.")';");
        echo ("</script>");

        $sql = "select t1.id_item, t2.nome as produto, quant, date_format(entregue_data,'%d/%m/%y') as d1, entregue ";
        $sql .= "from tbl_vendas_itens t1 ";
        $sql .= "inner join tbl_produtos t2 on (t1.id_produto = t2.id_produto) ";
        $sql .= "inner join tbl_vendas t3 on (t1.id_venda = t3.id_venda) ";
        $sql .= "where t3.matricula = $param and t2.acompanha_entrega = 1 ";
        $sql .= "order by id_item desc";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {

            if ($row["entregue"] ==  0){
                $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-green' data-toggle='tooltip' title='Registrar Entrega' ";
                $bt1 .= "href='/entregas_ficha.php?v1=".$row["id_item"]."'><i class='fa fa-2x fa-check-square' aria-hidden='true'></i></a>";        
            } else{
                $bt1 = "<a class='w3-btn w3-round w3-hover-blue w3-text-gray' data-toggle='tooltip' title='Dados da Entrega' ";
                $bt1 .= "href='/entregas_ficha1.php?v1=".$row["id_item"]."'><i class='fa fa-2x fa-info-circle' aria-hidden='true'></i></a>";        
            }

            echo( "<tr>");
            echo ("<td>".$bt1.$row["produto"]."</td>");
            echo ("<td>".$row["quant"]."</td>");
            echo ("<td>".$row["d1"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

    function entregas_ficha($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");

        //matricula do cliente , produto e quantidade
        $matricula = 0;
        $id_produto = 0;
        $quantidade = 0;
        $sql = "select t2.matricula, t1.id_produto, t1.quant ";
        $sql .= "from tbl_vendas_itens t1 ";
        $sql .= "inner join tbl_vendas t2 on (t1.id_venda = t2.id_venda) ";
        $sql .= "where t1.id_item  = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $matricula = $row["matricula"];
            $id_produto = $row["id_produto"];
            $quantidade = $row["quant"];
        }
        mysqli_free_result($query); 

        //nome do cliente
        $cliente="";
        $sql = "select nome ";
        $sql .= "from tbl_clientes ";
        $sql .= "where matricula = $matricula";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $cliente = $row["nome"];
        }
        mysqli_free_result($query); 

        //nome do produto
        $produto="";
        $sql = "select nome  ";
        $sql .= "from tbl_produtos ";
        $sql .= "where id_produto = $id_produto";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $produto = $row["nome"];
        }
        mysqli_free_result($query); 

        echo("document.getElementById('input_nome').value='".$cliente."';");
        echo("document.getElementById('input_mat').value='".$matricula."';");
        echo("document.getElementById('input_produto').value='".$produto."';");
        echo("document.getElementById('input_quant').value='".$quantidade."';");

        echo ("</script>");

    }

    function entregas_ficha1($id_aux){

        require_once('model/dbconnection.php');

        echo ("<script type='text/javascript'>");
        echo ("document.getElementById('IDhidden').value='".$id_aux."';");

        //matricula do cliente , produto e quantidade
        $matricula = 0;
        $id_produto = 0;
        $quantidade = 0;
        $id_user = 0;
        $data_entrega = "";
        $sql = "select t2.matricula, t1.id_produto, t1.quant, t1.id_user, date_format(entregue_data,'%d/%m/%y') as d1 ";
        $sql .= "from tbl_vendas_itens t1 ";
        $sql .= "inner join tbl_vendas t2 on (t1.id_venda = t2.id_venda) ";
        $sql .= "where t1.id_item  = $id_aux";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $matricula = $row["matricula"];
            $id_produto = $row["id_produto"];
            $quantidade = $row["quant"];
            $id_user = $row["id_user"];
            $data_entrega = $row["d1"];
        }
        mysqli_free_result($query); 

        //nome do cliente
        $cliente="";
        $sql = "select nome ";
        $sql .= "from tbl_clientes ";
        $sql .= "where matricula = $matricula";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $cliente = $row["nome"];
        }
        mysqli_free_result($query); 

        //nome do usuario
        $usuario="";
        $sql = "select nome ";
        $sql .= "from tbl_usuarios ";
        $sql .= "where id_user = $id_user";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $usuario = $row["nome"];
        }
        mysqli_free_result($query); 

        //nome do produto
        $produto="";
        $sql = "select nome  ";
        $sql .= "from tbl_produtos ";
        $sql .= "where id_produto = $id_produto";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            $produto = $row["nome"];
        }
        mysqli_free_result($query); 

        echo("document.getElementById('input_nome').value='".$cliente."';");
        echo("document.getElementById('input_mat').value='".$matricula."';");
        echo("document.getElementById('input_produto').value='".$produto."';");
        echo("document.getElementById('input_quant').value='".$quantidade."';");
        echo("document.getElementById('input_entrega').value='".$data_entrega."';");
        echo("document.getElementById('input_user').value='".$usuario."';");

        echo ("</script>");

    }

    function saidas_corpo(){

        $sql = "select t1.id_saida, date_format(t1.data_saida,'%d/%m/%y') as d1, t3.nome as cliente, t2.nome as produto, t1.quant, ";
        $sql .= "t1.tipo as tiposaida, t1.observacoes, t4.nome as usuario ";
        $sql .= "from tbl_saidas t1 ";
        $sql .= "inner join tbl_produtos t2 on (t1.id_produto = t2.id_produto) ";
        $sql .= "inner join tbl_clientes t3 on (t1.matricula = t3.matricula) ";
        $sql .= "inner join tbl_usuarios t4 on (t1.id_user = t4.id_user) ";
        $sql .= "order by t1.id_saida desc";
        $Dbobj = new dbconnection(); 
        $query = mysqli_query($Dbobj->getdbconnect(), $sql);  
        while($row = $query->fetch_assoc()) {
            
            $bt1 = "<a class='w3-btn w3-round w3-hover-red w3-text-green' data-toggle='tooltip' ";
            $bt1 .= "title='Excluir' onclick='Excluir(".$row["id_saida"].")'><i class='fa fa-trash-o' aria-hidden='true'></i></a>&nbsp;&nbsp;";

            echo( "<tr>");
            echo ("<td>".$bt1.$row["d1"]."</td>");
            echo ("<td>".$row["cliente"]."</td>");
            echo ("<td>".$row["produto"]."</td>");
            echo ("<td>".$row["quant"]."</td>");
            echo ("<td>".$row["tiposaida"]."</td>");
            echo ("<td>".$row["observacoes"]."</td>");
            echo ("<td>".$row["usuario"]."</td>");
            echo( "</tr>");
        }
        mysqli_free_result($query); 
    }

}

?>