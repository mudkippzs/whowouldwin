<?php
if(isset($_GET['edit'])){
	$form_name = 'www_edit_post_form';
	$form_title = '<legend>Edit Post</legend>';
	$stub = $_GET['edit'];
	$get_form_data =  new post();
	$list = $postList->get_post($stub);
	$pageID = $list[0]['page_id'];
	$title = $list[0]['page_title'];
	$stub = $list[0]['stub'];
	$template = $list[0]['template'];
	$content = $list[0]['content'];
	$callBack = 'www_post_submit_ajax';

}else{
	$form_name = 'www_new_post_form';
	$callBack = 'www_post_edit_ajax';
	$form_title = '<legend>New Post</legend>';
	$pageID = '';
	$title = '';
	$stub = '';
	$template = '';
	$content = '';
}

//do the form rendering
$form = new PFBC\Form($form_name);
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
    "ajaxCallback" => $callBack,
    "novalidate" => "",
	"action" => "./resources/handler.php"
));

$form->addElement(new PFBC\Element\HTML($form_title));
$form->addElement(new PFBC\Element\Hidden($form_name,'form'));
$form->addElement(new PFBC\Element\Textbox("Index", "new_post_index",array('value'=>$pageID)));
$form->addElement(new PFBC\Element\Textbox("Title", "new_post_title",array('value'=>$title)));
$form->addElement(new PFBC\Element\Textbox("Stub", "new_post_stub",array('value'=>$stub)));
$form->addElement(new PFBC\Element\Select("Template", "new_post_location", array('page'=>'Content Body','home_tower'=>'Side Tower','site_wide'=>'Site Wide')));
$form->addElement(new PFBC\Element\CKEditor("Body", "new_post_body",array('value'=>$content)));
$form->addElement(new PFBC\Element\HTML("<span class='post_submit_result'></span>"));
$form->addElement(new PFBC\Element\Button('Post'));
$form->addElement(new PFBC\Element\Button('Cancel','button',array('onclick'=>'history.go(-1)')));

$form->render();

?>

<script>

function <?php echo $callBack; ?>(r){
	 $('.post_submit_result').html(r.response);
	 
}



</script>

