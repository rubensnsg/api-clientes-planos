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

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

  <style>
    .page-link{
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
          <?php if(isset($_GET['id']) && is_numeric($_GET['id'])){ ?>
             &nbsp; Editar cliente
          <?php }else{ ?>
             &nbsp; Inserir cliente
          <?php } ?>
          <button type="button" onclick="window.location='./'" class="btn btn-info btn-sm mt-1 mr-1">Voltar</button>
        </div>
      </h1>
    </section>

    <section class="form-card">
      <div class="container">
        <div class="row">

          <div class="card shadow mt-3 mb-4 mx-auto px-0 col-12 col-md-10">

            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Detalhes</h6>
            </div>
            <div class="card-body"> 
              
              <div id="resultApi">
                <div class="alert alert-primary mx-2" role="alert">
                  Carregando Informações
                </div>
              </div>

              <form id="formulario" method="post" onsubmit="return false">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="formNome">Nome</label>
                  <div class="col-12 col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="formNome" id="formNome" required="required" maxlength="255" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="formEmail">Email</label>
                  <div class="col-12 col-sm-10">
                    <input type="email" class="form-control form-control-sm" name="formEmail" id="formEmail" required="required" maxlength="255" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="formContato">Contato</label>
                  <div class="col-12 col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="formContato" id="formContato" required="required" maxlength="50" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="formCidade">Cidade</label>
                  <div class="col-12 col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="formCidade" id="formCidade" required="required" maxlength="35" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="formEstado">Estado</label>
                  <div class="col-12 col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="formEstado" id="formEstado" required="required" maxlength="30" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="formNascimento">Nascimento</label>
                  <div class="col-12 col-sm-10">
                    <input type="text" class="form-control form-control-sm" name="formNascimento" id="formNascimento" required="required" placeholder="dd/mm/aaaa" data-date-end-date="0d" />
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label col-form-label-sm" for="planos">Plano</label>
                  <div class="tiposPlanos col-12 col-sm-10">
                    <!--<div class="form-check form-check-inline mx-2">
                      <input class="form-check-input" type="checkbox" id="plano1" value="1" name="planos[]" required="required" />
                      <label class="form-check-label" for="inlineCheckbox1"> &nbsp;Free </label>
                    </div>
                    <div class="form-check form-check-inline mx-2">
                      <input class="form-check-input" type="checkbox" id="plano2" value="2" name="planos[]" required="required" />
                      <label class="form-check-label" for="inlineCheckbox2"> &nbsp;Basic </label>
                    </div>
                    <div class="form-check form-check-inline mx-2">
                      <input class="form-check-input" type="checkbox" id="plano3" value="3" name="planos[]" required="required" />
                      <label class="form-check-label" for="inlineCheckbox3"> &nbsp;Plus </label>
                    </div>-->
                    Carregando
                  </div>
                </div>

                <input type="submit" class="btn btn-primary ml-3 mt-2 mb-2" name="submit" value="<?php if(isset($_GET['id']) && is_numeric($_GET['id'])){ ?> Editar <?php }else{ ?> Inserir <?php } ?>" />
              </form>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

<script type="text/javascript">
var api_url = './backend/';
$( document ).ready(function() {
  
  $("#resultApi").hide();
  carregandoPlanos(1);

  <?php if(isset($_GET['id']) && is_numeric($_GET['id'])){ ?>
    carregaDadosCliente('<?php echo $_GET['id']; ?>');
  <?php }else{ ?>
  <?php } ?>

  $("#formNascimento").datepicker({
    format: "dd/mm/yyyy",
    language: "pt-BR",
    startView : 'century',
    startDate: '-120Y',
    autoclose: true
  }).attr("autocomplete", "off");

  $("#formulario").on('submit', function(){

    if ($("#formulario").hasClass("carregando")){
      alert("Seu formulário está sendo enviado. Por favor, aguarde a resposta do servidor.");
    }else{
      $("#formulario").addClass('carregando');
      var myForm = new Object();
      myForm.nome = $("#formNome").val();
      myForm.email = $("#formEmail").val();
      myForm.contato = $("#formContato").val();
      myForm.estado = $("#formEstado").val();
      myForm.cidade = $("#formCidade").val();
      myForm.nascimento = $("#formNascimento").val();

      var favorite = [];
      $.each($(".tiposPlanos :checkbox:checked"), function(){
          favorite.push($(this).val());
      });

      //console.log(favorite.join(","));
      myForm.planos = favorite.join(",");

      if(myForm.planos == ""){
        resultAlert(5, 'Por favor, selecione pelo menos um plano.');
        $("#formulario").removeClass('carregando');

      }else{
        <?php if(isset($_GET['id']) && is_numeric($_GET['id'])){ ?>
          editandoConteudo(JSON.stringify(myForm), '<?php echo $_GET['id']; ?>');
        <?php }else{ ?>
          inserindoConteudo(JSON.stringify(myForm));
        <?php } ?>
      }
    }
  })
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

function inserindoConteudo(conteudoForm){

  // console.log(conteudoForm);

  $.ajax({
    url: api_url + "clientes/",
    contentType: "application/json",
    dataType: 'json',
    data: conteudoForm,
    type: "POST",
    beforeSend: function(result){
      resultAlert(1, "Enviando formulário");
    },
    success: function(result){
      // console.log(result);
      
      if(result.status == '1'){

        resultAlert(3, result.response + ' Cliente ID #' + result.dataArray[0] + '. Aguarde o redirecionamento');
        setTimeout(function(){ window.location = './'; }, 5000);
        //alert("Usuário inserido com sucesso");

      }else if (result.status == '2'){
        resultAlert(5, result.response + ' Por favor, tente novamente.');
        $("#formulario").removeClass('carregando');

      }else{
        resultAlert(4, result.response);
        $("#formulario").removeClass('carregando');
      }
    },
    error: function(result){
      resultAlert(4, "Falha ao enviar informações. Por favor, tente novamente mais tarde.");
      $("#formulario").removeClass('carregando');
    }
  })

}

function editandoConteudo(conteudoForm, clienteID){

  // console.log(conteudoForm);

  $.ajax({
    url: api_url + "clientes/" + clienteID,
    contentType: "application/json",
    dataType: 'json',
    data: conteudoForm,
    type: "PUT",
    beforeSend: function(result){
      resultAlert(1, "Enviando formulário");
    },
    success: function(result){
      // console.log(result);
      
      if(result.status == '1'){

        resultAlert(3, result.response + ' Aguarde o redirecionamento.');
        setTimeout(function(){ window.location = './'; }, 5000);

      }else if (result.status == '2'){
        resultAlert(5, result.response + ' Por favor, tente novamente.');
        $("#formulario").removeClass('carregando');

      }else{
        resultAlert(4, result.response);
        $("#formulario").removeClass('carregando');
      }
    },
    error: function(result){
      resultAlert(4, "Falha ao enviar informações. Por favor, tente novamente mais tarde.");
      $("#formulario").removeClass('carregando');
    }
  })

}

function carregandoPlanos(pageNumber){

  $.ajax({
    url: api_url + "planos/page/" + pageNumber,
    contentType: "application/json",
    dataType: 'json',
    type: "GET",
    success: function(result){
      //console.log(result);
      
      if(result.status == '1'){
        var ConteunoNovo = '';
        $.each(result.dataArray.Rows, function (key, item) {
          /* --- retorno esperado de exemplo
          {idplano: "3", plano: "Plus", mensalidade: "187.00"} */

          ConteunoNovo += '<div class="form-check form-check-inline mx-2">';
            ConteunoNovo += '<input class="form-check-input" type="checkbox" id="plano';
              ConteunoNovo += item.idplano + '" value="' + item.idplano;
            ConteunoNovo += '" name="planos[]" />';

            ConteunoNovo += '<label class="form-check-label" for="inlineCheckbox';
              ConteunoNovo += item.idplano + '"> &nbsp;' + item.plano;
            ConteunoNovo += '</label>';
          ConteunoNovo += '</div>';
        });

        // console.log(ConteunoNovo);
        $('.tiposPlanos').html(ConteunoNovo);
        //requiredCheckboxPlanos();

      }else{
        $('.tiposPlanos').html("Falha ao requisitar informações dos planos. Por favor, atualize a página.");
      }
    },
    error: function(result){
      $('.tiposPlanos').html("Falha ao requisitar informações dos planos. Por favor, atualize a página.");
    }
  })

}

function requiredCheckboxPlanos(){
  var requiredCheckboxes = $('.tiposPlanos :checkbox[required]');
  requiredCheckboxes.change(function(){
    if(requiredCheckboxes.is(':checked')) {
      requiredCheckboxes.removeAttr('required');
    } else {
      requiredCheckboxes.attr('required', 'required');
    }
  });
}

function carregaDadosCliente(clienteID){

  $("#formulario").addClass('carregando');

  $.ajax({
    url: api_url + "clientes/" + clienteID,
    contentType: "application/json",
    dataType: 'json',
    type: "GET",
    beforeSend: function(){
      $("form input[type='text'], form input[type='email']").attr("placeholder", "Carregando");
    },
    success: function(result){
      //console.log(result.dataArray.Rows[0].iduser);
      
      if(result.status == '1'){
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
        $("#formNome").val(result.dataArray.Rows[0].nome);
        $("#formEmail").val(result.dataArray.Rows[0].email);
        $("#formContato").val(result.dataArray.Rows[0].contato);
        $("#formEstado").val(result.dataArray.Rows[0].estado);
        $("#formCidade").val(result.dataArray.Rows[0].cidade);
        $("#formNascimento").val(result.dataArray.Rows[0].nascimento);

        if (result.dataArray.Rows[0].planosIDs.indexOf(',') > -1) {
          //console.log(result.dataArray.Rows[0].planosIDs.split(','));
          $.each(result.dataArray.Rows[0].planosIDs.split(','), function( key, value ) {
            //console.log( key + ": " + value );
            $("#plano" + value).attr("checked", true);
          });

        }else{
          $("#plano" + result.dataArray.Rows[0].planosIDs).attr("checked", true);
        }
        //requiredCheckboxPlanos();
      
        $("form input[type='text'], form input[type='email']").attr("placeholder", "");
        $("#formulario").removeClass('carregando');

      }else{
        resultAlert(4, "Falha ao carregar informações deste cliente. Por favor, tente novamente mais tarde.");
        setTimeout(function(){ window.location = './'; }, 5000);
      }
    },
    error: function(result){
      resultAlert(4, "Falha ao requisitar informações. Por favor, tente novamente mais tarde.");
      setTimeout(function(){ window.location = './'; }, 5000);
    }
  })

}
</script>

</body>
</html>