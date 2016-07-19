<?php

$form = new PFBC\Form("www_new_user_register");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
	"view" => new PFBC\View\Inline,
    "labelToPlaceholder" => 1,
    "ajaxCallback" => "www_user_registered_ajax",    
	"action" => "./resources/handler.php"
));

$form->addElement(new PFBC\Element\Hidden('www_new_user_register','form'));
$form->addElement(new PFBC\Element\Textbox('User','register_username',array('autocomplete'=>'off','placeholder'=>'Username','required'=>1)));
$form->addElement(new PFBC\Element\Email('Email','register_email',array('autocomplete'=>'off','placeholder'=>'Email','required'=>0)));
$form->addElement(new PFBC\Element\Password('Password','register_password',array('autocomplete'=>'off','placeholder'=>'Password','required'=>1)));
$form->addElement(new PFBC\Element\HTML("<span class='registration_no_email_warning'>Registering with an email will allow you to reset your password if you ever forget it!</span>"));
$form->addElement(new PFBC\Element\HTML("<span class='registration_result'></span>"));
$form->addElement(new PFBC\Element\Button('Register'));
$form->addElement(new PFBC\Element\Button('Cancel','button',array('onclick'=>'history.go(0)')));

$form->render();

?>

<script>

function www_user_registered_ajax(r){
	 $('.registration_result').html(r.response);
	 
}


</script>

