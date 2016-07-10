<?php

$form = new PFBC\Form("www_new_comment_form");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
    "ajaxCallback" => "www_comment_submit_ajax",
    "novalidate" => "",
	"action" => "./resources/handler.php"
));
$form->addElement(new PFBC\Element\HTML('<legend>Comment</legend>'));
$form->addElement(new PFBC\Element\Hidden('www_new_comment_form','form'));
$form->addElement(new PFBC\Element\TinyMCE("Comment", "TinyMCE"));
$form->addElement(new PFBC\Element\HTML("<span class='comment_submit_result'></span>"));
$form->addElement(new PFBC\Element\Button('Post'));
$form->addElement(new PFBC\Element\Button('Cancel','button',array('onclick'=>'history.go(-1)')));

$form->render();

?>

<script>

function www_comment_submit_ajax(r){
	 $('.comment_submit_result').html(r.response);
	 
}


</script>

