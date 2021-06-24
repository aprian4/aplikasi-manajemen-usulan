<?= $this->session->unset_userdata('message'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                </div><!-- /.col -->

            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card author-box card-light">
                    <div class="card-header">
                        <center>
                            <h4><?= $title; ?></h4>
                        </center>
                    </div>
                    <div class="card-body">

                        <table id="table-profilpns" style="font-size: 12px;" class="table display table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">OPD</th>
                                    <th scope="col">Nomor HP</th>
                                    <th scope="col">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php foreach ($profile_pegawai as $lap) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $lap['nip']; ?></td>
                                        <td><?= $lap['nama_lengkap']; ?></td>
                                        <td><?= $lap['opd']; ?></td>
                                        <td><?= $lap['hp']; ?></td>
                                        <td><?= $lap['email']; ?></td>
                                    </tr>
                                    <?php $no++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>