<?php 

/*

If a hilly road proves difficult for an old lady, she'd learn to take breaks at intervals and eventually get to her destination.
== Igbo Addage ==

*/

/*  == Notice ==
Simple Alert System uses PHP cookies to facilitate users’ choices on the visibility of the alert. 
It does not collect personal or website information; When users close the alert, it initiates a cookie that reminds the browser that the alert shouldn't show. 
*/


// Create cookie for alert visibility control
class sas_create_cookie {
    
      public function __construct() {
        
      $this->create_cookie();
        
      } 
    
    public function create_cookie () {
     
   if(isset($_GET["closeAlert"])):

       $close = TRUE;

       setcookie( "sas_close_alert", $close, 0, "/");
        
       return intval($_COOKIE["sas_close_alert"]);
        
       endif;
    }
            
}

new sas_create_cookie();