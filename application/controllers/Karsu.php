<?php

use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('No direct script access allowed');

class Karsu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ngambil dari fungsi yang di helper
        is_logged_admin_user();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function home()
    {


        $data['usulan'] = $this->db->where('rec_active', 1)->order_by('created_at', 'DESC')->get('usulan')->result_array();
        $data['detail_usulan'] = $this->db->get_where('detail_usulan', ['rec_active' => 1])->result_array();
        //print_r($data['usulan']);
        $data['title'] = 'Kartu Suami';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $data['profile_pegawai'] = $this->db->get('profile_pegawai')->result_array();

        $data['tabel_user'] = $this->db->get('user')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karsu/home', $data);
        $this->load->view('templates/footer');
    }


    public function detail_karsu($id)
    {

        $data['pegawai'] = $this->db->get('profile_pegawai')->result_array();
        $data['usulan'] = $this->db->where('rec_active', 1)->where('id', $id)->get('usulan')->row_array();
        $data['title'] = 'Kartu Suami';

        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $data['tabel_user'] = $this->db->get('user')->result_array();
        $data['detail_usulan'] = $this->db->get_where('detail_usulan', ['kode_usulan' => $data['usulan']['kode_usulan']])->result_array();
        $data['profile_pegawai'] = $this->db->get('profile_pegawai')->result_array();
        $data['berkas'] = $this->db->get('berkas')->result_array();
        $berkas_perusulan = $this->db->get('berkas')->result_array();

        foreach ($data['detail_usulan'] as $lu) {
            $berkas4 = null;
            if ($data['usulan']['jenis_usulan'] == "karsu_baru") {
                $berkas1 = "PENGANTAR_KARSU_BARU_" . $lu['nip'];
                $berkas4 = 'KEMATIAN_' . $lu['nip'];
            } else if ($data['usulan']['jenis_usulan'] == "karsu_pengganti") {
                $berkas1 = "PENGANTAR_KARSU_PENGGANTI_" . $lu['nip'];
                $berkas6 = 'LAMPIRAN_XXX_KARSU_' . $lu['nip'];
                $berkas7 = 'LAMPIRAN_XXXI_KARSU_' . $lu['nip'];
                $berkas8 = 'KEHILANGAN_KARSU_' . $lu['nip'];
            }
            $berkas2 = 'SK_LAP_KAWIN_' . $lu['nip'];
            $berkas3 = 'KELUARGA_' . $lu['nip'];
            $berkas5 = 'FOTO_SUAMI_' . $lu['nip'];
            $berkas9 = "SURAT_NIKAH_" . $lu['nip'];

            $sb1 = null;
            $sb2 = null;
            $sb3 = null;
            $sb4 = null;
            $sb5 = null;
            $sb6 = null;
            $sb7 = null;
            $sb8 = null;
            $sb9 = null;

            foreach ($berkas_perusulan as $bks) {
                if ($bks['nama_berkas'] == $berkas1) {
                    $sb1 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas2) {
                    $sb2 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas3) {
                    $sb3 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas4) {
                    $sb4 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas5) {
                    $sb5 = "Lengkap";
                }

                if ($bks['nama_berkas'] == $berkas9) {
                    $sb9 = "Lengkap";
                }

                if ($data['usulan']['jenis_usulan'] == "karsu_pengganti") {
                    if ($bks['nama_berkas'] == $berkas6) {
                        $sb6 = "Lengkap";
                    }
                    if ($bks['nama_berkas'] == $berkas7) {
                        $sb7 = "Lengkap";
                    }
                    if ($bks['nama_berkas'] == $berkas8) {
                        $sb8 = "Lengkap";
                    }
                }
            }

            if ($data['usulan']['jenis_usulan'] == "karsu_baru") {
                if (($sb1 == "Lengkap") && ($sb2 == "Lengkap") && ($sb3 == "Lengkap") && ($sb4 == "Lengkap") && ($sb5 == "Lengkap") && ($sb9 == "Lengkap")) {
                    $data1 = [
                        'status_berkas' => 1
                    ];
                    $this->db->update('detail_usulan', $data1, ['nip' => $lu['nip']]);
                } else {
                    $data2 = [
                        'status_berkas' => 0
                    ];
                    $this->db->update('detail_usulan', $data2, ['nip' => $lu['nip']]);
                }
            } else {
                if (($sb1 == "Lengkap") && ($sb2 == "Lengkap") && ($sb3 == "Lengkap") && ($sb5 == "Lengkap") && ($sb6 == "Lengkap") && ($sb7 == "Lengkap") && ($sb8 == "Lengkap") && ($sb9 == "Lengkap")) {
                    $data1 = [
                        'status_berkas' => 1
                    ];
                    $this->db->update('detail_usulan', $data1, ['nip' => $lu['nip']]);
                } else {
                    $data2 = [
                        'status_berkas' => 0
                    ];
                    $this->db->update('detail_usulan', $data2, ['nip' => $lu['nip']]);
                }
            }
        }


        //var_dump($data['logs_usulan']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karsu/detail_karsu', $data);
        $this->load->view('templates/footer');
    }

    public function riwayat($id)
    {

        $data['usulan'] = $this->db->where('rec_active', 1)->where('id', $id)->get('usulan')->row_array();
        $data['title'] = 'Kartu Suami';

        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $data['tabel_user'] = $this->db->get('user')->result_array();
        $data['detail_usulan'] = $this->db->get_where('detail_usulan', ['kode_usulan' => $data['usulan']['kode_usulan']])->result_array();
        $data['profile_pegawai'] = $this->db->get('profile_pegawai')->result_array();
        $data['berkas'] = $this->db->get_where('berkas', ['id_usulan' => $id])->result_array();

        //var_dump($data['logs_usulan']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karsu/riwayat', $data);
        $this->load->view('templates/footer');
    }

    public function riwayat_berkas($nip = null, $id_usulan = null, $jenis_usulan = null)
    {

        $data['nip'] = $nip;
        $data['id_usulan'] = $id_usulan;
        $data['title'] = 'Kartu Suami';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();

        $namaberkas_sp = null;
        $namaberkas_kematian = null;
        $namaberkas_lampiranxxx = null;
        $namaberkas_lampiranxxxi = null;
        $namaberkas_kehilangankarsu = null;

        if ($jenis_usulan == "karsu_baru") {
            $namaberkas_sp = "PENGANTAR_KARSU_BARU_" . $nip;
            $namaberkas_kematian = "KEMATIAN_" . $nip;
        } else if ($jenis_usulan == "karsu_pengganti") {
            $namaberkas_sp = "PENGANTAR_KARSU_PENGGANTI_" . $nip;
            $namaberkas_lampiranxxx = "LAMPIRAN_XXX_KARSU_" . $nip;
            $namaberkas_lampiranxxxi = "LAMPIRAN_XXXI_KARSU_" . $nip;
            $namaberkas_kehilangankarsu = "KEHILANGAN_KARSU_" . $nip;

            $data['berkas_lampiranxxx'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_lampiranxxx])->row_array();
            $data['berkas_lampiranxxxi'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_lampiranxxxi])->row_array();
            $data['berkas_kehilangankarsu'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_kehilangankarsu])->row_array();
        }
        $namaberkas_suratnikah = "SURAT_NIKAH_" . $nip;
        $namaberkas_lapkawin = "SK_LAP_KAWIN_" . $nip;
        $namaberkas_keluarga = "KELUARGA_" . $nip;
        $namaberkas_fotoSUAMI = "FOTO_SUAMI_" . $nip;



        $data['berkas_sp'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_sp, 'jenis_berkas' => $jenis_usulan])->row_array();
        $data['berkas_suratnikah'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_suratnikah, 'jenis_berkas' => $jenis_usulan])->row_array();
        $data['berkas_keluarga'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_keluarga])->row_array();
        $data['berkas_lapkawin'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_lapkawin])->row_array();
        $data['berkas_kematian'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_kematian])->row_array();
        $data['berkas_fotosuami'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_fotoSUAMI])->row_array();

        $data['tabel_user'] = $this->db->get('user')->result_array();


        $data['usulan'] = $this->db->where('rec_active', 1)->where('id', $data['id_usulan'])->get('usulan')->row_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karsu/riwayat_berkas', $data);
        $this->load->view('templates/footer');
    }

    public function crud_usulan_karsu($aksi)
    {

        if ($aksi == 'tambah') {

            $this->load->model('Usulan_model', 'usulan');
            $Kode = $this->usulan->getKodeMax();
            if (!empty($Kode['kodeTerbesar'])) {
                $urutan = (int) substr($Kode['kodeTerbesar'], -4);
                $urutan++;
            } else {
                $urutan = 1;
            }

            $huruf = "KRU" . date('Y');
            $kodeUsulan = $huruf . sprintf("%04s", $urutan);

            $username = $this->session->userdata('username');
            $created_by = $this->db->get_where('user', ['username' => $username])->row_array();

            $data = [
                'id_user' => $this->input->post('id'),
                'kode_usulan' => $kodeUsulan,
                'tgl_usulan' => $this->input->post('tgl_usulan'),
                'no_surat' => $this->input->post('no_surat'),
                'jenis_usulan' => $this->input->post('jenis_usulan'),
                'created_by' => $created_by['nama_user'],
            ];
            if ($this->db->insert('usulan', $data)) {
                echo "ok";
            } else {
                echo "gagal";
            }

            $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Usulan berhasil ditambahkan!</div>');
        }

        if ($aksi == 'hapus') {
            $username = $this->session->userdata('username');
            $updated_by = $this->db->get_where('user', ['username' => $username])->row_array();
            $time = date('Y-m-d H:i:s');

            $data = [
                'updated_at' => $time,
                'updated_by' => $updated_by['nama_user'],
                'rec_active' => 0,
            ];

            $data2 = [
                'updated_at' => $time,
                'updated_by' => $updated_by['nama_user'],
                'rec_active' => 0,
            ];
            if ($this->db->update('usulan', $data, array('id' => $this->input->post('id_usulan')))) {
                $this->db->update('detail_usulan', $data2, array('kode_usulan' => $this->input->post('kode_usulan')));
                $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Usulan berhasil dihapus!</div>');
                redirect(base_url('karsu/home'));
            }
        }

        if ($aksi == 'ubah') {
            $username = $this->session->userdata('username');
            $updated_by = $this->db->get_where('user', ['username' => $username])->row_array();
            $time = date('Y-m-d H:i:s');

            $data = [
                'tgl_usulan' => $this->input->post('tgl_usulan'),
                'no_surat' => $this->input->post('no_surat'),
                'jenis_usulan' => $this->input->post('jenis_usulan'),
                'updated_at' => $time,
                'updated_by' => $updated_by['nama_user'],
            ];

            if ($this->db->update('usulan', $data, array('id' => $this->input->post('id_usulan')))) {
                echo "ok";
            }

            $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Usulan berhasil diubah!</div>');
        }

        if ($aksi == 'ubahstatus') {
            $username = $this->session->userdata('username');
            $updated_by = $this->db->get_where('user', ['username' => $username])->row_array();
            $time = date('Y-m-d H:i:s');

            $detail_usulan = $this->db->get_where('detail_usulan', ['kode_usulan' => $this->input->post('kode_usulan')])->result_array();

            $cek_status = 1;
            foreach ($detail_usulan as $du) {
                if ($du['status_berkas'] == 0) {
                    $cek_status = 0;
                }
            }

            if ($detail_usulan != null) {
                if ($cek_status  == 0) {
                    $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Masih ada berkas yang belum lengkap, silahkan lengkapi!</div>');
                } else {
                    $data = [
                        'status_usulan' => 2,
                        'updated_at' => $time,
                        'updated_by' => $updated_by['nama_user'],
                    ];
                    if ($this->db->update('usulan', $data, array('id' => $this->input->post('id_usulan')))) {
                        $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Usulan telah diusulkan ke BKN!</div>');
                    }
                }
            } else {
                $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Belum ada data pegawai yang diusulkan!</div>');
            }
            redirect(base_url('karsu/home'));
        }

        if ($aksi == 'ubahstatus2') {

            $username = $this->session->userdata('username');
            $updated_by = $this->db->get_where('user', ['username' => $username])->row_array();
            $time = date('Y-m-d H:i:s');

            $detail_usulan = $this->db->get_where('detail_usulan', ['kode_usulan' => $this->input->post('kode_usulan')])->result_array();


            if ($detail_usulan != null) {
                $data = [
                    'status_usulan' => $this->input->post('status_usulan'),
                    'updated_at' => $time,
                    'updated_by' => $updated_by['nama_user'],
                ];

                if ($this->db->update('usulan', $data, array('id' => $this->input->post('id_usulan')))) {
                    $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Status berhasil diubah!</div>');
                }
            } else {
                $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Status gagal diubah!</div>');
            }
            redirect(base_url('karsu/home'));
        }

        if ($aksi == 'tambah_pegawai') {
            $username = $this->session->userdata('username');
            $updated_by = $this->db->get_where('user', ['username' => $username])->row_array();
            $time = date('Y-m-d H:i:s');

            $nip = $this->input->post('nip');
            $detail_usulan = $this->db->get_where('detail_usulan', ['kode_usulan' => $this->input->post('kode_usulan')])->result_array();
            $cek = 0;
            $count = 0;

            if ($detail_usulan != null) {
                foreach ($detail_usulan as $dp) {
                    if ($dp['nip'] == $this->input->post('nip')) {
                        $cek = 1;
                    }
                    $count++;
                }
            }

            if ($count < 25) {
                if ($cek == 0) {
                    $data = [
                        'kode_usulan' => $this->input->post('kode_usulan'),
                        'nip' => $nip,
                        'updated_by' => $updated_by['nama_user'],
                    ];
                    if ($this->db->insert('detail_usulan', $data, array('kode_usulan' => $this->input->post('kode_usulan')))) {
                        echo "ok";
                    }
                    $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Pegawai berhasil ditambahkan!</div>');
                } else {
                    $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Pegawai yang dipilih sudah ada didaftar!</div>');
                }
            } else {
                $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Data Penuh. Maksimal 25 orang per usulan!</div>');
            }
        }
    }

    public function crud_usulan_detail_karsu($aksi = null, $nip = null)
    {
        if ($aksi == 'hapus') {

            $kode_usulan = $this->input->post('kode_usulan');
            $id_usulan = $this->input->post('id_usulan');

            if ($this->db->where('nip', $nip)->where('kode_usulan', $kode_usulan)->delete('detail_usulan')) {
                $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
                redirect((base_url('karsu/detail_karsu/') . $id_usulan));
            } else {
                $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>');
                redirect((base_url('karsu/detail_karsu/') . $id_usulan));
            }
        }

        if ($aksi == 'lengkapidata') {

            $id_usulan = $this->input->post('id_usulan');
            $dataupdate = [
                'tmt_LAP_KAWIN' => date('d-m-Y', strtotime($this->input->post('tmt_LAP_KAWIN'))),
                'tgl_sk_LAP_KAWIN' => date('d-m-Y', strtotime($this->input->post('tgl_sk_LAP_KAWIN'))),
                'no_sk_LAP_KAWIN' => $this->input->post('no_sk_LAP_KAWIN'),
                'tmt_KELUARGA' => date('d-m-Y', strtotime($this->input->post('tmt_KELUARGA'))),
                'tgl_sk_KELUARGA' => date('d-m-Y', strtotime($this->input->post('tgl_sk_KELUARGA'))),
                'no_sk_KELUARGA' => $this->input->post('no_sk_KELUARGA'),
            ];

            if ($this->db->update('profile_pegawai', $dataupdate, array('nip' => $nip))) {
                $this->session->set_flashdata('usulan', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect((base_url('karsu/detail_karsu/') . $id_usulan));
            } else {
                $this->session->set_flashdata('usulan', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
                redirect((base_url('karsu/detail_karsu/') . $id_usulan));
            }
        }
    }

    public function upload_berkas($nip = null, $id_usulan = null, $jenis_usulan = null)
    {
        if ($jenis_usulan == null) {
            $jenis_usulan = $this->input->post('jenis_usulan');
        } else {
            $jenis_usulan = $jenis_usulan;
        }

        $data['nip'] = $nip;
        if ($id_usulan == null) {
            $data['id_usulan'] = $this->input->post('id_usulan');
        } else {
            $data['id_usulan'] = $id_usulan;
        }
        $data['title'] = 'Kartu Suami';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();

        $namaberkas_sp = null;
        $namaberkas_kematian = null;
        $namaberkas_lampiranxxx = null;
        $namaberkas_lampiranxxxi = null;
        $namaberkas_kehilangankarsu = null;

        if ($jenis_usulan == "karsu_baru") {
            $namaberkas_sp = "PENGANTAR_KARSU_BARU_" . $nip;
            $namaberkas_kematian = "KEMATIAN_" . $nip;
        } else if ($jenis_usulan == "karsu_pengganti") {
            $namaberkas_sp = "PENGANTAR_KARSU_PENGGANTI_" . $nip;
            $namaberkas_lampiranxxx = "LAMPIRAN_XXX_KARSU_" . $nip;
            $namaberkas_lampiranxxxi = "LAMPIRAN_XXXI_KARSU_" . $nip;
            $namaberkas_kehilangankarsu = "KEHILANGAN_KARSU_" . $nip;

            $data['berkas_lampiranxxx'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_lampiranxxx])->row_array();
            $data['berkas_lampiranxxxi'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_lampiranxxxi])->row_array();
            $data['berkas_kehilangankarsu'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_kehilangankarsu])->row_array();
        }
        $namaberkas_suratnikah = "SURAT_NIKAH_" . $nip;
        $namaberkas_lapkawin = "SK_LAP_KAWIN_" . $nip;
        $namaberkas_keluarga = "KELUARGA_" . $nip;
        $namaberkas_fotoSUAMI = "FOTO_SUAMI_" . $nip;



        $data['berkas_sp'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_sp, 'jenis_berkas' => $jenis_usulan])->row_array();
        $data['berkas_suratnikah'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_suratnikah, 'jenis_berkas' => $jenis_usulan])->row_array();
        $data['berkas_keluarga'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_keluarga])->row_array();
        $data['berkas_lapkawin'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_lapkawin])->row_array();
        $data['berkas_kematian'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_kematian])->row_array();
        $data['berkas_fotosuami'] = $this->db->get_where('berkas', ['nip' => $nip, 'nama_berkas' => $namaberkas_fotoSUAMI])->row_array();

        $data['tabel_user'] = $this->db->get('user')->result_array();


        $data['usulan'] = $this->db->where('rec_active', 1)->where('id', $data['id_usulan'])->get('usulan')->row_array();

        $detail_usulan = $this->db->get_where('detail_usulan', ['kode_usulan' => $data['usulan']['kode_usulan']])->result_array();
        $berkas_perusulan = $this->db->get('berkas')->result_array();

        $berkas1 = null;
        $berkas4 = null;
        $berkas6 = null;
        $berkas7 = null;
        $berkas8 = null;
        $berkas9 = null;

        foreach ($detail_usulan as $lu) {
            if ($jenis_usulan == "karsu_baru") {
                $berkas1 = "PENGANTAR_KARSU_BARU_" . $nip;
                $berkas4 = 'KEMATIAN_' . $lu['nip'];
            } else if ($jenis_usulan == "karsu_pengganti") {
                $berkas1 = "PENGANTAR_KARSU_PENGGANTI_" . $nip;
                $berkas6 = "LAMPIRAN_XXX_KARSU_" . $nip;
                $berkas7 = "LAMPIRAN_XXXI_KARSU_" . $nip;
                $berkas8 = "KEHILANGAN_KARSU_" . $nip;
            }
            $berkas2 = 'SK_LAP_KAWIN_' . $lu['nip'];
            $berkas3 = 'KELUARGA_' . $lu['nip'];
            $berkas5 = 'FOTO_SUAMI_' . $lu['nip'];
            $berkas9 = "SURAT_NIKAH_" . $nip;

            $sb1 = null;
            $sb2 = null;
            $sb3 = null;
            $sb4 = null;
            $sb5 = null;
            $sb6 = null;
            $sb7 = null;
            $sb8 = null;
            $sb9 = null;

            foreach ($berkas_perusulan as $bks) {
                if ($bks['nama_berkas'] == $berkas1) {
                    $sb1 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas2) {
                    $sb2 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas3) {
                    $sb3 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas4) {
                    $sb4 = "Lengkap";
                }
                if ($bks['nama_berkas'] == $berkas5) {
                    $sb5 = "Lengkap";
                }
                if ($jenis_usulan == "karsu_baru") {
                    if ($bks['nama_berkas'] == $berkas9) {
                        $sb9 = "Lengkap";
                    }
                }
                if ($jenis_usulan == "karsu_pengganti") {
                    if ($bks['nama_berkas'] == $berkas6) {
                        $sb6 = "Lengkap";
                    }
                    if ($bks['nama_berkas'] == $berkas7) {
                        $sb7 = "Lengkap";
                    }
                    if ($bks['nama_berkas'] == $berkas8) {
                        $sb8 = "Lengkap";
                    }
                }
            }

            if ($jenis_usulan == "karsu_baru") {
                if (($sb1 == "Lengkap") && ($sb2 == "Lengkap") && ($sb3 == "Lengkap") && ($sb4 == "Lengkap") && ($sb5 == "Lengkap") && ($sb9 == "Lengkap")) {
                    $data1 = [
                        'status_berkas' => 1
                    ];
                    $this->db->update('detail_usulan', $data1, ['nip' => $lu['nip']]);
                } else {
                    $data2 = [
                        'status_berkas' => 0
                    ];
                    $this->db->update('detail_usulan', $data2, ['nip' => $lu['nip']]);
                }
            } else {
                if (($sb1 == "Lengkap") && ($sb2 == "Lengkap") && ($sb3 == "Lengkap") && ($sb5 == "Lengkap") && ($sb6 == "Lengkap") && ($sb7 == "Lengkap") && ($sb8 == "Lengkap") && ($sb9 == "Lengkap")) {
                    $data1 = [
                        'status_berkas' => 1
                    ];
                    $this->db->update('detail_usulan', $data1, ['nip' => $lu['nip']]);
                } else {
                    $data2 = [
                        'status_berkas' => 0
                    ];
                    $this->db->update('detail_usulan', $data2, ['nip' => $lu['nip']]);
                }
            }
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karsu/upload_berkas', $data);
        $this->load->view('templates/footer');
    }

    public function crud_riwayat($pg)
    {
        if ($pg == "datakarsu") {
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $id_usulan = $this->input->post('id_usulan');
            $jenis_usulan = $this->input->post('jenis_usulan');
            $status_kartu =  $this->input->post('status_kartu');
            $kode_usulan =  $this->input->post('kode_usulan');
            $no_kartu =  $this->input->post('no_kartu');
            $no_keputusan =  $this->input->post('no_keputusan');
            $tgl_terbit =  $this->input->post('tgl_terbit');
            $keterangan =  $this->input->post('keterangan');

            if ($status_kartu == 1) {
                // Check form submit or not 
                $namaberkas = "SCAN_KARSU_" . $nip;
                $data = array();

                $namafile = $_FILES['file']['name'];
                $ext = explode('.', $namafile);
                $ext = end($ext);
                // Set preference 
                $config['upload_path'] = 'upload/';
                $config['allowed_types'] = 'pdf';
                $config['max_size'] = '2000'; // max_size in kb 
                $config['file_name'] = $namaberkas;

                // Load upload library 
                $this->load->library('upload', $config);

                // File upload
                if ($this->upload->do_upload('file')) {
                    // Get data about the file
                    $this->upload->data();
                    $data = [
                        'id_usulan'      => $id_usulan,
                        'nip'           => $nip,
                        'path'         => 'upload/' . $namaberkas . '.' . $ext,
                        'nama_berkas'    => $namaberkas,
                        'jenis_berkas' => $jenis_usulan
                    ];

                    $this->db->insert('berkas', $data);
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                }

                $data = [
                    'no_kartu' => $no_kartu,
                    'no_keputusan' => $no_keputusan,
                    'tgl_terbit' => date('d-m-Y', strtotime($tgl_terbit)),
                    'status_kartu' => $status_kartu,
                    'keterangan' => null,
                    'posisi' => 1,
                ];
                $this->db->update('detail_usulan', $data, array('kode_usulan' => $kode_usulan, 'nip' => $nip));
                $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');

                // load view 
                redirect((base_url('karsu/riwayat/') . $id_usulan));
            } else if ($status_kartu == 2) {
                $data = [
                    'status_kartu' => $status_kartu,
                    'keterangan' => $keterangan,
                    'no_kartu' => null,
                    'no_keputusan' => null,
                    'tgl_terbit' => null,
                ];
                $this->db->update('detail_usulan', $data, array('kode_usulan' => $kode_usulan, 'nip' => $nip));
                $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect((base_url('karsu/riwayat/') . $id_usulan));
            }
        } else if ($pg = "kirimnotifikasi") {
            $id_usulan = $this->input->post('id_usulan');
            $nip = $this->input->post('nip');
            $jenis_usulan = $this->input->post('jenis_usulan');

            //KIRIM NOTIFIKASI
            $profile = $this->db->get_where('profile_pegawai', ['nip' => $nip])->row_array();
            $no_hp = $profile['hp'];
            //$no_hp = "081286178578";
            $nama_lengkap = $profile['nama_lengkap'];

            $gender = "";
            if ($profile['gender'] == "p") {
                $gender = "Bapak";
            } else if ($profile['gender'] == "w") {
                $gender = "Ibu";
            }
            $message = "Yth.  " . $gender . " " . $nama_lengkap . "," . "%0D%0A" . "Kartu Suami (KARSU) anda sudah selesai dicetak. Silahkan untuk mengambilnya di BKPP. Kami juga telah mengirim softcopy/ scan kartu Suami (KARSU) anda melalui email anda. %0D%0A%0D%0A" . "Manajemen Kinerja - BKPP Tangsel";
            $notif = send_wa($no_hp, $message);
            $result = "Notifikasi WA gagal dikirim ke " . $no_hp;
            if ($notif['message'] == 'Sukses! Pesan telah terkirim') {
                $result = " Notifikasi WA berhasil dikirim!";
            }


            $nama_berkas = "SCAN_KARSU_" . $nip;
            $berkas = $this->db->get_where('berkas', ['nama_berkas' => $nama_berkas, 'jenis_berkas' => $jenis_usulan])->row_array();
            $path_berkas = $berkas['path'];

            $email = $profile['email'];
            $path = base_url($path_berkas);
            $subject = "Pemberitahuan Kartu SUAMI (KARSU)";
            $message =  "Yth.  " . $gender . " " . $nama_lengkap . ",<br> Kartu SUAMI (KARSU) anda sudah selesai dicetak. Silahkan untuk mengambilnya di BKPP. Kami juga telah melampirkan softcopy/ scan kartu Suami (KARSU) anda. <br><br> Manajemen Kinerja - BKPP Tangsel";

            $result2 = "Notifikasi Email gagal dikirim";
            $result_sendemail = send_email($email, $path, $subject, $message);
            if ($result_sendemail == "ok") {
                $result2 = " Notifikasi Email berhasil dikirim ke " . $email;
            }

            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">' . $result . ' dan ' . $result2 . '</div>');
            redirect((base_url('karsu/riwayat/') . $id_usulan));
        }
    }

    public function crud_tandaterima()
    {

        $this->load->helper('url');
        $diambil_oleh =  $this->input->post('diambil_oleh');
        $id_usulan = $this->input->post('id_usulan');
        $jenis_usulan = $this->input->post('jenis_usulan');
        $kode_usulan =  $this->input->post('kode_usulan');
        $nip = $this->input->post('nip');
        $tgl_diambil =  $this->input->post('tgl_diambil');
        $namaberkas = "TANDA_TERIMA_" . $nip;
        $data = array();

        $namafile = $_FILES['file']['name'];
        $ext = explode('.', $namafile);
        $ext = end($ext);
        // Set preference 
        $config['upload_path'] = 'upload/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '2000'; // max_size in kb 
        $config['file_name'] = $namaberkas;

        // Load upload library 
        $this->load->library('upload', $config);

        // File upload
        if ($this->upload->do_upload('file')) {
            // Get data about the file
            $this->upload->data();
            $data = [
                'id_usulan'      => $id_usulan,
                'nip'           => $nip,
                'path'         => 'upload/' . $namaberkas . '.' . $ext,
                'nama_berkas'    => $namaberkas,
                'jenis_berkas' => $jenis_usulan
            ];

            $this->db->insert('berkas', $data);
        }
        $data = [
            'diambil_oleh' => $diambil_oleh,
            'tgl_diambil' => date('d-m-Y', strtotime($tgl_diambil)),
            'posisi'  => 2,
        ];
        $this->db->update('detail_usulan', $data, array('kode_usulan' => $kode_usulan, 'nip' => $nip));
        $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');

        redirect((base_url('karsu/riwayat/') . $id_usulan));
    }

    public function hapus_berkas_karsu($id_berkas = null, $id_usulan = null, $namabks = null)
    {
        $path = 'upload/' . $namabks . '.pdf';

        if (unlink(FCPATH . $path)) {
            $this->db->where('id', $id_berkas)->delete('berkas');
            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">File berhasil dihapus!</div>');
            redirect((base_url('karsu/riwayat/') . $id_usulan));
        } else {
            $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">File gagal dihapus!</div>');
            redirect((base_url('karsu/riwayat/') . $id_usulan));
        }
    }

    public function crud_upload($pg)
    {
        if ($pg == 'hapus') {
            $this->load->helper('file');
            $jenis_usulan = $this->input->post('jenis_usulan');
            $id_berkas = $this->input->post('id_berkas');
            $id_usulan = $this->input->post('id_usulan');
            $nip = $this->input->post('nip');
            $path = $this->input->post('path');


            if (unlink(FCPATH . $path)) {
                if ($this->db->delete('berkas', ['id' => $id_berkas])) {
                    redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
                }
            }
        }

        if ($pg == 'suratpengantar') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $id_usulan = $this->input->post('id_usulan');
            $nip = $this->input->post('nip');
            $this->load->helper('url');

            $namaberkas = null;
            if ($jenis_usulan == "karsu_baru") {
                $namaberkas = "PENGANTAR_KARSU_BARU_" . $nip;
            } else {
                $namaberkas = "PENGANTAR_KARSU_PENGGANTI_" . $nip;
            }

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'lapkawin') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "SK_LAP_KAWIN_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'keluarga') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "KELUARGA_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'kematian') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "KEMATIAN_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'suratnikah') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "SURAT_NIKAH_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'fotosuami') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "FOTO_SUAMI_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'lampiranxxx') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "LAMPIRAN_XXX_KARSU_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'lampiranxxxi') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "LAMPIRAN_XXXI_KARSU_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        } else if ($pg == 'kehilangankarsu') {
            $jenis_usulan = $this->input->post('jenis_usulan');
            $this->load->helper('url');

            $nip = $this->input->post('nip');
            $namaberkas = "KEHILANGAN_KARSU_" . $nip;
            $id_usulan = $this->input->post('id_usulan');

            // Check form submit or not 
            if ($this->input->post('upload') != NULL) {
                $data = array();
                if (!empty($_FILES['file']['name'])) {

                    $namafile = $_FILES['file']['name'];
                    $ext = explode('.', $namafile);
                    $ext = end($ext);
                    // Set preference 
                    $config['upload_path'] = 'upload/';
                    $config['allowed_types'] = 'pdf';
                    $config['max_size'] = '2000'; // max_size in kb 
                    $config['file_name'] = $namaberkas;

                    // Load upload library 
                    $this->load->library('upload', $config);

                    // File upload
                    if ($this->upload->do_upload('file')) {
                        // Get data about the file
                        $this->upload->data();
                        $data = [
                            'id_usulan'      => $id_usulan,
                            'nip'           => $nip,
                            'path'         => 'upload/' . $namaberkas . '.' . $ext,
                            'nama_berkas'    => $namaberkas,
                            'jenis_berkas' => $jenis_usulan
                        ];

                        $exec = $this->db->insert('berkas', $data);
                        if ($exec) {
                            $this->session->set_flashdata('upload', '<div class="alert alert-success" role="alert">Berkas berhasil diupload!</div>');
                        }
                    } else {
                        $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert"><b>Berkas Gagal diupload, Pastikan format file .pdf dan ukuran maksimal 2 MB</b></div>');
                    }
                } else {
                    $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload, Berkas sudah diupload!</div>');
                }
                // load view 


                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            } else {
                // load view 
                $this->session->set_flashdata('upload', '<div class="alert alert-danger" role="alert">Berkas Gagal diupload!</div>');
                redirect((base_url('karsu/upload_berkas/') . $nip . '/' . $id_usulan . '/' . $jenis_usulan));
            }
        }
    }
}
