<?php
//
//Static methods could call from anywhere
//

class Util {

  /*
  * Print var in normilized view
  */    
  static function echo_var($var)
  {
      echo "<pre>" . print_r($var, true) . "</pre>";
 
  }
  
  static function print_var($var)
  {
      return "<pre>" . print_r($var, true) . "</pre>";
 
  }
  
}

?>