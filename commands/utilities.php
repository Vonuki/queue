<?php
//
//Static methods could call from anywhere
//

class Util {

  /*
  * Print var in normilized view
  */    
  static function print_var($var)
  {
      echo "<pre>" . print_r($var, true) . "</pre>";
 
  }
  
}

?>