<?php
include_once 'controllers/AddContactProc.php';

function init(){
    global $formConfig, $stickyForm, $acknowledgement;
    
  
  return<<<HTML
  <div class="container mt-5">
  {$acknowledgement}
  <h1>Add Contact</h1>
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
  
          <!-- Render address field -->
          <div class="row">
              <div class="col-md-12">
                  {$stickyForm->renderInput($formConfig['address'], 'mb-3')}
              </div>
          </div>
  
          <!-- Render zip code, phone, and email fields -->
          <div class="row">
              <div class="col-md-4">
                {$stickyForm->renderInput($formConfig['city'], 'mb-3')}
              </div>
              <div class="col-md-4">
                  {$stickyForm->renderSelect($formConfig['state'], 'mb-3')}
              </div>
              <div class="col-md-4">
                  {$stickyForm->renderInput($formConfig['zip'], 'mb-3')}
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                  {$stickyForm->renderInput($formConfig['phone'], 'mb-3')}
              </div>
              <div class="col-md-4">
                  {$stickyForm->renderInput($formConfig['email'], 'mb-3')}
              </div>
              <div class="col-md-4">
                  {$stickyForm->renderInput($formConfig['dob'], 'mb-3')}
          </div>
          <div class="row">
              <div class="col-md-4">
                  {$stickyForm->renderRadio($formConfig['ageRange'], 'mb-3', 'horizontal')}
              </div>
          </div>
          <div class="row">
              <div class="col-md-4">
                  {$stickyForm->renderCheckboxGroup($formConfig['contacts'], 'mb-3', 'horizontal')}
              </div>
          </div>
          <div class="row">
              <div class="col-md-12">
                <input type="submit" class="btn btn-primary" value="Add Contact">
              </div>
          </div>
      </form>
  </div>
  
  HTML;
  
  }
?>