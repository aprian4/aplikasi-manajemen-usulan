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
                <div>
                    <a href="<?= base_url('karis/riwayat/' . $id_usulan); ?>">
                        <i class="fas fa-arrow-circle-left fa-sm"></i> Kembali</a>
                </div><br>
                <div class="card author-box card-light">
                    <div class="card-header">
                        <center>
                            <h4><?= "Berkas Persyaratan " . $title; ?></h4>
                        </center>
                    </div>
                    <?= $this->session->flashdata('upload'); ?>
                    <div class="card-body">

                        <table class="table table-striped dt-responsive" id="table-1" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-name" style="width: 5%;">#</th>
                                    <th style="width: 80%;">Nama Dokumen</th>
                                    <th class="col-name">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php if ($berkas_sp != null) { ?>
                                            <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                        <?php } else { ?>
                                            <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                        <?php } ?>
                                    </td>
                                    <td><label class="col-sm-12 col-md-12">Surat Pengantar/ Usulan dari Instansi <br></label></td>
                                    <td>
                                        <?php if ($berkas_sp != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_sp['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php if ($berkas_lapkawin != null) { ?>
                                            <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                        <?php } else { ?>
                                            <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                        <?php } ?>
                                    </td>
                                    <td><label class="col-sm-12 col-md-12">Laporan Perkawinan Pertama/Duda (Lampiran IB SE 08/1983)<br></td>
                                    <td>
                                        <?php if ($berkas_lapkawin != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_lapkawin['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>

                                        <?php } ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php if ($berkas_keluarga != null) { ?>
                                            <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                        <?php } else { ?>
                                            <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                        <?php } ?>
                                    </td>
                                    <td><label class="col-sm-12 col-md-12">Daftar Keluarga PNS (Lampiran XXVI SE 08/1983) <br></b></label></td>
                                    <td>
                                        <?php if ($berkas_keluarga != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_keluarga['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>

                                        <?php } ?>

                                    </td>
                                </tr>
                                <?php if ($usulan['jenis_usulan'] == "karis_baru") { ?>
                                    <tr>
                                        <td>
                                            <?php if ($berkas_kematian != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12"> Fotocopy sah surat kematian/akta ceraibr></b></label></td>
                                        <td>
                                            <?php if ($berkas_kematian != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_kematian['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>

                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php }; ?>
                                <tr>
                                    <td>
                                        <?php if ($berkas_suratnikah != null) { ?>
                                            <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                        <?php } else { ?>
                                            <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                        <?php } ?>
                                    </td>
                                    <td><label class="col-sm-12 col-md-12"> Fotocopy sah surat nikah<br></b></label></td>
                                    <td>
                                        <?php if ($berkas_suratnikah != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_suratnikah['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>

                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <?php if ($berkas_fotoistri != null) { ?>
                                            <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                        <?php } else { ?>
                                            <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                        <?php } ?>
                                    </td>
                                    <td><label class="col-sm-12 col-md-12">Pas foto istri hitam putih ukuran 3x4 cm <br></b></label></td>
                                    <td>
                                        <?php if ($berkas_fotoistri != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_fotoistri['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                        <?php } ?>
                                    </td>
                                </tr>

                                <?php if ($usulan['jenis_usulan'] == "karis_pengganti") { ?>

                                    <tr>
                                        <td>
                                            <?php if ($berkas_lampiranxxx != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12">Lampiran XXX (SE Kepala BAKN No.08/SE/1983)<br></b></label></td>
                                        <td>
                                            <?php if ($berkas_lampiranxxx != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_lampiranxxx['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php if ($berkas_lampiranxxxi != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12">Lampiran XXXI (SE Kepala BAKN No.08/SE/1983)<br></b></label></td>
                                        <td>
                                            <?php if ($berkas_lampiranxxxi != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_lampiranxxxi['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <?php }  ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php if ($berkas_kehilangankaris != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12">Surat Kehilangan dari Kepolisian<br></b></label></td>
                                        <td>
                                            <?php if ($berkas_kehilangankaris != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_kehilangankaris['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>