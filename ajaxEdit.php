<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estagio";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn, "utf8");

$id = $_POST['id'];

$stmt = $conn->prepare("SELECT nome,nif,morada,localidade FROM cliente WHERE id=? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nome, $nif, $morada, $localidade);
$stmt->fetch();

echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem;">Nome</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto" class="form-control" name="eNome" value="' . $nome . '" required>';
echo    '<input type="hidden" value="' . $id . '" name="editID">';
echo '</div>';
echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem;">NIF</label>';
// echo    '<input type="text" style="margin-left:auto; margin-right:auto" class="form-control" name="eNif" value="' . $nif . '" required>';
echo    '<input style="margin-left:auto; margin-right:auto" class="form-control" type="number" id="uintTextBox" name="eNif" max="999999999" pattern=".{9,}" minlength=9 maxlength=9 title="O NIF tem de ter 9 dígitos." value="' . $nif . '" required>';
echo '</div>';
echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem;">Morada</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto" class="form-control" name="eMorada" value="' . $morada . '" required>';
echo '</div>';
echo '<div class="form-group">';
echo    '<label style="margin-left:1.2rem;">Localidade</label>';
echo    '<input type="text" style="margin-left:auto; margin-right:auto" class="form-control" name= "eLocaliadade" value="' . $localidade . '" required>';
echo '</div>';
echo '<div class="form-group">';
//  echo    '<label>Nome</label>';
//  echo     '<input type="text" class="form-control" value="'.$nome.'" required>';
//  echo   '</div>';
