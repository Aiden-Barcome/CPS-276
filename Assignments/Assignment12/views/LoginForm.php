<?php
include_once 'controllers/loginProc.php';

function init(){
    global $formConfig, $stickyForm, $acknowledgement;
    
  
  return<<<HTML
  
  <div class="container mt-5">
  {$acknowledgement}
  <h1>Login</h1>
      <form method="post" action="">
          <div class="row">
              <div class="col-md">
                  {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
              </div>
          </div>
          <div class="row">
            <div class="col-md">
                {$stickyForm->renderPassword($formConfig['password'], 'mb-3')}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <input class="btn btn-primary" type="submit" value="Login">
            </div>
          </div>
      </form>
  </div>
  
  HTML;
  
  }
?>