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
                            <?php if(session("error")){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= session("error") ?>
                                </div>
                            <?php } ?>

                            <?php if(session("errors")){ ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php foreach (session("errors") as $error){?>
                                        <li><?= $error ?></li>
                                    <?php } ?>
                                </div>
                            <?php } ?>

                            <form action="<?= base_url("/productos")?>" method="POST">
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="id" value="<?= $producto["id"] ?>">
                                <div class="row">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="">Código</label>
                                        <input type="text" class="form-control form-control-user" name="code" placeholder="Ingrese el código del producto" value="<?= $producto["code"] ?>">
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="">Titulo</label>
                                        <input type="text" class="form-control form-control-user" name="title" placeholder="Ingrese el titulo del producto" value="<?= $producto["title"] ?>">
                                    </div>
                                    <div class="form-group col-12 col-md-8">
                                        <label for="">Descripción</label>
                                        <input type="text" class="form-control form-control-user" name="description" placeholder="Ingrese la descripción del producto" value="<?= $producto["description"] ?>">
                                    </div>
                                    <div class="form-group col-12 col-md-2">
                                        <label for="">Precio</label>
                                        <input type="number" class="form-control form-control-user" name="price" placeholder="Ingrese el precio del producto" value="<?= $producto["price"] ?>">
                                    </div>
                                    <div class="form-group col-12 col-md-2">
                                        <label for="">Existencia</label>
                                        <input type="number" class="form-control form-control-user" name="quantity" placeholder="Ingrese la existencia del producto" value="<?= $producto["quantity"]?>">
                                    </div>
                                </div>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include("layout/footer") ?>