<?php

$form = new PFBC\Form("www_user_login_form");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
	"view" => new PFBC\View\Inline,
    "labelToPlaceholder" => 1,
    "ajaxCallback" => "www_user_login_ajax",
    "novalidate" => "",
	"action" => "./resources/handler.php"));

$form->addElement(new PFBC\Element\Hidden('www_user_login_form','form'));
$form->addElement(new PFBC\Element\Textbox('User','login_username',array('placeholder'=>'Username','required'=>1)));
$form->addElement(new PFBC\Element\Password('Password','login_password',array('autocomplete'=>'off','placeholder'=>'Password','required'=>1)));
$form->addElement(new PFBC\Element\Checkbox("", "remember_session", array(
    "1" => "Remember me"
)));
$form->addElement(new PFBC\Element\HTML("<span class='login_result'></span>"));
$form->addElement(new PFBC\Element\HTML("<a href='' class='password_forgot_link'>Forgot your password?</a></span>"));
$form->addElement(new PFBC\Element\Button('Login'));
$form->addElement(new PFBC\Element\Button('...or Register','button',array('onclick'=>"$('.header_login_box').hide();$('.header_registration').toggle();")));

$form->render();

?>

<script>

$('.password_forgot_link').on('click',function(event){
	event.preventDefault();
	$('.header_forgot_password').css('display','block');
});

function www_user_login_ajax(r){	 
	 $('.login_result').html(r.response);
	 history.go(0);
	 
}

</script>