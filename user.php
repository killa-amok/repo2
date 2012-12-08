<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->output->enable_profiler(TRUE);
        $zalogowany = $this->session->userdata('zalogowany');
        if($zalogowany!=TRUE)
            redirect('site/index');
    } 
    public function sprawdz_prawa()
    {
      if($this->session->userdata('typ')!=1)
        redirect('user/profil');
    }
    public function profil()
    {
        $data['dane']=$this->user_baza->wyciagnij_info();
        $data['title'] = 'MORE GRUPPA - Profil';
        $data['content']='user/profil';
        $this->load->view('include/layout',$data);
    }    
    public function pokaz_raporty()
    {
        $data['inwestycje'] = $this->raporty_baza->wyciagnij_inwestycje();
        $data['kredyty'] = $this->raporty_baza->wyciagnij_kredyty();
        $data['dlugi'] = $this->raporty_baza->wyciagnij_dlugi();
        $data['title'] = 'MORE GRUPPA - Moje Raporty';
        $data['content']='user/pokaz_moje_raporty';
        $this->load->view('include/layout',$data);
        
    }
    public function pokaz_raport_handlowca_form()
    {
        $this->sprawdz_prawa();
        $data['uzytkownicy'] = $this->user_baza->wyciagnij_wszystkich();
        $data['data'] = $this->raporty_baza->wyciagnij_podacie();
        $data['title'] = 'MORE GRUPPA - Raport Handlowca';
        $data['content'] = 'user/pokaz_raport_handlowca_form';
        $this->load->view('include/layout',$data);
    }
    public function pokaz_raport_handlowca()
    {
        $this->sprawdz_prawa();
        $data['inwestycje'] = $this->raporty_baza->wyciagnij_inwestycje_handlowca();
        $data['kredyty'] = $this->raporty_baza->wyciagnij_kredyty_handlowca();
        $data['dlugi'] = $this->raporty_baza->wyciagnij_dlugi_handlowca();
        $data['title'] = 'MORE GRUPPA - Raport Handlowca';
        $data['content'] = 'user/pokaz_raport_handlowca';
        $this->load->view('include/layout',$data);
    }
    public function pokaz_wszystkie_raporty()
    {
        $this->sprawdz_prawa();
        $data['inwestycje'] = $this->raporty_baza->wyciagnij_wszystkie_inwestycje($this->uri->segment(3));
        $data['kredyty'] = $this->raporty_baza->wyciagnij_wszystkie_kredyty($this->uri->segment(3));
        $data['dlugi'] = $this->raporty_baza->wyciagnij_wszystkie_dlugi($this->uri->segment(3));
        $data['title'] = 'MORE GRUPPA - Wszystkie raporty';
        $data['content']='user/pokaz_wszystkie_raporty';
        $this->load->view('include/layout',$data);
        
    }
    public function dodaj_raport_form()
    {
        $data['title'] = 'MORE GRUPPA - Dodaj nowy raport';
        $data['content']='user/dodaj_raport_form';
        $this->load->view('include/layout',$data);
    }
    
    public function dodaj_raport()
    {
        $this->raporty_baza->wrzuc_nowy();
        redirect('user/pokaz_raporty');
    }
    public function usun_raport()
    {
      $this->sprawdz_prawa();
      $id = $this->uri->segment(3);
      if(isset($id) and is_numeric($id))
      {
         $this->raporty_baza->wyrzuc($id);
         redirect('user/pokaz_wszystkie_raporty');
      }
    }
    public function pokaz_uzytkownikow()
    {
        $this->sprawdz_prawa();
        $data['uzytkownicy'] = $this->user_baza->wyciagnij_wszystkich();
        $data['title'] = 'MORE GRUPPA - Użytkownicy';
        $data['content']='user/pokaz_uzytkownikow';
        $this->load->view('include/layout',$data);  
    }
    public function dodaj_uzytkownika_form()
    {
        $this->sprawdz_prawa();
        $data['title'] = 'MORE GRUPPA - Dodaj nowego użytkownika';
        $data['content']='user/dodaj_uzytkownika_form';
        $this->load->view('include/layout',$data);  
    }
    public function dodaj_uzytkownika()
    {
        $this->sprawdz_prawa();
        $this->user_baza->wrzuc_nowego();
        redirect('user/pokaz_uzytkownikow'); 
    }
    public function usun_uzytkownika()
    {
      $this->sprawdz_prawa();
      $id = $this->uri->segment(3);
      if(isset($id) and is_numeric($id))
      {
         $this->user_baza->wyrzuc($id);
         redirect('user/pokaz_uzytkownikow');
      }
    }
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('site/index');
    }
}