<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function index()
	{
        $data['content'] = 'site';
        $data['title'] = 'MORE GRUPPA - Raporty';
		$this->load->view('include/layout',$data);
	}
    public function logowanie()
    {
        if($this->user_baza->sprawdz()==true)
            redirect('user/profil');
        else
		{
            redirect('site/index');  
		}
    }
	
	//blad
}