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
                            <table width="100%" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Direción</th>
                                        <th>Telefono</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($proveedores as $row) { ?>
                                        <tr>
                                            <td><?= $row["id"]?></td>
                                            <td><?= $row["name"]?></td>
                                            <td><?= $row["address"]?></td>
                                            <td><?= $row["phone"]?></td>
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