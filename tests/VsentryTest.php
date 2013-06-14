<?php namespace Elvedia\Vsentry\Tests;

use Mockery as m;
use PHPUnit_Framework_TestCase;

use Elvedia\Vsentry\Vsentry as Vsentry;

use Cartalyst\Sentry\Sentry;


class VsentryTest extends PHPUnit_Framework_TestCase {

  public function setUp()
  {
    $this->sentry = new Sentry(
      $this->userProvider     = m::mock('Cartalyst\Sentry\Users\ProviderInterface'),
      $this->groupProvider    = m::mock('Cartalyst\Sentry\Groups\ProviderInterface'),
      $this->throttleProvider = m::mock('Cartalyst\Sentry\Throttling\ProviderInterface'),
      $this->session          = m::mock('Cartalyst\Sentry\Sessions\SessionInterface'),
      $this->cookie           = m::mock('Cartalyst\Sentry\Cookies\CookieInterface')
    );
  }

  public function tearDown()
  {
    m::close();
  }

  public function testLoggingInUser()
  {
    $user = m::mock('Cartalyst\Sentry\Users\UserInterface');
    $user->shouldReceive('isActivated')->once()->andReturn(true);
    $user->shouldReceive('getId')->once()->andReturn('foo');
    $user->shouldReceive('getPersistCode')->once()->andReturn('persist_code');
    $user->shouldReceive('recordLogin')->once();

    $this->session->shouldReceive('put')->with(array('foo', 'persist_code'))->once();

    $this->sentry->login($user);

  }

}