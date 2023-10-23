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
                            <?php if(!empty($mensaje)){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= $mensaje ?>
                                </div>
                            <?php } ?>
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
                            <?php if(session("error")){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session("error") ?>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label for="customer">Seleccione el cliente</label>
                                <select class="js-example-basic-single form-control" name="customer" id="selectCustomer" onchange="selectCustomer()">
                                </select>
                            </div>
                            <hr>
                            <form class="form" action="<?= base_url('/venta')?>" method="post">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="customer">Seleccione el producto</label>
                                            <select class="js-example-basic-single form-control" name="product" id="selectProduct">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <div class="form-group">
                                            <label for="quantity">Indique la cantidad</label>
                                            <input type="number" name="quantity" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 pt-4">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </div>
                            </form>

                            <div class="row">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Descripcion</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Importe</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($carrito as $row):
                                            $num++;
                                            $total += ($row['quantity'] * $row['price']);
                                        ?>
                                        <tr>
                                            <td><?= $num ?></td>
                                            <td><?= $row['description'] ?></td>
                                            <td><?= $row['quantity'] ?></td>
                                            <td><?= $row['price'] ?></td>
                                            <td><?= ($row['quantity'] * $row['price'])?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>Total =></td>
                                            <td><?= $total ?></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2" class="text-right">
                                                <a href="<?= base_url('/sales/cancel') ?>" class="btn btn-danger">Cancelar venta</a>
                                                <form action="<?= base_url('/sales/confirm') ?>" method="post">
                                                    <input type="hidden" name="customer_id" id="customer_id">
                                                    <input type="hidden" name="total" value="<?= $total ?>">
                                                    <button type="submit" class="btn btn-primary">Generar venta</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?= base_url('assets/js/sales.js')?>"></script>
<?= $this->include("layout/footer") ?>
