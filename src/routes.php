<?php

Route::post('/vsentry-login', function() {

  if(strpos(Input::get('username'), '@') > 1) {
      Config::set('cartalyst/sentry::users.login_attribute', 'email');
    }
    $cred             = array();
    $cred[Config::get('cartalyst/sentry::users.login_attribute', 'username')]    = Input::get('username');
    $cred['password'] = Input::get('password');

    try {
      $user = Sentry::authenticate($cred, false);
      
      return Redirect::intended('/');

    } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
      Session::flash('sentry_error', 'Gebruikersnaam is niet ingevuld.');
    } catch (Cartalyst\Sentry\Users\PasswordRequiredException $e) {
      Session::flash('sentry_error', 'Wachtwoord is niet ingevuld.');
    } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
      Session::flash('sentry_error', 'Gerbuiker is niet bekend.');
    } catch (Cartalyst\Sentry\Users\WrongPasswordException $e) {
      Session::flash('sentry_error', 'Wachtwoord is incorrect.');
    } catch (Cartalyst\Sentry\Users\UserNotActivatedException $e) {
      Session::flash('sentry_error', 'Gerbuiker is niet geactiveerd.');
    } catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e) {
      Session::flash('sentry_error', 'Gerbuiker is op niet-actief geplaatst.');
    } catch (Cartalyst\Sentry\Throttling\UserBannedException $e) {
      Session::flash('sentry_error', 'Gerbuiker is verwijdert.');
    }

    return Redirect::refresh();

});