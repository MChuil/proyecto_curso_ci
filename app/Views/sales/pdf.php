<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas</title>
    <link href="<?= base_url("assets/css/sb-admin-2.min.css") ?>" rel="stylesheet">
</head>
<body>
    <table width="100%" class="table table-bordered">
        <thead>
            <tr>
                <th>No.Venta</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Empleado</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $idVenta = 0;
                foreach ($ventas as $venta):
                    if($venta["id"] != $idVenta):
                        // if(5 != 4):
                ?>
                    <tr class="bg-primary text-white">
                        <td><?= $venta["id"] ?></td>
                        <td><?= $venta["created_at"] ?></td>
                        <td><?= $venta["name"] ?></td>
                        <td><?= $venta["total"] ?></td>
                        <td><?= $venta["employee_id"] ?></td>
                    </tr>
                    <?php
                        $idVenta = $venta["id"];
                    endif; 
                    ?>
                    <tr>
                        <td colspan="2"><?= $venta["title"] ?></td>
                        <td><?= $venta["quantity"] ?></td>
                        <td><?= $venta["price"] ?></td>
                        <td><?= ($venta["quantity"] * $venta["price"]) ?></td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>