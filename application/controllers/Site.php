<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data["title"] = "Page d'accueil";
		
		$this->load->view('common/header', $data);
        $this->load->view('site/index', $data);
        $this->load->view('common/footer', $data);
	}

    public function contact() {

		$this->load->helper("form");
		$this->load->library('form_validation');

		$data["title"] = "Contact";

		$this->load->view('common/header', $data);
		if($this->form_validation->run()){
			$this->load->library('email');
			$this->config->load('email', TRUE);
			$this->email->initialize($this->config->item('email'));

            $this->email->from($this->input->post('email'), $this->input->post('name'));
            $this->email->to('micka06130@gmail.com');
            $this->email->subject($this->input->post('title'));
            $this->email->message($this->input->post('message'));
				if($this->email->send()){
					$data['result_class'] = "alert-success";
					$data['result_message'] = "Merci de nous avoir envoyé ce mail. Nous y répondrons dans les meilleurs délais.";
				} else {
					$data['result_class'] = "alert-danger";
					$data['result_message'] = "Votre message n'a pas pu être envoyé. Nous mettons tout en oeuvre pour résoudre le problème.";
					// Ne faites jamais ceci dans le "vrai monde"
					$data['result_message'] .= "<pre>\n";
					$data['result_message'] .= $this->email->print_debugger();
					$data['result_message'] .= "</pre>\n";
					$this->email->clear();
				}
			$this->load->view('site/contact_result', $data);
		}else {
			$this->load->view('site/contact', $data);
		}
		$this->load->view('common/footer', $data);
	}
	
	public function apropos()
	{
		$data["title"] = "A Propos";
		
		$this->load->view('common/header', $data);
        $this->load->view('site/apropos', $data);
        $this->load->view('common/footer', $data);
	}

	public function session_test() {
        $this->session->count ++;
        echo"Valeur :" . $this->session->count;
	}
	
	public function connexion() {
        $this->load->helper("form");
        $this->load->library('form_validation');

        $data["title"] = "Identification";

        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
			$this->auth_user->login($username, $password);
			if($this->auth_user->is_connected){
				redirect('index');
			} else {
				$data['login_error'] = "Echec de l'authentification";
			}
		}
            
        $this->load->view('common/header', $data);
        $this->load->view('site/connexion', $data);
        $this->load->view('common/footer', $data);
    }
    
	
	function deconnexion() {
        $this->auth_user->logout();
        redirect('index');
    }
}



