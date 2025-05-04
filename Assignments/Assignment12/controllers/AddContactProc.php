<?php
    require_once "classes/StickyForm.php";
    require_once "classes/Pdo_methods.php";
    require_once "includes/security.php";

    ensureLoggedIn();

    $acknowledgement="<p></p>";

    $formConfig=[
        'firstName'=>[
            'type'=>'text',
            'regex'=>'name',
            'label'=>'First Name',
            'id'=>'firstName',
            'name'=>'firstName',
            'errorMsg'=>'You must enter a valid first name',
            'error'=>'',
            'required'=>true,
            'value'=>'Scott'
        ],
        'lastName'=>[
            'type'=>'text',
            'regex'=>'name',
            'label'=>'Last Name',
            'id'=>'lastName',
            'name'=>'lastName',
            'errorMsg'=>'You must enter a valid last name.',
            'error'=>'',
            'required'=>true,
            'value'=>'Shaper'
        ],
        'address'=>[
            'type'=>'text',
            'regex'=>'address',
            'label'=>'Address',
            'id'=>'address',
            'name'=>'address',
            'errorMsg'=>'You must enter a valid address.',
            'error'=>'',
            'required'=>true,
            'value'=>'123 Anyplace'
        ],
        'city'=>[
            'type'=>'text',
            'regex'=>'city',
            'label'=>'City',
            'id'=>'city',
            'name'=>'city',
            'errorMsg'=>'You must enter a valid city',
            'error'=>'',
            'required'=>true,
            'value'=>'Somewhere',
        ],
        'state'=>[
            'type'=>'select',
            'label'=>'State',
            'id'=>'state',
            'name'=>'state',
            'errorMsg'=>'You must select a state.',
            'error'=>'',
            'required'=>true,
            'options'=>[
                'Michigan'=>'Michigan',
                '1'=>'Ohio',
                '2'=>'Indiana',
                '3'=>'Wisconsin',
                '4'=>'Illinois'
            ],
            'selected'=>''
        ],
        'zip'=>[
            'type'=>'text',
            'regex'=>'zip',
            'label'=>'ZIP Code',
            'id'=>'zip',
            'name'=>'zip',
            'errorMsg'=>'You must enter a valid ZIP code.',
            'error'=>'',
            'required'=>true,
            'value'=>'12345'
        ],
        'phone'=>[
            'type'=>'text',
            'regex'=>'phone',
            'label'=>'Phone',
            'id'=>'phone',
            'name'=>'phone',
            'errorMsg'=>'You must enter a valid phone number.',
            'error'=>'',
            'required'=>true,
            'value'=>'999.999.9999'
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
        'dob'=>[
            'type'=>'text',
            'regex'=>'dob',
            'label'=>'Date of Birth',
            'id'=>'dob',
            'name'=>'dob',
            'errorMsg'=>'You must enter a valid date of birth.',
            'error'=>'',
            'required'=>true,
            'value'=>'9/9/1999'
        ],
        'ageRange'=>[
            'type'=>'radio',
            'label'=>'Choose an age range:',
            'name'=>'ageRange',
            'id'=>'ageRange',
            'errorMsg'=>'You must select an age range.',
            'error'=>'',
            'required'=>true,
            'options'=>[
                ['value'=>'0-17', 'label'=>'0-17', 'checked'=>false],
                ['value'=>'18-30', 'label'=>'18-30', 'checked'=>false],
                ['value'=>'30-50', 'label'=>'30-50', 'checked'=>false],
                ['value'=>'50+', 'label'=>'50+', 'checked'=>false]
            ]
        ],
        'contacts'=>[
            'type'=>'checkbox',
            'label'=>'Select one or more options:',
            'name'=>'contactMethods',
            'id'=>'contactMethods',
            'error'=>'',
            'required'=>false,
            'options'=>[
                ['value'=>'newsletter', 'label'=>'Newsletter', 'checked'=>false],
                ['value'=>'email', 'label'=>'Email', 'checked'=>false],
                ['value'=>'text', 'label'=>'Text', 'checked'=>false]
            ]
        ],
        'masterStatus'=>[
            'error'=>false
        ]
    ];

    $stickyForm=new StickyForm();

    function clearFormFields() {
        global $formConfig;
        foreach ($formConfig as $key => $field) {
            // Skip non-field config entries like masterStatus
            if (!isset($field['type'])) continue;
    
            switch ($field['type']) {
                case 'select':
                    $formConfig[$key]['selected'] = '';
                    break;
    
                case 'radio':
                case 'checkbox':
                    foreach ($formConfig[$key]['options'] as $i => $option) {
                        $formConfig[$key]['options'][$i]['checked'] = false;
                    }
                    break;
    
                default:
                    $formConfig[$key]['value'] = '';
                    break;
            }
        }
    }
    
    
    if ($_SERVER['REQUEST_METHOD']==='POST'){
        $contacts=isset($_POST['contactMethods']) ? implode(', ', $_POST['contactMethods']) : '';
        $formConfig=$stickyForm->validateForm($_POST,$formConfig);
        if(!$stickyForm->hasErrors()&&$formConfig['masterStatus']['error']==false){
            $pdo=new PdoMethods();

            $sql="INSERT INTO contacts (fname, lname, address, city, state, zip, phone, email, dob, contacts, age) VALUES (:fname, :lname, :address, :city, :state, :zip, :phone, :email, :dob, :contacts, :age)";
            $bindings=[
                [':fname',$_POST['firstName'], 'str'],
                [':lname',$_POST['lastName'], 'str'],
                [':address',$_POST['address'], 'str'],
                [':city',$_POST['city'], 'str'],
                [':state',$_POST['state'], 'str'],
                [':zip', $_POST['zip'], 'str'],
                [':phone',$_POST['phone'], 'str'],
                [':email',$_POST['email'],'str'],
                [':dob',$_POST['dob'],'str'],
                [':contacts',$contacts,'str'],
                [':age',$_POST['ageRange'],'str']
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
?>