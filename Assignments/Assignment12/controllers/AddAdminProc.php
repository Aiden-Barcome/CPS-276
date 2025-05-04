<?php
    require_once "classes/StickyForm.php";
    require_once "classes/Pdo_methods.php";
    require_once "includes/security.php";

    ensureLoggedIn();

    ensureAdmin();

    global $acknowledgement;

    $acknowledgement="<p></p>";

    $formConfig=[
        'firstName'=>[
            'type'=>'text',
            'regex'=>'name',
            'label'=>'First Name',
            'name'=>'firstName',
            'id'=>'firstName',
            'errorMsg'=>'You must enter a valid first name',
            'error'=>'',
            'required'=>true,
            'value'=>'Scott'
        ],
        'lastName'=>[
            'type'=>'text',
            'regex'=>'name',
            'label'=>'Last Name',
            'name'=>'lastName',
            'id'=>'lastName',
            'errorMsg'=>'You must enter a valid last name.',
            'error'=>'',
            'required'=>true,
            'value'=>'Shaper'
        ],
        'email'=>[
            'type'=>'text',
            'regex'=>'email',
            'label'=>'Email',
            'id'=>'email',
            'name'=>'email',
            'errorMsg'=>'You must enter a valid email address.',
            'error'=>'',
            'required'=>true,
            'value'=>'sshaper@wccnet.edu'
        ],
        'password'=>[
            'type'=>'password',
            'regex'=>'password',
            'label'=>'Password',
            'id'=>'password',
            'name'=>'password',
            'errorMsg'=>'You must enter a valid password.',
            'error'=>'',
            'required'=>true,
            'value'=>'password'
        ],
        'status'=>[
            'type'=>'select',
            'label'=>'Status',
            'id'=>'status',
            'name'=>'status',
            'errorMsg'=>'You must select a status.',
            'error'=>'',
            'required'=>true,
            'options'=>[
                ''=>'Please select a status.',
                'staff'=>'Staff',
                'admin'=>'Admin'
            ],
            'selected'=>'',
        ],
        'masterStatus'=>[
            'error'=>false
        ]
    ];

    $stickyForm=new StickyForm();

    function clearFormFields() {
        global $formConfig;
        foreach ($formConfig as $key => $field) {
            if (!isset($field['type'])) continue;  // Skip non-form elements like 'masterStatus'
            if ($field['type'] === 'select') {
                $formConfig[$key]['selected'] = '';  // Reset to default "Please select a status."
            } else {
                $formConfig[$key]['value'] = '';  // Reset text/password fields
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $name=$_POST['firstName']." ".$_POST['lastName'];
        $formConfig=$stickyForm->validateForm($_POST,$formConfig);

        if (empty($_POST['password'])) {
            $formConfig['password']['error'] = $formConfig['password']['errorMsg'];
            $formConfig['masterStatus']['error'] = true;
        }

        if(!$stickyForm->hasErrors()&&$formConfig['masterStatus']['error']==false){
            $pdo=new PdoMethods();

            $sql = "SELECT * FROM admins WHERE email = :email";
            $bindings = [
                [':email', $_POST['email'], 'str']
            ];
            $existingEmail = $pdo->selectBinded($sql, $bindings);

            if ($existingEmail !== 'error' && count($existingEmail) > 0) {
                // Duplicate email found
                $acknowledgement = "<p style='color: red;'>This email is already registered. Please choose a different email address.</p>";
            } else{
                $sql="INSERT INTO admins (name, email, password, status) VALUES (:name, :email, :password, :status)";
                $bindings=[
                    [':name',$name, 'str'],
                    [':email',$_POST['email'],'str'],
                    [':password',password_hash($_POST['password'], PASSWORD_DEFAULT),'str'],
                    [':status',$_POST['status'],'str']
                ];

                $result=$pdo->otherBinded($sql, $bindings);

                if($result==='error'){
                    $acknowledgement='<p style="color:red">There was an error adding the record.</p>';
                }
                else{
                    clearFormFields();
                    $acknowledgement='<p style="color: green">Record has been added.</p>';
                }
            }
        }
    }
?>