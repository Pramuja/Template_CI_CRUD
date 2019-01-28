<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Pelanggan_Model');
    }
    public function index()
    {
        if($this->session->userdata('logged_in') == TRUE){
            $data['AllDataPelanggan'] = $this->Pelanggan_Model->getDataPelanggan();
            $data['konten'] = "Data_Pelanggan";
            $this->load->view('template', $data);

        }else{
            $this->load->view('Login');
        }
    }

    public function DataPelanggan()
    {
        if($this->session->userdata('logged_in') == TRUE){
            $data['AllDataPelanggan'] = $this->Pelanggan_Model->getDataPelanggan();
            $data['konten'] = "Data_Pelanggan";
            $this->load->view('template', $data);
        }else{
            $this->load->view('login');
        }
    }

    public function DaftarPelanggan()
    {
        if($this->session->userdata('logged_in') == TRUE){
            $data['konten'] = "DaftarPelanggan";
            $this->load->view('template', $data);

        }else{
            $this->load->view('Login');
        }
    }
    public function SendDataPelanggan()
    {
        if($this->session->userdata('logged_in') == TRUE){
            $this->form_validation->set_rules('id', 'id');
            $this->form_validation->set_rules('NamaPelanggan', 'NamaPelanggan', 'trim|required');
            $this->form_validation->set_rules('Alamat', 'Alamat', 'trim');
            $this->form_validation->set_rules('NoTelp', 'NoTelp', 'trim|required|numeric');
            $this->form_validation->set_rules('Username', 'Username', 'trim|required');
            $this->form_validation->set_rules('Password', 'Password', 'trim|required');
            
            if ($this->form_validation->run() == TRUE) {
                if($this->Pelanggan_Model->SaveDataPelanggan()) {
                    $this->session->set_flashdata('notif', "Berhasil Di Simpan");
                    redirect(base_url('index.php/Pelanggan/DaftarPelanggan'));
                }else {
                    $this->session->set_flashdata('notif', "Gagal Di Simpan");
                    redirect(base_url('index.php/Pelanggan/DaftarPelanggan'));
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect(base_url('index.php/Pelanggan/DaftarPelanggan'));
            }
        }else{
            $this->load->view('login');
        }
    }

    public function SendUpdateDataPelanggan()
    {
        if($this->session->userdata('logged_in') == TRUE){
            $this->form_validation->set_rules('ID', 'ID', 'trim|required');
            $this->form_validation->set_rules('NamaPelanggan', 'NamaPelanggan', 'trim|required');
            $this->form_validation->set_rules('Alamat', 'Alamat', 'trim');
            $this->form_validation->set_rules('NoTelp', 'NoTelp', 'trim|required|numeric');
            $this->form_validation->set_rules('Username', 'Username', 'trim|required');
            $this->form_validation->set_rules('Password', 'Password', 'trim|required');
            
            if ($this->form_validation->run() == TRUE) {
                if($this->Pelanggan_Model->UpdateDataPelanggan()) {
                    $this->session->set_flashdata('notif', "Berhasil Di Edit");
                    redirect(base_url('index.php/Pelanggan/Data_Pelanggan'));
                }else {
                    $this->session->set_flashdata('notif', "Gagal Di Edit");
                    redirect(base_url('index.php/Pelanggan/Data_Pelanggan'));
                }
            } else {
                $this->session->set_flashdata('notif', validation_errors());
                redirect(base_url('index.php/Pelanggan/Data_Pelanggan'));
            }
        }else{
            $this->load->view('login');
        }
    }

    public function HapusDataPelanggan($id)
	{
        if($this->session->userdata('logged_in') == TRUE){
            if($this->Pelanggan_Model->DeleteDataPelanggan($id) == TRUE){
                $this->session->set_flashdata('notif', 'Pelanggan Berhasil Dihapus');
                redirect(base_url('index.php/Pelanggan/Data_Pelanggan'));
            } else {
                $this->session->set_flashdata('notif', 'Pelanggan Gagal Dihapus');
                redirect(base_url('index.php/Pelanggan/Data_Pelanggan'));
            }
        }else{
            $this->load->view('login');
        }
	}
}
