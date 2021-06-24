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
                        <div class="container justify-content-center">
                            <form action="<?= base_url('laporan'); ?>" method="POST">
                                <div class="form-group row">
                                    <label class="col-sm-2 text-right">Jenis Layanan</label>
                                    <select id="layanan" class="col-sm-4 custom-select" name='layanan'>
                                        <option value="all" selected>-- Semua --</option>
                                        <option id="karpeg" value="karpeg">Kartu Pegawai (KARPEG)</option>
                                        <option id="karsu" value="karsu">Kartu Suami (KARSU)</option>
                                        <option id="karis" value="karis">Kartu Istri (KARIS)</option>
                                        <option id="idcard" value="idcard">Kartu Tanda Pengenal (ID CARD)</option>
                                        <option id="cuti" value="cuti">Cuti</option>
                                    </select>
                                    <label class="col-sm-2 text-right">Jenis Usulan</label>
                                    <select class="custom-select col-sm-4" name='jenis_usulan'>
                                        <option value="all" selected>-- Semua --</option>
                                        <option id="karpeg_baru" value="karpeg_baru">Baru</option>
                                        <option id="karpeg_pengganti" value="karpeg_pengganti">Pengganti Karena Hilang</option>
                                        <option id="karis_baru" value="karis_baru">Baru</option>
                                        <option id="karis_pengganti" value="karis_pengganti">Pengganti Karena Hilang</option>
                                        <option id="karsu_baru" value="karsu_baru">Baru</option>
                                        <option id="karsu_pengganti" value="karsu_pengganti">Pengganti Karena Hilang</option>
                                        <option id="idcard_baru" value="idcard_baru">Baru</option>
                                        <option id="idcard_pengganti" value="idcard_pengganti">Pengganti Karena Hilang</option>
                                        <option id="cuti_besar" value="cuti_besar">Cuti Besar</option>
                                        <option id="cuti_tahunan" value="cuti_tahunan">Cuti Tahunan Eselon II</option>
                                        <option id="cuti_penting" value="cuti_penting">Cuti Karena Alasan Penting</option>
                                        <option id="cltn" value="cltn">Cuti di Luar Tanggungan Negara</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 text-right">Status Usulan</label>
                                    <select class="custom-select col-sm-4" name='status_usulan'>
                                        <option value="all" selected>-- Semua --</option>
                                        <option value="1">Draft</option>
                                        <option value="2">Proses</option>
                                        <option value="3">BKPP</option>
                                        <option value="4">Selesai</option>
                                    </select>
                                    <label class="col-sm-2 text-right">OPD</label>
                                    <select class="custom-select col-sm-4" name='opd'>
                                        <option value="all" selected>-- Semua --</option>
                                        <?php foreach ($opd as $op) : ?>

                                            <option value="<?= $op['opd']; ?>"><?= $op['opd']; ?></option>

                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 text-right">Tanggal Awal</label>
                                    <input type="date" class="form-control col-sm-4" name="tgl_awal">
                                    <label class="col-sm-2 text-right">Tanggal Akhir</label>
                                    <input type="date" class="form-control col-sm-4" name="tgl_akhir">
                                </div>
                                <div class="form-group text-center col-sm-12">
                                    <button type="submit" class="btn btn-warning" style="width: 50%;"><i class="fas fa-search"> Filter</i></button>
                                </div>
                            </form>
                        </div><br><br>
                        <hr>

                        <table id="table-laporan" style="font-size: 12px;" class="table display table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Kode Usulan</th>
                                    <th scope="col">Jenis Usulan</th>
                                    <th scope="col">Tanggal Usulan</th>
                                    <th scope="col">Nomor Surat</th>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama Lengkap</th>
                                    <th scope="col">OPD</th>
                                    <th scope="col">Status Usulan</th>
                                    <th scope="col">Nomor Kartu</th>
                                    <th scope="col">Nomor Keputusan</th>
                                    <th scope="col">Tanggal Terbit</th>
                                    <th scope="col">Diambil Oleh</th>
                                    <th scope="col">Diambil Tanggal</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($laporan as $lap) : ?>
                                    <tr>
                                        <td><?= $lap['kode_usulan']; ?></td>
                                        <td>
                                            <?php if ($lap['jenis_usulan'] == 'idcard_baru') {
                                                echo "Id Card (Baru)";
                                            } else if ($lap['jenis_usulan'] == 'idcard_pengganti') {
                                                echo "Id Card (Pengganti)";
                                            } else if ($lap['jenis_usulan'] == 'karpeg_baru') {
                                                echo "Kartu Pegawai (Baru)";
                                            } else if ($lap['jenis_usulan'] == 'karpeg_pengganti') {
                                                echo "Kartu Pegawai (Pengganti)";
                                            } else if ($lap['jenis_usulan'] == 'karis_baru') {
                                                echo "Kartu Istri (Baru)";
                                            } else if ($lap['jenis_usulan'] == 'karis_pengganti') {
                                                echo "Kartu Istri (Pengganti)";
                                            } else if ($lap['jenis_usulan'] == 'karsu_baru') {
                                                echo "Kartu Suami (Baru)";
                                            } else if ($lap['jenis_usulan'] == 'karsu_pengganti') {
                                                echo "Kartu Suami (Pengganti)";
                                            } else {
                                                echo "-";
                                            }  ?>
                                        </td>
                                        <td><?= $lap['tgl_usulan']; ?></td>
                                        <td><?= $lap['no_surat']; ?></td>
                                        <td><?= substr($lap['nip'], 0, 15) . ' ' . substr($lap['nip'], 15, 19); ?></td>
                                        <td><?= $lap['nama_lengkap']; ?></td>
                                        <td><?= ucwords(strtolower($lap['opd'])); ?></td>
                                        <td>
                                            <?php if ($lap['status_usulan'] == 1) {
                                                echo "Draft";
                                            } else  if ($lap['status_usulan'] == 2) {
                                                echo "Proses BKN";
                                            } else if (($lap['status_usulan'] == 3) && ($lap['status_kartu'] == 2 || $lap['posisi'] == 2)) {
                                                echo "Selesai";
                                            } else {
                                                echo "BKPP";
                                            } ?>
                                        </td>
                                        <td><?= ($lap['no_kartu']) ? $lap['no_kartu'] : "-"; ?></td>
                                        <td><?= ($lap['no_keputusan']) ? $lap['no_keputusan'] : "-"; ?></td>
                                        <td><?= ($lap['tgl_terbit']) ? $lap['tgl_terbit'] : "-"; ?></td>
                                        <td><?= ($lap['diambil_oleh']) ? $lap['diambil_oleh'] : "-"; ?></td>
                                        <td><?= ($lap['tgl_diambil']) ? $lap['tgl_diambil'] : "-"; ?></td>
                                        <td><?= ($lap['keterangan']) ? $lap['keterangan'] : "-"; ?></td>
                                    </tr>
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