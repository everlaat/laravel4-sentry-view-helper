<?php namespace Elvedia\Vsentry;

/*
 * This file is part of the Sentry 2 View Helper package (Vsentry)
 *
 *    DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 *                  Version 2, December 2004
 *
 * Copyright (C) 2014 Elvin Verlaat
 * Everyone is permitted to copy and distribute verbatim or modified
 * copies of this license document, and changing it is allowed as long
 * as the name is changed.
 * 
 *            DO WHAT THE FUCK YOU WANT TO PUBLIC LICENSE
 *   TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
 * 
 * 0. You just DO WHAT THE FUCK YOU WANT TO.
 *
 */

use Cartalyst\Sentry\Facades\Laravel\Sentry as Sentry;

class Vsentry {

  private static $user;

  public function __construct() 
  {
    self::$user = Sentry::getUser();
  }

  public static function getUser($attribute)
  {
    if( self::$user and isset(self::$user->$attribute)) {
      return self::$user->$attribute;
    }
    $tryMethod = 'getUser'.ucfirst($attribute);
    if( method_exists(new Vsentry, $tryMethod)) {
      return self::$tryMethod();
    }

    return null;
  }

  public static function getUserFullName()
  {
    if( self::$user ) {
      $return = "";
      $posAttr = array('title', 'first_name', 'familly_name_prefix', 'last_name_prefix', 'familly_name', 'last_name');
      foreach($posAttr as $attr) {
        if(isset(self::$user->$attr)) {
          $return.= self::$user->$attr." ";
        }
      }
      return trim($return);
    }
    return null;
  }

  
}