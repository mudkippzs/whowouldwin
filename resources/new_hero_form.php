<?php
$attributes = pull_attribute_definitions();
$form = new PFBC\Form("www_new_hero");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
    "ajaxCallback" => "www_new_hero_create",
    "novalidate" => "",
	"action" => "./resources/handler.php"
));
$rangeOptions = array("min"=>"0","max"=>"25","step"=>"1",'required'=>1);
$form->addElement(new PFBC\Element\HTML('<legend>Create a Hero</legend>'));
$form->addElement(new PFBC\Element\Hidden('www_new_hero','form'));
$form->addElement(new PFBC\Element\Textbox('Name','Textbox',array('required'=>1)));
$form->addElement(new PFBC\Element\HTML('<h4>Attributes</h4>'));
foreach($attributes as $attr){
		$attr_lab = $attr['label'];
		$attr_name = "attribute_range_" . $attr['id'];
		
		$form->addElement(new PFBC\Element\Range(ucfirst($attr_lab), $attr_name,$rangeOptions));
}
$form->addElement(new PFBC\Element\HTML("<span class='new_hero_result'></span>"));
$form->addElement(new PFBC\Element\Button('Create'));
$form->addElement(new PFBC\Element\Button('Reset','button',array('onclick'=>'history.go(-1)')));
$form->addElement(new PFBC\Element\HTML('<h4>Powers</h4>'));
$form->addElement(new PFBC\Element\HTML('<input type="button" value="Add Offensive Power" class="add1 addPowerBtn" />  
					<input type="button" value="Add Defensive Power" class="add2 addPowerBtn" />
					<input type="button" value="Add Utility Power" class="add3 addPowerBtn" />
					</fieldset>
					<div id="tabs">
					  <ul>
					    <li><a href="#tabs-1">Offensive</a></li>
					    <li><a href="#tabs-2">Defensive</a></li>
					    <li><a href="#tabs-3">Utility</a></li>
					  </ul>
							<div id="tabs-1" class="offense_repeater power_repeater_box">'));
//repeater template for off
$form->addElement(new PFBC\Element\HTML('</div><div id="tabs-2" class="defense_repeater power_repeater_box">'));
//repeater template for def
$form->addElement(new PFBC\Element\HTML('</div><div id="tabs-3" class="defense_repeater power_repeater_box">'));
//repeater template for uti
$form->addElement(new PFBC\Element\HTML('</div></div>'));

$form->render();

?>

<script>

function www_new_hero_create(r){
	 $('.new_hero_result').html(r.response);
	 
}


</script>
