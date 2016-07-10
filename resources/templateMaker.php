<?php

$form = new PFBC\Form("www_power_test_form");
$form->configure(array(
	"prevent" => array("bootstrap", "jQuery"),
    "ajax" => 1,
    "ajaxCallback" => "www_power_test_form_ajax",
    "novalidate" => "",
	"action" => "./resources/handler.php"
));

$form->addElement(new PFBC\Element\Textbox("Power Name","off-power-name-{?}"));
$form->addElement(new PFBC\Element\Select("Attribute","off-power-attrib-{?}",array('str','agi','dex')));
$form->addElement(new PFBC\Element\Textbox("Value","off-power-value-{?}"));
$form->addElement(new PFBC\Element\Textarea("Description","off-power-flav-{?}"));
$form->addElement(new PFBC\Element\Select("Attribute","off-power-dmgType-{?}",array('phy','eng','meta')));
$form->addElement(new PFBC\Element\Checkbox("Attribute","off-power-dmgType-{?}",array('DoT','Stun','Heal')));
$form->addElement(new PFBC\Element\Number("Duration","off-power-dur-{?}"));
$form->addElement(new PFBC\Element\HTML("Cost <span class='power_cost'></span>"));
$form->addElement(new PFBC\Element\HTML("<span class='power_result'></span>"));
$form->addElement(new PFBC\Element\Button('X','button'));
$form->render();

?>
<script>
function www_power_test_form_ajax(r){	 
	 $('.power_result').html(r.response);
	 
}
</script>
