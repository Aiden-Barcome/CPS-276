<?php
    require_once "classes/StickyForm.php";
    require_once "classes/Pdo_methods.php";
    require_once "logout.php";

    $acknowledgement="<p></p>";

    if (isset($_GET['logout']) && $_GET['logout'] === 'true') {
        logoutUser();
        $acknowledgement = "<p class='success'>You have been successfully logged out.</p>";
    }

    $formConfig=[
        'email'=>[
            'type'=>'text',
            'regex'=>'email',
            'label'=>'Email',
            'name'=>'email',
            'id'=>'email',
            'errorMsg'=>'You must enter a valid email',
            'error'=>'',
            'required'=>true,
            'value'=>'abarcome@admin.com'
        ],
        'password'=>[
            'type'=>'password',
            'regex'=>'password',
            'label'=>'Password',
            'name'=>'password',
            'id'=>'password',
            'errorMsg'=>'You must enter a valid password.',
            'error'=>'',
            'required'=>true,
            'value'=>'password'
        ],
        'masterStatus'=>[
            'error'=>false
        ]
    ];

    $stickyForm=new StickyForm();

    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $formConfig=$stickyForm->validateForm($_POST,$formConfig);
        if(!$stickyForm->hasErrors()&&$formConfig['masterStatus']['error']==false){
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $pdo=new PdoMethods();

            $sql = "SELECT * FROM admins WHERE email = :email";
            $bindings = [
                [':email', $email, 'str']
            ];
            $result = $pdo->selectBinded($sql, $bindings);

            if ($result === 'error' || count($result) !== 1) {
                $acknowledgement = "<p class='error'>That account does not exist.</p>";
            } else {
                $user = $result[0];
    
                if (password_verify($password, $user['password'])) {
                    // Successful login
                    session_start();
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_status'] = $user['status']; // 'admin' or 'staff'

                    header("Location: index.php?page=welcome");
                    exit;
                } 
            }
        }
    }   
?>