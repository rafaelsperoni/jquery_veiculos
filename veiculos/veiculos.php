<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="jquery-3.3.1.min.js"></script>
	<script type="text/javascript">
$(function(){
  $('#marca').change(function(){
    if( $(this).val() ) {
      $('#modelo').hide();
      $('.carregando').show();
      $.getJSON(
        'http://fipeapi.appspot.com/api/1/carros/veiculos/'+$(this).val()+'.json', function(j){
          var options = '<option value="">Selecione...</option>';
          for (var i = 0; i < j.length; i++) {
            options += '<option value="' +
              j[i].id + '">' +
              j[i].name + '</option>';
          }
          $('#modelo').html(options).show();
          $('.carregando').hide();
        });
    } else {
      $('#modelo').html(
        '<option value="">-- Escolha uma montadora --</option>'
      );
    }
  });
});

	</script>
</head>
<body>

<?php
$url = 'http://fipeapi.appspot.com/api/1/carros/marcas.json'; // marcas

//http://fipeapi.appspot.com/api/1/carros/veiculos/21.json // veiculos da marca 21

$data = file_get_contents($url); // put the contents of the file into a variable
$marcas = json_decode($data); // decode the JSON feed

echo '<select name="marca" id="marca">';
	echo '<option selected>Selecione...</option>';
foreach ($marcas as $marca) {
	echo '<option value="'.$marca->id.'">'.$marca->name.'</option>';
}

echo '</select>';
?>

<select name="modelo" id="modelo">
	<option>selecione...</option>
</select>

<div class="carregando">Carregando...</div>
</body>
</html>

