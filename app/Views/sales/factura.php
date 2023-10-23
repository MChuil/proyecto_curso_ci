<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body{
            font-family:'Courier New', Courier, monospace;
        }
        table thead{
            background-color: black;
            color: #fff;
        }
        .text-end{
            text-align: right;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td>
                Nombre de la Empresa <br>
                Domicilio <br>
                Telefono
        </td>
            <td>
                <h1>Factura #<?= $factura ?></h1>
                Fecha: 
            </td>
        </tr>
    </table>
    <p>Cliente: <?= $cliente ?></p>
    <table width="100%">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($carrito as $row): ?>
            <tr>
                <td><?= $row['description'] ?> <br>Código: <?= $row['code'] ?></td>
                <td class="text-center"><?= $row['quantity'] ?></td>
                <td class="text-end"><?= number_format($row['price'],2) ?></td>
                <td class="text-end"><?= number_format(($row['quantity'] * $row['price']), 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th class="text-end">Total=></th>
                <th class="text-end"><?= number_format($total, 2) ?></th>
            </tr>
        </tfoot>
    </table>
</body>
</html>