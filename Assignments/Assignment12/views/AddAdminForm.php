<?php
include_once 'controllers/AddAdminProc.php';

function init(){
    global $formConfig, $stickyForm, $acknowledgement;
    
  
  return<<<HTML
  <div class="container mt-5">
  {$acknowledgement}  
  <h1>Add Admin</h1>
      <form method="post" action="">
          <div class="row">
              <!-- Render first name field -->
              <div class="col-md-6">
                  {$stickyForm->renderInput($formConfig['firstName'], 'mb-3')}
              </div>
  
              <!-- Render last name field -->
              <div class="col-md-6">
                  {$stickyForm->renderInput($formConfig['lastName'], 'mb-3')}
              </div>
          </div>
  
          <div class="row">
            <div class="col-md-4">
                {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
            </div>
            <div class="col-md-4">
                {$stickyForm->renderPassword($formConfig['password'], 'mb-3')}
            </div>
            <div class="col-md-4">
                {$stickyForm->renderSelect($formConfig['status'], 'mb-3')}
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
                <input class="btn btn-primary" type="submit" value="Add Admin">
            </div>
          </div>
      </form>
  </div>
  
  HTML;
  
  }
?>