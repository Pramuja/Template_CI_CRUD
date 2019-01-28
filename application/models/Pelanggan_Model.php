<?php
defined (BASEPATH) OR exit ('No direct script access allowed');

class Pelanggan_Model extends CI_Model {
    public function SaveDataPelanggan() {
        $data = array(
            "nama_pembeli" => $this->input->post('NamaPelanggan'),
            "alamat" => $this->input->post('Alamat'),
            "no_telp" => $this->input->post('NoTelp'),
            "username" => $this->input->post('Username'),
            "password" => $this->input->post('Password'),
        );

        $this->db->insert('pembeli', $data);
        if($this->db->affected_rows() > 0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function DataPelanggan() {
        if($tis->session->userdata('logged_in') == TRUE) {
            $data['AllDataPelanggan'] = $this->Pelanggan_Model->getDataPelanggan();
            $data['MainView'] = "Data_Pelanggan";
            $this->load->view('template', $data);
        } else {
            $this->load->view('Login');
        }
    }
    public function getDataPelanggan() {
        return $this->db->order_by('id_pembeli', 'asc')
                        ->get('pembeli')
                        ->result();
    }
    public function UpdateDataPelanggan() {
        $id = $this->input->post('ID');
        $data = array(
            "nama_pembeli"      => $this->input->post('NamaPelanggan'),
            "alamat"            => $this->input->post('Alamat'),
            "no_telp"           => $this->input->post('NoTelp'),
            "username"          => $this->input->post('Username'),
            "password"          => $this->input->post('Password'),
        );
        $this->db->where('id_pembeli', $id)
                 ->update('pembeli', $data);

        if($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function DeleteDataPelanggan($id) {
        $this->db->where('id_pembeli', $id)
                 ->delete('pembeli');
        if($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}