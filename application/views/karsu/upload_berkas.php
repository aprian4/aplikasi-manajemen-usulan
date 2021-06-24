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
                    <a href="<?= base_url('karsu/detail_karsu/' . $id_usulan); ?>">
                        <i class="fas fa-arrow-circle-left fa-sm"></i> Kembali</a>
                </div><br>
                <div class="card author-box card-light">
                    <div class="card-header">
                        <center>
                            <h4><?= "Upload Berkas Persyaratan " . $title; ?></h4>
                        </center>
                    </div>
                    <?= $this->session->flashdata('upload'); ?>
                    <div class="card-body">

                        <table class="table table-striped dt-responsive" id="table-1" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="col-name" style="width: 5%;">#</th>
                                    <th style="width: 52%;">Nama Dokumen</th>
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
                                    <td><label class="col-sm-12 col-md-12">Surat Pengantar/ Usulan dari Instansi <br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                    <td>

                                        <?php if ($berkas_sp != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_sp['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas1"><i class="fas fa-times-circle"></i> Batal</button>
                                            <!-- Modal -->
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                <div class="modal fade" id="hapusBerkas1" tabindex="-1" aria-labelledby="hapusBerkas1Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusBerkas1Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                            <input type="text" name="id_berkas" value="<?= $berkas_sp['id']; ?>" hidden>
                                                            <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                            <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                            <input type='text' name='path' value="<?= $berkas_sp['path']; ?>" hidden>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Ya</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } else { ?>
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/suratpengantar'); ?>' enctype='multipart/form-data'>
                                                <input type='file' name='file'>
                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                            <?php } ?>
                                            </form>
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
                                    <td><label class="col-sm-12 col-md-12">Laporan Perkawinan Pertama/Duda (Lampiran IB SE 08/1983)<br><b> (Max. Ukuran File 2MB dan Format File .pdf)</td>
                                    <td>
                                        <?php if ($berkas_lapkawin != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_lapkawin['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas2"><i class="fas fa-times-circle"></i> Batal</button>
                                            <!-- Modal -->
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                <div class="modal fade" id="hapusBerkas2" tabindex="-1" aria-labelledby="hapusBerkas2Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusBerkas2Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                            <input type="text" name="id_berkas" value="<?= $berkas_lapkawin['id']; ?>" hidden>
                                                            <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                            <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                            <input type='text' name='path' value="<?= $berkas_lapkawin['path']; ?>" hidden>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Ya</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } else { ?>
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/lapkawin'); ?>' enctype='multipart/form-data'>
                                                <input type='file' name='file'>
                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                            <?php } ?>
                                            </form>
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
                                    <td><label class="col-sm-12 col-md-12">Daftar Keluarga PNS (Lampiran XXVI SE 08/1983) <br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                    <td>
                                        <?php if ($berkas_keluarga != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_keluarga['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas3"><i class="fas fa-times-circle"></i> Batal</button>
                                            <!-- Modal -->
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                <div class="modal fade" id="hapusBerkas3" tabindex="-1" aria-labelledby="hapusBerkas3Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusBerkas3Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                            <input type="text" name="id_berkas" value="<?= $berkas_keluarga['id']; ?>" hidden>
                                                            <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                            <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                            <input type='text' name='path' value="<?= $berkas_keluarga['path']; ?>" hidden>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Ya</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } else { ?>
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/keluarga'); ?>' enctype='multipart/form-data'>
                                                <input type='file' name='file'>
                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                            <?php } ?>
                                            </form>
                                    </td>
                                </tr>

                                <?php if ($usulan['jenis_usulan'] == "karsu_baru") { ?>
                                    <tr>
                                        <td>
                                            <?php if ($berkas_kematian != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12">Fotocopy sah surat kematian/akta cerai<br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                        <td>
                                            <?php if ($berkas_kematian != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_kematian['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas4"><i class="fas fa-times-circle"></i> Batal</button>
                                                <!-- Modal -->
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                    <div class="modal fade" id="hapusBerkas4" tabindex="-1" aria-labelledby="hapusBerkas4Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusBerkas4Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                                <input type="text" name="id_berkas" value="<?= $berkas_kematian['id']; ?>" hidden>
                                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                                <input type='text' name='path' value="<?= $berkas_kematian['path']; ?>" hidden>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            <?php } else { ?>
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/kematian'); ?>' enctype='multipart/form-data'>
                                                    <input type='file' name='file'>
                                                    <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                    <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                    <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                    <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                                <?php } ?>
                                                </form>
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
                                    <td><label class="col-sm-12 col-md-12">Fotocopy sah surat nikah<br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                    <td>
                                        <?php if ($berkas_suratnikah != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_suratnikah['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas4"><i class="fas fa-times-circle"></i> Batal</button>
                                            <!-- Modal -->
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                <div class="modal fade" id="hapusBerkas4" tabindex="-1" aria-labelledby="hapusBerkas4Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusBerkas4Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                            <input type="text" name="id_berkas" value="<?= $berkas_suratnikah['id']; ?>" hidden>
                                                            <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                            <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                            <input type='text' name='path' value="<?= $berkas_suratnikah['path']; ?>" hidden>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Ya</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php } else { ?>
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/suratnikah'); ?>' enctype='multipart/form-data'>
                                                <input type='file' name='file'>
                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                            <?php } ?>
                                            </form>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <?php if ($berkas_fotosuami != null) { ?>
                                            <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                        <?php } else { ?>
                                            <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                        <?php } ?>
                                    </td>
                                    <td><label class="col-sm-12 col-md-12">Pas foto suami hitam putih ukuran 3x4 cm <br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                    <td>
                                        <?php if ($berkas_fotosuami != null) { ?>
                                            <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_fotosuami['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas5"><i class="fas fa-times-circle"></i> Batal</button>
                                            <!-- Modal -->
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                <div class="modal fade" id="hapusBerkas5" tabindex="-1" aria-labelledby="hapusBerkas5Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="hapusBerkas5Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                            <input type="text" name="id_berkas" value="<?= $berkas_fotosuami['id']; ?>" hidden>
                                                            <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                            <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                            <input type='text' name='path' value="<?= $berkas_fotosuami['path']; ?>" hidden>
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-danger">Ya</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form><?php } else { ?>
                                            <form method='post' action='<?php echo base_url('karsu/crud_upload/fotosuami'); ?>' enctype='multipart/form-data'>
                                                <input type='file' name='file'>
                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                            <?php } ?>
                                            </form>
                                    </td>
                                </tr>

                                <?php if ($usulan['jenis_usulan'] == "karsu_pengganti") { ?>

                                    <tr>
                                        <td>
                                            <?php if ($berkas_lampiranxxx != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12">Lampiran XXX (SE Kepala BAKN No.08/SE/1983)<br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                        <td>
                                            <?php if ($berkas_lampiranxxx != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_lampiranxxx['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas6"><i class="fas fa-times-circle"></i> Batal</button>
                                                <!-- Modal -->
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                    <div class="modal fade" id="hapusBerkas6" tabindex="-1" aria-labelledby="hapusBerkas6Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusBerkas6Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                                <input type="text" name="id_berkas" value="<?= $berkas_lampiranxxx['id']; ?>" hidden>
                                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                                <input type='text' name='path' value="<?= $berkas_lampiranxxx['path']; ?>" hidden>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form><?php } else { ?>
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/lampiranxxx'); ?>' enctype='multipart/form-data'>
                                                    <input type='file' name='file'>
                                                    <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                    <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                    <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                    <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                                <?php } ?>
                                                </form>
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
                                        <td><label class="col-sm-12 col-md-12">Lampiran XXXI (SE Kepala BAKN No.08/SE/1983)<br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                        <td>
                                            <?php if ($berkas_lampiranxxxi != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_lampiranxxxi['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas7"><i class="fas fa-times-circle"></i> Batal</button>
                                                <!-- Modal -->
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                    <div class="modal fade" id="hapusBerkas7" tabindex="-1" aria-labelledby="hapusBerkas7Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusBerkas7Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                                <input type="text" name="id_berkas" value="<?= $berkas_lampiranxxxi['id']; ?>" hidden>
                                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                                <input type='text' name='path' value="<?= $berkas_lampiranxxxi['path']; ?>" hidden>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form><?php } else { ?>
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/lampiranxxxi'); ?>' enctype='multipart/form-data'>
                                                    <input type='file' name='file'>
                                                    <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                    <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                    <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                    <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                                <?php } ?>
                                                </form>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <?php if ($berkas_kehilangankarsu != null) { ?>
                                                <i style="color: green; font-size: 30px;" class="fas fa-check-circle fa-sm"></i>
                                            <?php } else { ?>
                                                <i style="color: red; font-size: 30px;" class="fas fa-times-circle fa-sm"></i>
                                            <?php } ?>
                                        </td>
                                        <td><label class="col-sm-12 col-md-12">Surat Kehilangan dari Kepolisian<br><b> (Max. Ukuran File 2MB dan Format File .pdf)</b></label></td>
                                        <td>
                                            <?php if ($berkas_kehilangankarsu != null) { ?>
                                                <a style="color:#fff" target="_blank" class="lihat btn btn-success btn-sm" href="<?= base_url($berkas_kehilangankarsu['path']); ?>" role="button"><i class="fas fa-eye"></i> Lihat</a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusBerkas8"><i class="fas fa-times-circle"></i> Batal</button>
                                                <!-- Modal -->
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/hapus'); ?>'>
                                                    <div class="modal fade" id="hapusBerkas8" tabindex="-1" aria-labelledby="hapusBerkas8Label" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="hapusBerkas8Label">Apakah Anda Yakin Menghapus Berkas Ini?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                                <input type="text" name="id_berkas" value="<?= $berkas_kehilangankarsu['id']; ?>" hidden>
                                                                <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                                <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                                <input type='text' name='path' value="<?= $berkas_kehilangankarsu['path']; ?>" hidden>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Ya</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form><?php } else { ?>
                                                <form method='post' action='<?php echo base_url('karsu/crud_upload/kehilangankarsu'); ?>' enctype='multipart/form-data'>
                                                    <input type='file' name='file'>
                                                    <input type="text" name="jenis_usulan" value="<?= $usulan['jenis_usulan']; ?>" hidden>
                                                    <input type='text' name='nip' value="<?= $nip; ?>" hidden>
                                                    <input type='text' name='id_usulan' value="<?= $id_usulan; ?>" hidden>
                                                    <input type='submit' class="btn btn-primary" value='Upload' name='upload' />
                                                </form>
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