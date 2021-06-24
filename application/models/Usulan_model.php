<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usulan_model extends CI_Model
{
    public function getKodeMax()
    {
        $query = "SELECT max(kode_usulan) as kodeTerbesar FROM usulan";
        return $this->db->query($query)->row_array();
    }

    public function getIdBerkasMax()
    {
        $today = date("Ymd");
        $query = "SELECT max(kode_berkas) as kodeTerbesar FROM berkas";
        return $this->db->query($query)->row_array();
    }



    public function allLaporan($jenis_usulan = null, $status = null, $opd = null, $startdate = null, $enddate = null)
    {

        $query = "SELECT `usulan`.`kode_usulan`, `usulan`.`status_usulan`, `usulan`.`no_surat`, `usulan`.`jenis_usulan`, `usulan`.`tgl_usulan`, `detail_usulan`.`nip`, `detail_usulan`.`no_kartu`, `detail_usulan`.`no_keputusan`, `detail_usulan`.`tgl_terbit`, `detail_usulan`.`diambil_oleh`, `detail_usulan`.`tgl_diambil`, `detail_usulan`.`status_kartu`, `detail_usulan`.`posisi`, `detail_usulan`.`keterangan`,  `profile_pegawai`.`nama_lengkap`, `profile_pegawai`.`opd`
        FROM `usulan`
        LEFT JOIN `detail_usulan` ON `detail_usulan`.`kode_usulan` = `usulan`.`kode_usulan`
        LEFT JOIN `profile_pegawai` ON `profile_pegawai`.`nip` = `detail_usulan`.`nip`
        WHERE `detail_usulan`.`nip` IS NOT NULL AND `usulan`.`rec_active` = 1
        ORDER BY `usulan`.`tgl_usulan` ASC";
        return $this->db->query($query)->result_array();
    }

    public function karpegLaporan($jenis_usulan1 = null, $jenis_usulan2 = null, $status = null, $opd = null, $startdate = null, $enddate = null)
    {

        $query = "SELECT `usulan`.`kode_usulan`, `usulan`.`status_usulan`, `usulan`.`no_surat`, `usulan`.`jenis_usulan`, `usulan`.`tgl_usulan`, `detail_usulan`.`nip`, `detail_usulan`.`no_kartu`, `detail_usulan`.`no_keputusan`, `detail_usulan`.`tgl_terbit`, `detail_usulan`.`diambil_oleh`, `detail_usulan`.`tgl_diambil`, `detail_usulan`.`status_kartu`, `detail_usulan`.`posisi`, `detail_usulan`.`keterangan`,  `profile_pegawai`.`nama_lengkap`, `profile_pegawai`.`opd`
        FROM `usulan`
        LEFT JOIN `detail_usulan` ON `detail_usulan`.`kode_usulan` = `usulan`.`kode_usulan`
        LEFT JOIN `profile_pegawai` ON `profile_pegawai`.`nip` = `detail_usulan`.`nip`
        WHERE `detail_usulan`.`nip` IS NOT NULL AND `usulan`.`rec_active` = 1 AND (`usulan`.`jenis_usulan` =  '" . $jenis_usulan1 . "' OR `usulan`.`jenis_usulan` =  '" . $jenis_usulan2 . "')
        ORDER BY `usulan`.`tgl_usulan` ASC";
        return $this->db->query($query)->result_array();
    }

    public function jeniskarpegLaporan($jenis_usulan = null, $status = null, $opd = null, $startdate = null, $enddate = null)
    {
        $query = "SELECT `usulan`.`kode_usulan`, `usulan`.`status_usulan`, `usulan`.`no_surat`, `usulan`.`jenis_usulan`, `usulan`.`tgl_usulan`, `detail_usulan`.`nip`, `detail_usulan`.`no_kartu`, `detail_usulan`.`no_keputusan`, `detail_usulan`.`tgl_terbit`, `detail_usulan`.`diambil_oleh`, `detail_usulan`.`tgl_diambil`, `detail_usulan`.`status_kartu`, `detail_usulan`.`posisi`, `detail_usulan`.`keterangan`,  `profile_pegawai`.`nama_lengkap`, `profile_pegawai`.`opd`
        FROM `usulan`
        LEFT JOIN `detail_usulan` ON `detail_usulan`.`kode_usulan` = `usulan`.`kode_usulan`
        LEFT JOIN `profile_pegawai` ON `profile_pegawai`.`nip` = `detail_usulan`.`nip`
        WHERE `detail_usulan`.`nip` IS NOT NULL AND `usulan`.`rec_active` = 1 AND `usulan`.`jenis_usulan` =  '" . $jenis_usulan . "'
        ORDER BY `usulan`.`tgl_usulan` ASC";
        return $this->db->query($query)->result_array();
    }


    public function karsuLaporan($jenis_usulan1 = null, $jenis_usulan2 = null, $status = null, $opd = null, $startdate = null, $enddate = null)
    {

        $query = "SELECT `usulan`.`kode_usulan`, `usulan`.`status_usulan`, `usulan`.`no_surat`, `usulan`.`jenis_usulan`, `usulan`.`tgl_usulan`, `detail_usulan`.`nip`, `detail_usulan`.`no_kartu`, `detail_usulan`.`no_keputusan`, `detail_usulan`.`tgl_terbit`, `detail_usulan`.`diambil_oleh`, `detail_usulan`.`tgl_diambil`, `detail_usulan`.`status_kartu`, `detail_usulan`.`posisi`, `detail_usulan`.`keterangan`,  `profile_pegawai`.`nama_lengkap`, `profile_pegawai`.`opd`
        FROM `usulan`
        LEFT JOIN `detail_usulan` ON `detail_usulan`.`kode_usulan` = `usulan`.`kode_usulan`
        LEFT JOIN `profile_pegawai` ON `profile_pegawai`.`nip` = `detail_usulan`.`nip`
        WHERE `detail_usulan`.`nip` IS NOT NULL AND `usulan`.`rec_active` = 1 AND (`usulan`.`jenis_usulan` =  '" . $jenis_usulan1 . "' OR `usulan`.`jenis_usulan` =  '" . $jenis_usulan2 . "')
        ORDER BY `usulan`.`tgl_usulan` ASC";
        return $this->db->query($query)->result_array();
    }

    public function jeniskarsuLaporan($jenis_usulan = null, $status = null, $opd = null, $startdate = null, $enddate = null)
    {
        $query = "SELECT `usulan`.`kode_usulan`, `usulan`.`status_usulan`, `usulan`.`no_surat`, `usulan`.`jenis_usulan`, `usulan`.`tgl_usulan`, `detail_usulan`.`nip`, `detail_usulan`.`no_kartu`, `detail_usulan`.`no_keputusan`, `detail_usulan`.`tgl_terbit`, `detail_usulan`.`diambil_oleh`, `detail_usulan`.`tgl_diambil`, `detail_usulan`.`status_kartu`, `detail_usulan`.`posisi`, `detail_usulan`.`keterangan`,  `profile_pegawai`.`nama_lengkap`, `profile_pegawai`.`opd`
        FROM `usulan`
        LEFT JOIN `detail_usulan` ON `detail_usulan`.`kode_usulan` = `usulan`.`kode_usulan`
        LEFT JOIN `profile_pegawai` ON `profile_pegawai`.`nip` = `detail_usulan`.`nip`
        WHERE `detail_usulan`.`nip` IS NOT NULL AND `usulan`.`rec_active` = 1 AND `usulan`.`jenis_usulan` =  '" . $jenis_usulan . "'
        ORDER BY `usulan`.`tgl_usulan` ASC";
        return $this->db->query($query)->result_array();
    }
}
