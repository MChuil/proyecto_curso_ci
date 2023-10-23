<?= $this->include("layout/header") ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        
        <!-- Aqui va el sidebar -->
        <?= $this->include("layout/partials/sidebar") ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Aqui va el topbar -->
                <?= $this->include("layout/partials/topbar") ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
                    </div>
                    <div class="card shadow">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary"><?= $title ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="text-left">
                                <form action="<?= base_url("/venta/reporte")?>" method="post" class="row">
                                    <div class="form-group col-12 col-md-3">
                                        <label for="date">Seleccione la fecha</label>
                                        <input type="date" name="date" class="form-control">
                                    </div>
                                    <div class="form-group col-12 col-md-3 pt-4">
                                        <button type="submit" class="btn btn-info">Buscar</button>
                                    </div>
                                </form>
                            </div>
                            <?php if(session("success")){ ?>
                                <div class="alert alert-success" role="alert">
                                    <?= session("success") ?>
                                </div>
                            <?php } ?>
                            <?php if(session("warning")){ ?>
                                <div class="alert alert-warning" role="alert">
                                    <?= session("warning") ?>
                                </div>
                            <?php } ?>
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
                            <a href="<?= base_url("/venta/pdf")?>" class="btn btn-success">Imprimir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include("layout/footer") ?>
