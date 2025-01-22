<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Welcome extends CI_Controller {

	    public function index()
	    {
			$this->load->view('Layouts/Header');
			$this->load->view('content/Home');
			$this->load->view('content/About');
			$this->load->view('content/Service');
			$this->load->view('content/Contact');
			$this->load->view('Layouts/Footer');
	    }
		
		public function info()
	    {
			$this->load->view('Layouts/Header');
			$this->load->view('content/Home');
			$this->load->view('Layouts/Footer');
	    }

		public function about()
	    {
			$this->load->view('Layouts/Header');
			$this->load->view('content/About');
			$this->load->view('Layouts/Footer');
	    }

		public function service ()
	    {
			$this->load->view('Layouts/Header');
			$this->load->view('content/Service');
			$this->load->view('Layouts/Footer');
	    }

		public function cont ()
	    {
			$this->load->view('Layouts/Header');
			$this->load->view('content/Contact');
			$this->load->view('Layouts/Footer');
	    }
		
		public function table(){
			
			$this->load->model('Contact');
			$this->Contact->send();
			}
		}
	?>

