<?php

use phpDocumentor\Reflection\Types\Null_;

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ngambil dari fungsi yang di helper
        is_logged_admin_user();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {

        $this->load->model('Usulan_model', 'laporan');
        if ($this->input->post('layanan') == "karpeg") {
            if (($this->input->post('jenis_usulan') == "karpeg_baru") || ($this->input->post('jenis_usulan') == "karpeg_pengganti")) {
                $jenis_usulan = $this->input->post('jenis_usulan');
                $data['laporan'] = $this->laporan->jeniskarpegLaporan($jenis_usulan);
            } else {
                $jenis_usulan1 = "karpeg_baru";
                $jenis_usulan2 = "karpeg_pengganti";
                $data['laporan'] = $this->laporan->karpegLaporan($jenis_usulan1, $jenis_usulan2);
            }
        } else  if ($this->input->post('layanan') == "karsu") {
            if (($this->input->post('jenis_usulan') == "karsu_baru") || ($this->input->post('jenis_usulan') == "karsu_pengganti")) {
                $jenis_usulan = $this->input->post('jenis_usulan');
                $data['laporan'] = $this->laporan->jeniskarsuLaporan($jenis_usulan);
            } else {
                $jenis_usulan1 = "karsu_baru";
                $jenis_usulan2 = "karsu_pengganti";
                $data['laporan'] = $this->laporan->karsuLaporan($jenis_usulan1, $jenis_usulan2);
            }
        } else {
            $data['laporan'] = $this->laporan->allLaporan();
        }

        $data['title'] = 'Laporan';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();

        //var_dump($data['laporan']);

        $data['opd'] = $this->db->distinct()->select('opd')->get('profile_pegawai')->result_array();
        // var_dump($data['opd']);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('templates/footer');
    }
}
