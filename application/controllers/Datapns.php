<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datapns extends CI_Controller
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
        $data['profile_pegawai'] = $this->db->get('profile_pegawai')->result_array();
        $data['title'] = 'Data PNS';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('data/datapns', $data);
        $this->load->view('templates/footer');
    }
}
