<div class="modal login {{ (isset($class)) ? $class : '' }}">
  
  <form action="/vsentry-login" method="POST">

    @if (isset($title))
    <div class="modal-header">
      <h3>{{ $title }}</h3>
    </div>    
    @endif

    <div class="modal-body">
   
      <div class="input-prepend">
        <span class="add-on"><i class="icon-user"></i></span>
        <input type="text" value="" placeholder="gebruikersnaam" name="username">
      </div>
      
      <div class="input-prepend">
        <span class="add-on"><i class="icon-key"></i></span>
        <input type="password" value="" placeholder="wachtwoord" name="password">
      </div>

    </div>
    
    <div class="modal-footer">
      <input type="submit" value="Login" class="btn btn-action">
    </div>

  </form>
</div>