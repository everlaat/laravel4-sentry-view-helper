<?php namespace Elvedia\Vsentry;

use View;
use Session;
use Request;
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

class VsentryHtml {

  public function __construct()
  {

  }

  public static function login($attr = array())
  {
    Session::put('url.intended', Request::path() );
    print View::make('vsentry::login', $attr);
  }

}