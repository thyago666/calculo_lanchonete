<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="container">
      <h1>CADASTRO DE CUSTO VARIÁVEL</h1>
    <form method="post" action="{{url('/insert/var/config')}}">
      @csrf
     <div class="form-group">
          <label for="qtd"><b>Descrição</b></label>
          <input type="TEXT" class="form-control" id="descricao" name="descricao">
          <small id="descricao" class="form-text text-muted">Informe aqui a descrição do seu custo variável, ex, Cartão de crédito, Impostos, Taxas etc...</small>
        </div>


        <div class="form-group">
          <label for="valor"><b>Valor</b></label>
          <input type="text" class="form-control" id="valor" name="valor">
          <small id="valor" class="form-text text-muted">Informe aqui o valor do seu custo variável</small>
        </div>
         
        <button type="submit" class="btn btn-primary">Gravar</button>
        <a href="{{url("/")}}"> <button type="button" class="btn btn-warning">Voltar</button></a>
  

      </form>
</body>
</html>