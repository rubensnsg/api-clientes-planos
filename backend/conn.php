<?php session_start();

header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('America/Sao_Paulo');

$nomeSite = 'Mosyle';
$md5 = 'M0SYL3';

/* BANCO DE DADOS FREE - CONTEM TABELAS USADAS EM OUTROS TESTES  */
$host_bd = 'bvzfdagnfqepipz70gyw-mysql.services.clever-cloud.com';
$username_bd = 'ufgpsjx1cswrmye3';
$password_bd = 'ZoKM7HXwAaZAgd9ugpTr';
$nome_bd = 'bvzfdagnfqepipz70gyw';


try{
  $pdo = new PDO('mysql:host='.$host_bd.';dbname='.$nome_bd, $username_bd, $password_bd);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
  finalDialogue(2, "Erro no acesso ao banco de dados.", null);
  //echo 'Erro no acesso ao banco de dados:<br />' . $e->getMessage();
}


/*
  int $status - 0 error, 1 OK, 2 WARNING
  string  $response - opcional
  array   $dataArray - exit in doc
*/

function finalDialogue($status, $response = null, $dataArray = array()){
  
  echo json_encode(
    array(
      'status' => $status,
      'response' => $response,
      'dataArray' => $dataArray
    )
  );

  /*
  if(($dataArray <> '') || (is_array($dataArray) && count($dataArray) > 0)){
    echo json_encode($dataArray);

  }else{
    echo json_encode($response);
  }
  */

  exit;
}

/*
  string  $rqMethod - POST, GET, PULL, DELETE
  array   $path - routers
  array   $json - send
          $pdo - var Connection
  string  $md5 - Global var with term to encrypt
*/
function executeProgram($rqMethod, $path = array(), $json, $pdo, $md5){

  //print_r($path);

  switch ($rqMethod) {
    case 'GET':
      //finalDialogue(1, "Entrou no GET", array());

      if(isset($path[0]) && $path[0] == "clientes"){

        $planosArray = arrayPlanos($pdo);
        
        $table = "bvzfdagnfqepipz70gyw.Origoclientes";
        $columns = array("iduser", "nome", "email", "contato", "estado", "cidade", "nascimento", "Origoclientes.planos AS planosIDs");
        $where = "ORDER BY iduser DESC";
        $parameters = array();
        $pageNumberGet = 1;
        $quantityPerPage = 6;

        if(isset($path[1]) && $path[1] <> ""){

          if(is_numeric($path[1])){
            $where = "WHERE iduser = ? ".$where;
            $parameters[0] = $path[1];

          }elseif($path[1] == "page"){

            if(isset($path[2]) && is_numeric($path[2])){
              $pageNumberGet = $path[2];
            }

          }else{

          }

        }else{

        }

        $paginationSQL = PaginationSelect($table, "iduser", $where, $parameters, $pageNumberGet, $quantityPerPage, $pdo);
        $where .= $paginationSQL['limitSQL'];
        // exit(json_encode($where));

        $rowSQL = selectSQL($table, $columns, $where, $parameters, $pdo);

        if(count($rowSQL) > 0){

          foreach ($rowSQL as $key => $value) {

            /*
            */
            if($value['planosIDs'] <> ''){
              $value['planosNomes'] = arrayPlanosNomes($planosArray, $value['planosIDs']);

            }else{
              checkPlanoExistsonDB($value['iduser'], $pdo);
              $value['planosIDs'] = '1';
              $value['planosNomes'] = 'Free';
            }


            /*
            finalDialogue(2, "Sem problemas de usuários teste.", null);
            exit;
            */
            $selectSQl[$key] = array("iduser" => $value['iduser'],
                                      "nome" => $value['nome'],
                                      "email" => $value['email'],
                                      "contato" => $value['contato'],
                                      "estado" => $value['estado'],
                                      "cidade" => $value['cidade'],
                                      "nascimento" => dataFormatoBR($value['nascimento']),
                                      "planosIDs" => $value['planosIDs'],
                                      "planosNomes" => $value['planosNomes']);
            /**/
          }

          $jsonExit = array('RowPerPage' => (string) $quantityPerPage,
                            'TotalRows' => $paginationSQL['countSQL'],
                            'FirstPage' => $paginationSQL['paginationStart'],
                            'ActualPage' => $paginationSQL['paginationNow'],
                            'LastPage' => $paginationSQL['paginationEnd'],
                            'Rows' => $selectSQl);

          /* countSQL
          print_r($jsonExit);
          exit;
          */

          finalDialogue(1, "Select com sucesso", $jsonExit);

        }else{
          finalDialogue(2, "Sem registro de usuários.", null);
        }

      }elseif(isset($path[0]) && $path[0] == "planos"){
        
        $table = "bvzfdagnfqepipz70gyw.Origoplanos";
        $columns = array("idplano", "plano", "mensalidade");
        $where = "ORDER BY idplano ASC";
        $parameters = array();
        $pageNumberGet = 1;
        $quantityPerPage = 6;

        if(isset($path[1]) && $path[1] <> ""){

          if(is_numeric($path[1])){
            $where = "WHERE idplano = ? ".$where;
            $parameters[0] = $path[1];

          }elseif($path[1] == "page"){

            if(isset($path[2]) && is_numeric($path[2])){
              $pageNumberGet = $path[2];
            }

          }else{

          }

        }else{

        }

        $paginationSQL = PaginationSelect($table, "idplano", $where, $parameters, $pageNumberGet, $quantityPerPage, $pdo);
        $where .= $paginationSQL['limitSQL'];
        // exit(json_encode($where));

        $rowSQL = selectSQL($table, $columns, $where, $parameters, $pdo);

        if(count($rowSQL) > 0){

          foreach ($rowSQL as $key => $value) {

            $selectSQl[$key] = array("idplano" => $value['idplano'],
                                      "plano" => $value['plano'],
                                      "mensalidade" => $value['mensalidade']);
            /**/
          }

          $jsonExit = array('RowPerPage' => (string) $quantityPerPage,
                            'TotalRows' => $paginationSQL['countSQL'],
                            'FirstPage' => $paginationSQL['paginationStart'],
                            'ActualPage' => $paginationSQL['paginationNow'],
                            'LastPage' => $paginationSQL['paginationEnd'],
                            'Rows' => $selectSQl);

          /* countSQL
          print_r($jsonExit);
          exit;
          */

          finalDialogue(1, "Select com sucesso", $jsonExit);

        }else{
          finalDialogue(2, "Sem registro de usuários.", null);
        }

      }else{
        finalDialogue(2, "URL sem tratamento em método GET", $json);
      }

      break;

    case 'POST':
      //finalDialogue(1, "Entrou no POST", $json);

      if(isset($path[0]) && $path[0] == "clientes"){

        checkStringNoNull($json, 'email');
        $SQLemail = filter_var($json["email"], FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (filter_var($SQLemail, FILTER_VALIDATE_EMAIL)) {
          checkEmailExistsonDB($SQLemail, '', $pdo);
        } else {
          finalDialogue(2, "Email não foi validado. Por favor, verifique o campo e tente novamente.", null);
        }

        checkStringNoNull($json, 'nome');
        checkStringNoNull($json, 'contato');
        checkStringNoNull($json, 'estado');
        checkStringNoNull($json, 'cidade');
        checkStringNoNull($json, 'nascimento');

        $SQLnome = $json["nome"];
        $SQLcontato = $json["contato"];
        $SQLestado = $json["estado"];
        $SQLcidade = $json["cidade"];
        $SQLnascimento = $json["nascimento"];
        $SQLplanos = isset($json["planos"]) && $json["planos"] <> '' ? $json["planos"] : '1';

        if(checkDataBR($SQLnascimento)){
          $SQLnascimento = dataFormatoEn($SQLnascimento);

        }else{
          if(checkDataEN($SQLnascimento)){
            $SQLnascimento = $SQLnascimento;

          }else{
            finalDialogue(2, "Data de nascimento não é uma data válida.", null);
          }
        }

        $table = "bvzfdagnfqepipz70gyw.Origoclientes";
        $showMessage = 1;
        insertSQL($table, array('nome' => $SQLnome,
                                'email' => $SQLemail,
                                'contato' => $SQLcontato,
                                'estado' => $SQLestado,
                                'cidade' => $SQLcidade,
                                'nascimento' => $SQLnascimento,
                                'planos' => $SQLplanos),
                  $showMessage, $pdo);

      }else{
        finalDialogue(2, "URL sem tratamento em método POST", $json);
      }

      break;

    case 'PUT':
      //finalDialogue(1, "Entrou no PUT", array());

      if(isset($path[0]) && $path[0] == "clientes"){

        if(isset($path[1]) && $path[1] <> '' && is_numeric($path[1])){

          checkStringNoNull($json, 'email');
          $SQLemail = filter_var($json["email"], FILTER_SANITIZE_EMAIL);

          // Validate e-mail
          if (filter_var($SQLemail, FILTER_VALIDATE_EMAIL)) {
            checkEmailExistsonDB($SQLemail, ' AND iduser <> '.$path[1], $pdo);
          } else {
            finalDialogue(2, "Email não foi validado. Por favor, verifique o campo e tente novamente.", null);
          }

          checkStringNoNull($json, 'nome');
          checkStringNoNull($json, 'contato');
          checkStringNoNull($json, 'estado');
          checkStringNoNull($json, 'cidade');
          checkStringNoNull($json, 'nascimento');
          checkStringNoNull($json, 'planos');

          $SQLnome = $json["nome"];
          $SQLcontato = $json["contato"];
          $SQLestado = $json["estado"];
          $SQLcidade = $json["cidade"];
          $SQLnascimento = $json["nascimento"];
          $SQLplanos = $json["planos"];

          if(checkDataBR($SQLnascimento)){
            $SQLnascimento = dataFormatoEn($SQLnascimento);

          }else{
            if(checkDataEN($SQLnascimento)){
              $SQLnascimento = $SQLnascimento;

            }else{
              finalDialogue(2, "Data de nascimento não é uma data válida.", null);
            }
          }

          $table = "bvzfdagnfqepipz70gyw.Origoclientes";
          $columns = array("iduser", "nome", "email", "contato", "estado", "cidade", "nascimento", "planos");
          $where = "WHERE iduser = ? ORDER BY iduser ASC";
          $parameters[0] = $path[1];

          $rowSQL = selectSQL($table, $columns, $where, $parameters, $pdo);
          /*
          print_r($rowSQL);
          exit;
          */

          if(count($rowSQL) > 0){

            if($SQLnome == $rowSQL[0]["nome"] && $SQLemail == $rowSQL[0]["email"] && $SQLcontato == $rowSQL[0]["contato"] && $SQLestado == $rowSQL[0]["estado"] && $SQLcidade == $rowSQL[0]["cidade"] && $SQLnascimento == $rowSQL[0]["nascimento"] && $SQLplanos == $rowSQL[0]["planos"]){
              
              finalDialogue(1, "Dados enviados são iguais aos encontrados no banco de dados.", null);

            }else{

              $columns = array("nome", "email", "contato", "estado", "cidade", "nascimento", "planos");
              $parameters = array($SQLnome, $SQLemail, $SQLcontato, $SQLestado, $SQLcidade, $SQLnascimento, $SQLplanos, $path[1]);

              updateSQL($table, $columns, $where, $parameters, $pdo);

              finalDialogue(1, "Dados atualizados com sucesso no banco de dados.", null);
            }

          }else{
            finalDialogue(2, "Não existe usuário com o ID informado. Por favor, verifique o campo e tente novamente.", null);
          }

        }else{
          finalDialogue(2, "Campo iduser não foi encontrado. Por favor, verifique a URL e tente novamente.", null);
        }

      }else{
        finalDialogue(2, "URL sem tratamento em método PUT", $json);
      }

      break;

    case 'DELETE':
      //finalDialogue(1, "Entrou no DELETE", array());

      if(isset($path[0]) && $path[0] == "clientes"){

        if(isset($path[1]) && $path[1] <> '' && is_numeric($path[1])){

          $table = "bvzfdagnfqepipz70gyw.Origoclientes";
          $columns = array("iduser", "nome", "email", "estado", "planos");
          /* "IF(EXISTS(SELECT planoID FROM Origocontratos WHERE planoID = '1' AND clienteID = iduser), 1, 2) planoFree",
                            "(SELECT COUNT(planoID) FROM Origocontratos WHERE clienteID = iduser) planoQtd" */
          $where = "WHERE iduser = ? ORDER BY iduser ASC";
          $parameters[0] = $path[1];

          $rowSQL = selectSQL($table, $columns, $where, $parameters, $pdo);
          /*
          finalDialogue(1, "Teste", $rowSQL);
          exit;
          */

          if(count($rowSQL) > 0){
            
            $rowSQL[0]['planoFree'] = '2';

            if($rowSQL[0]["planos"] <> ""){
              if(strpos($rowSQL[0]["planos"], ',') === false) {
                if($rowSQL[0]["planos"] == '1'){
                  $rowSQL[0]['planoFree'] = '1';
                }
                $rowSQL[0]['planoQtd'] = '1';

              }else{

                $explodido = explode(",", $rowSQL[0]["planos"]);
                foreach ($explodido as $value0){
                  if(trim($value0) == '1'){
                    $rowSQL[0]['planoFree'] = '1';
                  }
                }
                $rowSQL[0]['planoQtd'] = count($explodido);
              }

            }else{
              checkPlanoExistsonDB($parameters[0], $pdo);
              $rowSQL[0]['planoFree'] = '1';
              $rowSQL[0]['planoQtd'] = '1';
            }

            if($rowSQL[0]['planoFree'] == '1' && (trim($rowSQL[0]['estado']) == 'São Paulo' || trim($rowSQL[0]['estado']) == 'SP') ){
              finalDialogue(2, "Atenção este usuário não pode ser excluído, pois está no estado em São Paulo e possui o plano Free.", null);

            }else{

              deleteSQL($table, $where, $parameters, $pdo);
              finalDialogue(1, "Usuário excluído com sucesso.", null);
            }

          }else{
            finalDialogue(2, "Não existe usuário com o ID informado. Por favor, verifique o campo e tente novamente.", null);
          }

        }else{
          finalDialogue(2, "Campo ID usuário não foi encontrado. Por favor, verifique o campo e tente novamente.", null);
        }
      }

      break;
    
    default:
      finalDialogue(2, "Parâmetro não enviado", null);
      break;
  }
}


/*
  string  $table - table name on Database
  array   $columns - All fields, key = column name on Database and value = value to insert
  bool    $showMessage - 1 true, 0 false
          $pdo - var Connection
*/
function insertSQL($table, $columns = array(), $showMessage, $pdo){

  $querySQL = "INSERT INTO ".$table."(".implode(", ",array_keys($columns)).") VALUES(:".implode(", :",array_keys($columns)).")";
  // print_r($querySQL);
  $query = $pdo->prepare($querySQL);
  foreach ($columns as $key => $value) {
    $query->bindValue($key,  $value);
    // echo "<br />".$key." - ".$value;
  }
  $query->execute();
  
  if($query->rowCount()){
    $idItem = $pdo->lastInsertId();

    if($showMessage == 1){
      finalDialogue(1, "Registro inserido com sucesso.", array($idItem));

    }else{
      return $idItem;
    }

  }else{
    finalDialogue(0, "Erro ao executar insert sql. Por favor, tente novamente mais tarde.", null);    
  }
}


/*
  string  $table - table name on Database
  array   $columns - only values, fields to select SQL
  string  $where - Clause where complete to select on mysql, Opcional group by, order
  array   $parameters - only values, string to bindValue
          $pdo - var Connection

  return = array $returnValues
*/
function updateSQL($table, $columns, $where, $parameters, $pdo){

  $querySQL = "UPDATE ".$table." SET ".implode(" = ? , ", $columns)." = ? ".$where." ";
  //print_r($querySQL);

  $query = $pdo->prepare($querySQL);
  //echo count($parameters);
  if(is_array($parameters) && count($parameters) > 0){
    foreach ($parameters as $key => $value) {
      $query->bindValue(($key + 1), $value);
      //echo "<br />".$key." - ".$value;
    }
  }
  $query->execute();
  
  if($query->rowCount()){
    // finalDialogue(1, "Usuário editado com sucesso.", null);   

  }else{
    finalDialogue(0, "Erro ao executar update sql. Por favor, tente novamente mais tarde.", null);    
  }
}


/*
  string  $table - table name on Database
  string  $where - Clause where complete to select on mysql, Opcional group by, order
  array   $parameters - only values, string to bindValue
          $pdo - var Connection

  return = array $returnValues
*/
function deleteSQL($table, $where, $parameters, $pdo){

  $querySQL = "DELETE FROM ".$table." ".$where." ";
  // print_r($querySQL);

  $query = $pdo->prepare($querySQL);
  // echo count($parameters);
  if(is_array($parameters) && count($parameters) > 0){
    foreach ($parameters as $key => $value) {
      $query->bindValue(($key + 1), $value);
      // echo "<br />".$key." - ".$value;
    }
  }
  $query->execute();
}

/*
  string  $table - table name on Database
  array   $columns - only values, fields to select SQL
  string  $where - Clause where complete to select on mysql, Opcional group by, order
  array   $parameters - only values, string to bindValue
          $pdo - var Connection

  return = array $returnValues
*/
function selectSQL($table, $columns, $where, $parameters, $pdo){

  $querySQL = "SELECT ".implode(", ", $columns)." FROM ".$table." ".$where." ";
  //print_r($querySQL);

  $query = $pdo->prepare($querySQL);
  //echo count($parameters);
  if(is_array($parameters) && count($parameters) > 0){
    foreach ($parameters as $key => $value) {
      $query->bindValue(($key + 1), $value);
      //echo "<br />".$key." - ".$value;
    }
  }
  $query->execute();
  $returnValues = $query->fetchAll();

  return $returnValues;
}


/*
  string  $table - table name on Database
  array   $idColumn - idColumn from table SQL
  string  $where - Clause where complete to select on mysql, Opcional group by, order
  array   $parameters - only values, string to bindValue
  number  $pageNumberGet - only number, number to page active
  number  $quantityPerPage - only number, number the quantity to show on page 
          $pdo - var Connection

  return = array FirstPage = paginationStart, ActualPage = paginationNow, LastPage = paginationEnd, sql limit = limitSQL
*/
function PaginationSelect($table, $idColumn, $where, $parameters, $pageNumberGet, $quantityPerPage, $pdo){
  
  if(isset($quantityPerPage) && is_numeric($quantityPerPage) && $quantityPerPage > 0){
    $pageLength =  $quantityPerPage;
  }else{
    $pageLength =  "12";
  }

  $numberStart = ($pageNumberGet * $pageLength) - $pageLength;
  $limitSQL = " LIMIT " . $numberStart . ", " . $pageLength . "";
  // exit(json_encode($limitSQL));

  $totalNumberSQL = 0;
  $numberSQL = selectSQL($table, array("COUNT(".$idColumn.") AS total"), $where, $parameters, $pdo);
  if (isset($numberSQL[0][0]) && is_numeric($numberSQL[0][0]) && $numberSQL[0][0] > 0) { // Quantidade de linhas no SELECT
    $totalNumberSQL = $numberSQL[0][0];
  }

  $paginationEnd = (string) (ceil($totalNumberSQL / $pageLength));


  $arrayReturn = array('paginationStart' => '1',
                        'paginationNow' => $pageNumberGet,
                        'paginationEnd' => $paginationEnd,
                        'countSQL' => $totalNumberSQL,
                        'limitSQL' => $limitSQL);

  return $arrayReturn;
}

/*
  $pdo - var Connection

  return = array with all planos on DB
*/
function arrayPlanos($pdo){

  $querySQL = "SELECT idplano, plano, mensalidade FROM bvzfdagnfqepipz70gyw.Origoplanos ORDER BY idplano ASC ";
  $query = $pdo->prepare($querySQL);
  $query->execute();

  $planosArray = array();
  if($query->rowCount()){
    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
      $planosArray[$row["idplano"]] = array('Nome' => $row["plano"], 'Valor' => $row["mensalidade"]); 
    }
  }

  return $planosArray;
}

/*
  array   $planosArray - all values returned from function arrayPlanos
  string  $idstoReturnName - All IDs separated with comma

  return = string Nomes dos planos encontrados
*/
function arrayPlanosNomes($planosArray, $idstoReturnName){

  $planosNomes = '';

  if(strpos($idstoReturnName, ',') === false) {
    if(isset($planosArray[trim($idstoReturnName)]) ){
      $planosNomes = $planosArray[trim($idstoReturnName)]["Nome"];
    }else{
      $planosNomes = 'Indefinido';
    }

  }else{
    $planosNomes = '';

    $explodido = explode(",", $idstoReturnName);
    foreach ($explodido as $value0){
      if(isset($planosArray[trim($value0)]) ){
        $planosNomes .= $planosArray[trim($value0)]["Nome"].', ';
      }else{
        $planosNomes .= 'Indefinido, ';
      }
    }
    $planosNomes = substr($planosNomes, 0, -2);
  }

  return $planosNomes;
}


/*
  array   $json - all values
  string  $field - field name
*/
function checkStringNoNull($json, $field){
  if(isset($json[$field]) && $json[$field] <> ''){

  }else{
    finalDialogue(0, "Parâmetro Obrigatório ".$field." não foi enviado.", null);
  }
}


/*
  string  $email - email
  string  $where - Clause where complete to select on mysql, Opcional group by, order
          $pdo - var Connection
*/
function checkEmailExistsonDB($email, $where, $pdo){

  $table = "bvzfdagnfqepipz70gyw.Origoclientes";
  $columns = array("COUNT(iduser) AS total");
  $where = "WHERE email = ? ". $where;
  $parameters = array($email);

  $rowSQL = selectSQL($table, $columns, $where, $parameters, $pdo);

  if($rowSQL[0]['total'] > 0){
    finalDialogue(0, "Já existe um cliente com este email", null);
  }
}


/*
  string  $iduser - client id from table
          $pdo - var Connection

  return $idItem - last id on mysql insert
*/
function checkPlanoExistsonDB($iduser, $pdo){

  $table = "bvzfdagnfqepipz70gyw.Origoclientes";
  $columns = array("planos");
  $where = 'WHERE iduser = ?';
  $parameters = array('1', $iduser);

  updateSQL($table, $columns, $where, $parameters, $pdo);
}

/*
  date    $dataRecebida - DD/MM/YYYY

  return = bool(1, 0)
*/
function checkDataBR($dataRecebida){ 
  if(strpos($dataRecebida, '/') === false) {
    return false;

  }else{
    $dataExplode = explode("/", $dataRecebida);
    return checkdate($dataExplode[1] ,$dataExplode[0] ,$dataExplode[2]); // int $month , int $day , int $year 
  }
}

/*
  date    $dataRecebida - YYYY-MM-DD

  return = bool(1, 0)
*/
function checkDataEN($dataRecebida){ 
  if(strpos($dataRecebida, '-') === false) {
    return false;

  }else{
    $dataExplode = explode("-", $dataRecebida);
    return checkdate($dataExplode[1], $dataExplode[2], $dataExplode[0]); // int $month , int $day , int $year 
  }
}

/*
  date    $dataRecebida - YYYY-MM-DD

  return = format DD/MM/YYYY
*/
function dataFormatoBR($dataRecebida){
  $strExplode = explode("-", $dataRecebida);
  return $strExplode[2]."/".$strExplode[1]."/".$strExplode[0];
}

/*
  date    $dataRecebida - DD/MM/YYYY

  return = format YYYY-MM-DD
*/
function dataFormatoEn($dataRecebida){
  $strExplode = explode("/", $dataRecebida);
  return $strExplode[2]."-".$strExplode[1]."-".$strExplode[0];
}


?>