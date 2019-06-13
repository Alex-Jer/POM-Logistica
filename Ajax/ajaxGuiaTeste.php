<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
// echo $_POST['id'];
echo '<div class="table-title" style="background-color:#007bff;">';
echo '<div class="row">';

if ($_POST['id'] == 1) {
  echo '<div class="col-sm-6">';
  echo '<h2 style="text-align:left">Guias de <b>Entrega</b></h2>';
  echo '</div>';
  echo '<div class="col-sm-6">';
  echo '<button type = "button" data-target="#addEmployeeModal" style="background-color:#01d932" class="btn btn-success desktopAddEntrega mobileAdd" name="Entrega" value = "1" data-toggle="modal"><i class="material-icons">&#xE147;</i></button>';
  echo '</div>';
} elseif ($_POST['id'] == 2) {
  echo '<div class="col-sm-6">';
  echo '<h2 style="text-align:left">Guias de <b>Transporte</b></h2>';
  echo '</div>';
  echo '<div class="col-sm-6">';
  echo '<button type = "button"data-target="#addEmployeeModal" style="background-color:#01d932" class="btn btn-success desktopAddTransporte mobileAdd" name="Transporte" value = "2" data-toggle="modal"><i class="material-icons">&#xE147;</i></button>';
  echo '</div>';
}
echo '</div>';
echo '</div>';


?>

<script>
  $('button[name="Entrega"]').on("click", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxGuiaGuardarEntrega.php',
      type: 'POST',
      data: {
        id: $(this).val(),
      },
      success: function(data) {
        $("#ModalGuia").html(data);
      },
    });
  });
</script>


<script>
  $('button[name="Transporte"]').on("click", function() {
    $.ajax({
      url: '/POM-Logistica/Ajax/ajaxGuiaGuardarTransporte.php',
      type: 'POST',
      data: {
        id: $(this).val(),
      },
      success: function(data) {
        $("#ModalGuia").html(data);
      },
    });
  });
</script>
