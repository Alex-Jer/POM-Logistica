<!DOCTYPE html>
<html lang=pt dir="ltr">
<?php
$db = $_SERVER['DOCUMENT_ROOT'];
$db .= "/POM-Logistica/db.php";
include_once($db);
$navbar = $_SERVER['DOCUMENT_ROOT'];
$navbar .= "/POM-Logistica/Navbar/navbarOperador.php";
include_once($navbar);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['data'];
}
?>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="node_modules\bootstrap-datepicker\dist\css\bootstrap-datepicker.standalone.css">
    <link rel="stylesheet" href="styles\style.min.css">
    <link rel="stylesheet" href="node_modules\jquery\dist\jquery.js">
</head>

<style>
    body {
        overflow: hidden;
    }

    /* width */
    ::-webkit-scrollbar {
        width: 0.3rem;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #007bff;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #0056b3;
    }

    tbody,
    thead tr {
        display: block;
    }

    tbody {
        height: 18rem;
        overflow-y: auto;
        overflow-x: hidden;
    }

    tbody td,
    thead th {
        width: 210px;
    }

    thead th:last-child {
        width: 220px;
        /* 140px + 16px scrollbar width */
    }
</style>

<body>
    <?php
    $timeRN = date("Y-m-d");
    ?>
    <div class="row align-items-center">
        <div class="card card-container" style="text-align:center; width:85rem; height:35rem; margin-bottom:auto; max-width: 10000px;">
            <p id="profile-name" class="profile-name-card"></p>
            <form class="container" action="/POM-Logistica/Operador/Listagens/listagem_pedidos_armazem.php" method="post">
                <div style="text-align:center;">
                    <h1 style="margin-bottom:1rem;">Pedidos do dia</h1>
                    <?php
                    if (isset($data)) {
                        ?>
                        <input class="form-control" onchange="this.form.submit()" style="text-align:center; text-indent:1.5rem; margin-left:auto; margin-right:auto; width:17rem; border-color:#007bff;" type="date" value="<?php echo $data ?>" name="data">
                    <?php
                } else {
                    ?>
                        <input class="form-control" onchange="this.form.submit()" style="text-align:center; text-indent:1.5rem; margin-left:auto; margin-right:auto; width:17rem; border-color:#007bff;" type="date" value="<?php echo $timeRN ?>" name="data">
                    <?php
                }
                ?>
                    <div>
                        <table style="margin-top:2rem; margin-left:-25px; width: 1160px; text-align:center" class="table">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Nº de requisição</th>
                                    <th>Armazém</th>
                                    <th>Nº paletes</th>
                                    <th style="width:17%">Data e hora prevista</th>
                                    <th style="width:17%">Data e hora de carga</th>
                                    <th>Morada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                date_default_timezone_set("Europe/Lisbon");
                                if (isset($data)) {


                                    //$query = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id = 2 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
                                    $query = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id = 2 or tipo_guia_id = 1 AND DATE(data_prevista)='$data' ORDER BY data_carga ASC");
                                } else {
                                    $query = mysqli_query($conn, "SELECT * FROM guia WHERE tipo_guia_id = 2  or tipo_guia_id = 1 AND DATE(data_prevista)='$timeRN' ORDER BY data_carga ASC");
                                }
                                foreach ($query as $eachRow) {
                                    $clienteId = $eachRow['cliente_id'];
                                    $numReq = $eachRow['numero_requisicao'];
                                    $armazem = $eachRow['armazem_id'];
                                    $numPaletes = $eachRow['numero_paletes'];
                                    $dataPrevista = $eachRow['data_prevista'];
                                    $dataCarga = $eachRow['data_carga'];
                                    $morada = $eachRow['morada'];
                                    $sql2 = mysqli_query($conn, "SELECT * FROM cliente WHERE id='$clienteId'");
                                    $sql3 = mysqli_fetch_array($sql2);
                                    $nomeCliente = $sql3['nome'];
                                    $sql4 = mysqli_query($conn, "SELECT * FROM armazem WHERE id='$armazem'");
                                    $sql5 = mysqli_fetch_array($sql4);
                                    $nomeArmazem = $sql5['nome'];
                                    ?>
                                    <tr>
                                        <td><?php echo $nomeCliente ?></td>
                                        <td><?php echo $numReq ?></td>
                                        <td><?php echo $nomeArmazem ?></td>
                                        <td><?php echo $numPaletes ?></td>
                                        <td style="width:17%"><?php echo $dataPrevista ?></td>
                                        <td style="width:17%"><?php echo $dataCarga ?></td>
                                        <td><?php echo $morada ?></td>
                                    </tr>

                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
    <script type="text/javascript"></script>
    <script type="text/javascript"></script>
</body>

</html>
