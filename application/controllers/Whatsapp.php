<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //ngambil dari fungsi yang di helper
        is_logged_admin_user();

        date_default_timezone_set('Asia/Jakarta');
    }

    public function blast()
    {

        $data['title'] = 'Whatsapp Blast';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $data['tabel_user'] = $this->db->get('user')->result_array();
        $data['opd'] = $this->db->distinct()->select('opd')->get('profile_pegawai')->result_array();
        //print_r($data['usulan']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('tools/whatsappblast', $data);
        $this->load->view('templates/footer');
    }



    public function crud_blast()
    {
        $jenis_kirim = $this->input->post('jenis_kirim');
        $isi = $this->input->post('isi');
        $profile = $this->db->get('profile_pegawai')->result_array();

        if ($jenis_kirim == "all") {
            foreach ($profile as $pr) {
                $no_hp = $pr['hp'];
                send_wa($no_hp, $isi);
            }
            $this->session->set_flashdata('wa', '<div class="alert alert-success" role="alert"> Broadcast berhasil dikirim!</div>');
            redirect(base_url('whatsapp/blast'));
        } else {
            foreach ($profile as $pr) {
                if ($jenis_kirim == $pr['opd']) {
                    $no_hp = $pr['hp'];
                    send_wa($no_hp, $isi);
                }
            }
            $this->session->set_flashdata('wa', '<div class="alert alert-success" role="alert"> Broadcast berhasil dikirim ke OPD ' . $pr['opd'] . '</div>');
            redirect(base_url('whatsapp/blast'));
        }
    }

    public function send_wa()
    {
        // Pastikan phone menggunakan kode negara atau
        // 62 di depannya untuk Indonesia atau
        // bisa menggunakan 0 jika nomor tujuan Indonesia

        $token = 'yePK9u8agzCxuMhfixFQPHuRqIKRMSXdnjBkWbJzM3Y7dWyIFy';
        $phone = '081286178578';
        $message = 'Hallo Gaes';
        $url = 'http://ruangwa.id/api/send-message.php';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, array(
            'token'    => $token,
            'phone'     => $phone,
            'message'   => $message,
        ));
        $response = curl_exec($curl);
        curl_close($curl);

        echo $response;

        $data['title'] = 'Kartu Pegawai';
        $username = $this->session->userdata('username');
        $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
        $data['tabel_user'] = $this->db->get('user')->result_array();
        $data['usulan'] = $this->db->where('rec_active', 1)->order_by('created_at', 'DESC')->get('usulan')->result_array();
        $data['detail_usulan'] = $this->db->get_where('detail_usulan', ['rec_active' => 1])->result_array();
        //print_r($data['usulan']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('karpeg/home', $data);
        $this->load->view('templates/footer');
    }
}
