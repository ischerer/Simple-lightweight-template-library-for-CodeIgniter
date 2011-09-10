<?php

class apps extends CI_Controller
{
   var $data;
   
   function __construct() 
   {
      parent::__construct();
            
      $this->data['sub_menu'] = 'example_menu.php';
   }

   function index()
   {
      $data = $this->data;
      
      $data['key'] = $this->some_model->get_someting();
      
      $this->template->render_page($data, 'example_view');
   }
   
}