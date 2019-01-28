<?php
    defined ('BASEPATH') OR exit ('No direct script acces allowed');

    class Program extends CI_Controller {
        public function index()
        {
            $this->load->view('viewprogram');
        }
    }
?>