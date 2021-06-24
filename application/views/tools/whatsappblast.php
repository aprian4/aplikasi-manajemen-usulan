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

                    <?= $this->session->flashdata('wa'); ?>

                    <?php $this->session->unset_userdata('wa'); ?>
                    <div class="card-body">
                        <form method="POST" action="<?= base_url('whatsapp/crud_blast'); ?>">
                            <div class="form-group">
                                <label for="forIsi">Isi Pesan</label>
                                <textarea name="isi" class="form-control" id="forIsi" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="forKirim">Dikirim ke</label>
                                <select name="jenis_kirim" class="form-control" id="forKirim">
                                    <option value="all" selected>-- Semua PNS se-Tangsel --</option>
                                    <?php foreach ($opd as $op) : ?>
                                        <option value="<?= $op['opd']; ?>"><?= $op['opd']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary"> Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>