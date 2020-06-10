# api-clientes-planos
Teste para a empresa Órigo energia, trata-se de um backend API para completar
o que foi pedido dentro do teste, que pediram para não publicar.

Vale ressaltar que criamos duas tabela no banco de dados MySQL em uma versão
online de graça com uma tabela até certo tamanho. A conexão está no arquivo
backend/conn.php e o comandos estão em bd.sql com insert de teste.

A maioria dos cenários tem como resposta um json com três itens

  1. status: onde 0 = error, 1 = OK e 2 = WARNING;

  2. response: comentário de apoio a quem está usando a API;

  3. dataArray: array com as saídas pedidas no teste, quando necessário.


Segue a tabela abaixo, para o funcionamento da API:

| URL                         | Type Request  |
| --------------------------- | ------------- |
| /clientes/:iduser           |  GET          |
| /clientes/page/:pageNumber  |  GET          |
| /planos/:iduser             |  GET          |
| /planos/page/:pageNumber    |  GET          |
| /clientes/                  |  POST         |
| /clientes/:iduser           |  PUT          |
| /clientes/:iduser           |  DELETE       |


Contém um .htaccess para o redirecionamento simples dentro da pasta

Vale ressaltar que também utilizei de biblioteca externas, via CDN, listadas abaixo

  Este projeto utiliza as seguintes tecnologias
    PHP v. 7.2.13

    Jquery v. 3.5.1
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <!--Pooper--><script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    Bootstrap v. 4.5.0
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    bootstrap-datepicker v. 1.9.0
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>


Qualquer dúvida sinta-se livre para me contatar
