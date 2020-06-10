<!doctype html>
<html lang="pt-Br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Jekyll v4.0.1">
  <title>Listagem</title>
  
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

  <style>
    .page-link{
      cursor: pointer;
    }
    table tbody tr td .badge{
      cursor: pointer;
    }
  </style>

</head>
<body>
  <header>
    <div class="navbar navbar-dark bg-dark shadow-sm">
      <div class="container d-flex justify-content-between">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <strong>Teste Origo Energia - Rubens Nelson</strong>
        </a>
      </div>
    </div>
  </header>

  <main role="main">

    <section class="jumbotron pt-3 pb-2 text-center">
      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800">
        <div class="d-flex justify-content-between">
           &nbsp; Lista de clientes
          <button type="button" onclick="window.location='form.php'" class="btn btn-primary btn-sm mt-1 mr-1">Inserir</button>
        </div>
      </h1>
    </section>

    <section class="table-card">
      <div class="container">
        <div class="row">

          <div class="card shadow mt-3 mb-5 px-0 col-12">
            <div class="card-header">
              <h6 class="m-0 font-weight-bold text-primary">Tabela com registros</h6>
            </div>
            <div class="card-body"> 
              
              <div id="resultApi">
                <div class="alert alert-primary mx-2" role="alert">
                  Carregando Informações
                </div>
              </div>

              <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr class="thead-light">
                      <th class="align-middle" width="30">ID</th>
                      <th class="align-middle">Nome</th>
                      <th class="align-middle">E-mail</th>
                      <th class="align-middle">Contato</th>
                      <th class="align-middle">Cidade</th>
                      <th class="align-middle">Estado</th>
                      <th class="align-middle">Nascimento</th>
                      <th class="align-middle">Plano</th>
                      <th class="align-middle" width="60">Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr class="thead-light">
                      <th class="align-middle">ID</th>
                      <th class="align-middle">Nome</th>
                      <th class="align-middle">E-mail</th>
                      <th class="align-middle">Contato</th>
                      <th class="align-middle">Cidade</th>
                      <th class="align-middle">Estado</th>
                      <th class="align-middle">Nascimento</th>
                      <th class="align-middle">Plano</th>
                      <th class="align-middle">Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td colspan="9" class="text-center p-5">Carregando</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="card-footer">
              <nav id="paginacao" aria-label="Page navigation example">
                <ul class="pagination mb-0">
                  <!--<li class="page-item"><div class="page-link">1</div></li>
                  <li class="page-item"><div class="page-link">2</div></li>
                  <li class="page-item"><div class="page-link">3</div></li>-->
                </ul>
              </nav>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

  <footer class="text-muted">
    <div class="container">
      <p class="float-right">
        <a href="#">Back to top</a>
      </p>
      <p>Layout Desenvolvido com Bootstrap 4.5</p>
    </div>
  </footer>

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<script type="text/javascript">
var api_url = './backend/';
$( document ).ready(function() {
  $("#resultApi").hide();
  carregandoConteudo(1);
});

function resultAlert(typeAlert, messageAlert){
  var classAlert = '';

  if(typeAlert == 1){
    classAlert = 'alert-primary';
  }else if (typeAlert == 2){
    classAlert = 'alert-secondary';
  }else if (typeAlert == 3){
    classAlert = 'alert-success';
  }else if (typeAlert == 4){
    classAlert = 'alert-danger';
  }else if (typeAlert == 5){
    classAlert = 'alert-warning';
  }else if (typeAlert == 6){
    classAlert = 'alert-info';
  }else if (typeAlert == 7){
    classAlert = 'alert-light';
  }else{
    classAlert = 'alert-dark';
  }

  $("#resultApi").fadeOut(300, function(){
    $("#resultApi").html('<div class="alert ' + classAlert + ' mx-2" role="alert"> ' + messageAlert + ' </div>');
    $("#resultApi").fadeIn();
  });
}

function carregandoTable(texto){
  $("#dataTable tbody").html('<tr><td colspan="9" class="text-center p-5">' + texto + '</td></tr>');
}

function paginationClick(pageNumber){
  // $("#paginacao .pagination .page-item").on('click', function(){
  if ($("#paginacao").hasClass("carregando")){
    alert("Aguarde a finalização do operação atual para continuar.");
  }else{
    $("#paginacao").addClass('carregando');
    carregandoConteudo(pageNumber);
  }

  if($('#resultApi').is(':visible')){
    $("#resultApi").fadeOut(600);
  }
  // })
}

function pagination(startPage, lastPage, actualPage){
  var ConteunoNovo = '';

  for (var i = startPage; i <= lastPage; i++) {
    ConteunoNovo += '<li class="page-item';

    if(actualPage == i){
      ConteunoNovo += ' active';
    }else{
      ConteunoNovo += '"  onclick="paginationClick(' + i + ')';
    }

    ConteunoNovo += '" data-id="' + i + '"><div class="page-link"> ';
    ConteunoNovo += i;
    ConteunoNovo += ' </div</li>';
  }
  
  // console.log(ConteunoNovo);
  $("#paginacao .pagination").html(ConteunoNovo);
  $("#paginacao").removeClass('carregando');
}

function carregandoConteudo(pageNumber){

  $.ajax({
    url: api_url + "clientes/page/" + pageNumber,
    contentType: "application/json",
    dataType: 'json',
    type: "GET",
    beforeSend: function(){
      carregandoTable("Carregando");
    },
    success: function(result){
      // console.log(result);
      
      if(result.status == '1'){
        /*
        "dataArray": {
          "RowPerPage": "6",
          "TotalRows": "18",
          "FirstPage": "1",
          "ActualPage": 1,
          "LastPage": "3",
          "Rows": [...]
        }
        */
        // console.log($("#dataTable tbody tr:eq(0)").children('td').length);
        /*if($("#dataTable tbody tr:eq(0)").children('td').length == '1'){
          $("#dataTable tbody tr td").text("Sucesso ao carregar informações.");
        }else{
          carregandoTable("");
        }*/

        var ConteunoNovo = '';
        $.each(result.dataArray.Rows, function (key, item) {
          /* retorno esperado de exemplo
          "iduser": "18",
          "nome": "Reynolds Greenan",
          "email": "rgreenanb@bloomberg.com",
          "contato": "(35) 923551410",
          "estado": "Minas Gerais",
          "cidade": "Itapeva",
          "nascimento": "19\/07\/1985",
          "planosIDs": "2",
          "planosNomes": "Basic"
          */

          ConteunoNovo += '<tr>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.iduser;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.nome;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.email;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.contato;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.cidade;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.estado;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.nascimento;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += item.planosNomes;
            ConteunoNovo += '</td>';
            ConteunoNovo += '<td class="align-middle">';
              ConteunoNovo += '<span onclick="window.location=\'form.php?id=' + item.iduser + '\'" class="badge p-2 mb-2 badge-warning"> Edit. </span><br />';
              ConteunoNovo += '<span onclick="deletarCliente(' + item.iduser + ')" class="badge p-2 badge-danger"> Del. &nbsp;</span>';
            ConteunoNovo += '</td>';
          ConteunoNovo += '</tr>';
          // $('.product-slider').append(item.NmProduto);
        });

        // console.log(ConteunoNovo);
        $("#dataTable tbody").html(ConteunoNovo);
        pagination(result.dataArray.FirstPage, result.dataArray.LastPage, result.dataArray.ActualPage);

      }else{
        carregandoTable("Falha ao carregar informações. Por favor, tente novamente mais tarde.");
      }
    },
    error: function(result){
      carregandoTable("Falha ao requisitar informações. Por favor, tente novamente mais tarde.");
    }
  })

}

function deletarCliente(clienteID){

  if ($("#paginacao").hasClass("carregando")){
    alert("Aguarde a finalização do operação atual para continuar.");
  }else{
    $("#paginacao").addClass('carregando');

    if(confirm("Você realmente quer excluir este registro?")){
      $.ajax({
        url: api_url + "clientes/" + clienteID,
        contentType: "application/json",
        dataType: 'json',
        type: "DELETE",
        beforeSend: function(){
          resultAlert(1, "Apagando registro");
        },
        success: function(result){
          console.log(result);
          
          if(result.status == '1'){
            resultAlert(3, result.response);
            carregandoConteudo(1);

          }else{
            resultAlert(4, result.response);
            $("#paginacao").removeClass('carregando');
          }
        },
        error: function(result){
          resultAlert(4, "Falha ao requisitar exclusão. Por favor, tente novamente mais tarde.");
          $("#paginacao").removeClass('carregando');
        }
      })
    }
  }

}
</script>
</body>
</html>