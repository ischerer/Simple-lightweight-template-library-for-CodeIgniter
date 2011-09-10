<?php
class Template
{
   
   public function render_page($data,$main_view)
   {
       $CI = &get_instance();
       
       //If development mode, load the minifyer library with option to use output buffering
       //Also, set the settings for carabiner.
       if(!$CI->config->item('development_mode'))
       {
         $CI->load->library('compactor', array('use_buffer' => true ) );
         $CI->carabiner->config(array('dev' => FALSE, 'combine' => TRUE ));
       }
       else
       {
           $CI->carabiner->config(array('dev' => TRUE, 'combine' => FALSE ));   
       }
       
       //Load Header view
       $CI->load->view('includes/header_view', $data);
       
       //Load top navigation view
       if($CI->tank_auth->is_logged_in() )
         $CI->load->view('includes/top_navigation_view');
      else
      {
         $CI->load->view('includes/top_navigation_nologin_view');
      }
      
      //Load submenu view if included
      if(@isset($data['sub_menu']) && $data['sub_menu'] != '')
      {
         $CI->load->view($data['sub_menu'], array( 'section' => $CI->uri->segment(2) ) );
      }
      
      //Load content/main view
       $CI->load->view($main_view.'_view',$data);
       
       //Load footer view
       $CI->load->view('includes/footer_view'); 
       
       //If development mode, compress output from the output buffer and print it
        if(!$CI->config->item('development_mode'))
       {
          $CI->compactor->squeeze();    
        }

   }
}