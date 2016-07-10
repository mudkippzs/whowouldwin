<?php

$form = new PFBC\Form("www_user_reset_password_form");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
    "ajaxCallback" => "www_user_reset_password_ajax",
    "novalidate" => "",
	"action" => "./resources/handler.php"
));
$form->addElement(new PFBC\Element\HTML('<legend>Forgot your password?</legend>'));
$form->addElement(new PFBC\Element\Hidden('www_user_reset_password_form','form'));
$form->addElement(new PFBC\Element\Email('Email','Email',array('required'=>1)));
$form->addElement(new PFBC\Element\HTML("<span class='reset_password_result'></span>"));
$form->addElement(new PFBC\Element\Button('Reset my password!'));
$form->addElement(new PFBC\Element\Button('Cancel','button',array('onclick'=>'$(".header_forgot_password").css("display","none")')));
$form->render();

?>

<script>

function www_user_reset_password_ajax(r){	 
	 $('.reset_password_result').html(r.response);
	 
}
</script>
