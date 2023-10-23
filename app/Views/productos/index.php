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
                            <div class="text-right">
                                <a href="<?= base_url("/productos/nuevo")?>" class="btn btn-primary mb-5">Nuevo producto</a>
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
                                        <th>Codigo</th>
                                        <th>Titulo</th>
                                        <th>Descripcion</th>
                                        <th>Precio</th>
                                        <th>Existencia</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($productos as $row) { ?>
                                        <tr>
                                            <td><?= $row["code"]?></td>
                                            <td><?= $row["title"]?></td>
                                            <td><?= $row["description"]?></td>
                                            <td><?= $row["price"]?></td>
                                            <td><?= $row["quantity"]?></td>
                                            <td>
                                                <a href="<?= base_url("productos/{$row['id']}/editar") ?>" class="btn btn-primary">Editar</a>
                                                <form action="<?= base_url("/productos/{$row['id']}") ?>" method="POST">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->include("layout/footer") ?>
