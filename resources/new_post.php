<?php

$form = new PFBC\Form("www_new_post_form");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
    "ajaxCallback" => "www_post_submit_ajax",
    "novalidate" => "",
	"action" => "./resources/handler.php"
));
$form->addElement(new PFBC\Element\HTML('<legend>New Post</legend>'));
$form->addElement(new PFBC\Element\Hidden('www_new_post_form','form'));
$form->addElement(new PFBC\Element\Textbox("Index", "new_post_index"));
$form->addElement(new PFBC\Element\Textbox("Title", "new_post_title"));
$form->addElement(new PFBC\Element\Textbox("Stub", "new_post_stub"));
$form->addElement(new PFBC\Element\Select("Template", "new_post_location", array('page'=>'Content Body','home_tower'=>'Side Tower','site_wide'=>'Site Wide')));
$form->addElement(new PFBC\Element\CKEditor("Body", "new_post_body"));
$form->addElement(new PFBC\Element\HTML("<span class='post_submit_result'></span>"));
$form->addElement(new PFBC\Element\Button('Post'));
$form->addElement(new PFBC\Element\Button('Cancel','button',array('onclick'=>'history.go(-1)')));

$form->render();

?>

<script>

function www_post_submit_ajax(r){
	 $('.post_submit_result').html(r.response);
	 
}


</script>

