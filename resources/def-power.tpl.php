<script type="text/template" id="defensive-power">
	<div class="field-group">
<fieldset><div class="control-group"><label class="control-label" for="power_def_card_-element-0">Power Name</label><div class="controls"><input type="text" name="def-power-name-{?}" id="power_def_card_-element-0"></div></div><div class="control-group"><label class="control-label" for="power_def_card_-element-1">Attribute</label><div class="controls"><select name="def-power-attrib-{?}" id="power_def_card_-element-1"><option value="str">str</option><option value="agi">agi</option><option value="dex">dex</option></select></div></div><div class="control-group"><label class="control-label" for="power_def_card_-element-2">Value</label><div class="controls"><input type="text" name="def-power-value-{?}" id="power_def_card_-element-2"></div></div><div class="control-group"><label class="control-label" for="power_def_card_-element-3">Description</label><div class="controls"><textarea rows="5" name="def-power-flav-{?}" id="power_def_card_-element-3"></textarea></div></div><div class="control-group"><label class="control-label" for="power_def_card_-element-4">Attribute</label><div class="controls"><select name="def-power-dmgType-{?}" id="power_def_card_-element-4"><option value="phy">phy</option><option value="eng">eng</option><option value="meta">meta</option></select></div></div><div class="control-group"><label class="control-label" for="power_def_card_-element-5">Attribute</label><div class="controls"><label class="checkbox"> <input id="power_def_card_-element-5-0" type="checkbox" name="def-power-dmgType-{?}[]" value="DoT"> DoT </label> <label class="checkbox"> <input id="power_def_card_-element-5-1" type="checkbox" name="def-power-dmgType-{?}[]" value="Stun"> Stun </label> <label class="checkbox"> <input id="power_def_card_-element-5-2" type="checkbox" name="def-power-dmgType-{?}[]" value="Heal"> Heal </label> </div></div><div class="control-group"><label class="control-label" for="power_def_card_-element-6">Duration</label><div class="controls"><input type="number" name="def-power-dur-{?}" id="power_def_card_-element-6"></div></div>Cost <span class="power_cost"></span><span class="power_result"></span><div class="form-actions"><input type="button" value="X" name="" class="btn" id="power_def_card_-element-9"></div></fieldset>
		</div>
</script>