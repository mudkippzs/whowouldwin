(function ($) {

	$.fn.repeatable = function (userSettings) {

		/**
		 * Default settings
		 * @type {Object}
		 */
		var defaults = {
			addTrigger: ".add",
			deleteTrigger: ".del",
			max: null,
			startWith: 0,
			template: null,
			itemContainer: ".field-group",
			onAdd: function () {},
			onDelete: function () {}
		};

		/**
		 * Iterator used to make each added
		 * repeatable element unique
		 * @type {Number}
		 */
		var i = 0;
		
		/**
		 * DOM element into which repeatable
		 * items will be added
		 * @type {jQuery object}
		 */
		var target = $(this);
			
		/**
		 * Blend passed user settings with defauly settings
		 * @type {array}
		 */
		var settings = $.extend({}, defaults, userSettings);
		
		/**
		 * Total templated items found on the page
		 * at load. These may be created by server-side
		 * scripts.
		 * @return null
		 */
		var total = function () {
			return $(target).find(settings.itemContainer).length;
		}();

		
		/**
		 * Add an element to the target
		 * and call the callback function
		 * @param  object e Event
		 * @return null
		 */
		var addOne = function (e) {
			e.preventDefault();
			createOne();
			settings.onAdd.call(this);
		};

		/**
		 * Delete the parent element
		 * and call the callback function
		 * @param  object e Event
		 * @return null
		 */
		var deleteOne = function (e) {
			e.preventDefault();
			$(this).parents(settings.itemContainer).first().remove();
			total--;
			maintainAddBtn();
			settings.onDelete.call(this);
		};

		/**
		 * Add an element to the target
		 * @return null
		 */
		var createOne = function() {
			getUniqueTemplate().appendTo(target);
			total++;
			maintainAddBtn();
		};

		/**
		 * Alter the given template to make
		 * each form field name unique
		 * @return {jQuery object}
		 */
		var getUniqueTemplate = function () {
			var template = $(settings.template).html();
			template = template.replace(/{\?}/g, "new" + i++); 	// {?} => iterated placeholder
			template = template.replace(/\{[^\?\}]*\}/g, ""); 	// {valuePlaceholder} => ""
			return $(template);
		};

		/**
		 * Determines if the add trigger
		 * needs to be disabled
		 * @return null
		 */
		var maintainAddBtn = function () {
			if (!settings.max) {
				return;
			}

			if (total === settings.max) {
				$(settings.addTrigger).attr("disabled", "disabled");
			} else if (total < settings.max) {
				$(settings.addTrigger).removeAttr("disabled");
			}
		};

		/**
		 * Setup the repeater
		 * @return null
		 */
		(function () {
			$(settings.addTrigger).on("click", addOne);
			$("form").on("click", settings.deleteTrigger, deleteOne);

			if (!total) {
				var toCreate = settings.startWith - total;
				for (var j = 0; j < toCreate; j++) {
					createOne();
				}
			}
			
		})();
	};
})(jQuery);

/**
@TODO Redo all this template repeater shit because its a heap of shit right now
**/

// Repeatable Form Field
var powerTypes;
$(document).ready(function(){
	$.ajax({type: "POST",url: "./resources/handler.php",data: {"get_attributes":true},success: function(e){ powerTypes = e;	},dataType: 'json'});
});

var damageTypes;
$(document).ready(function(){
	$.ajax({type: "POST",url: "./resources/handler.php",data: {"get_damage_types":true},success: function(e){ damageTypes = e;	},dataType: 'json'});
});
	
	


$(function() {
    $("form .offense_repeater").repeatable({
        addTrigger: ".add1",
		onAdd: function(){
			
			$.each(powerTypes, function(key, value) {   
				 $('#power_off_card_-element-1')
					 .append($("<option></option>")
					 .attr("value",key)
					 .text(value)); 
			});	
			$.each(damageTypes, function(key, value) {
				console.log(damageTypes[0])				
				 $('.off_effectPowerCheckbox')
					 .append($("<label class='checkbox'><input id='power_off_card_-element-5-" + key + "' type='checkbox' name='off-power-dmgType-{?}[]' value='" + key + "'>" + value + "</label>"));					  
			});	
			
			
			$('.offense_repeater > .field-group').addClass('hero_form_power_repeater offense_repeater');
		},
		deleteTrigger: '#power_off_card_-element-9',
		template: "#offensive-power"
    });
});
$(function() {
    $("form .defense_repeater").repeatable({
        addTrigger: ".add2",
		onAdd: function(){
			$.each(powerTypes, function(key, value) {   
				 $('#power_def_card_-element-1')
					 .append($("<option></option>")
					 .attr("value",key)
					 .text(value)); 
			});			
			
			$.each(damageTypes, function(key, value) {
				console.log(damageTypes[0])				
				 $('.def_effectPowerCheckbox')
					 .append($("<label class='checkbox'><input id='power_def_card_-element-5-" + key + "' type='checkbox' name='def-power-dmgType-{?}[]' value='" + key + "'>" + value + "</label>"));					  
			});	
			
			
			$('.defense_repeater > .field-group').addClass('hero_form_power_repeater defense_repeater');
		},
		deleteTrigger: '#power_def_card_-element-9',
		template: "#defensive-power"
    });
});
$(function() {
    $("form .utility_repeater").repeatable({
        addTrigger: ".add3",
		onAdd: function(){
			$.each(powerTypes, function(key, value) {   
				 $('#power_uti_card_-element-1')
					 .append($("<option></option>")
					 .attr("value",key)
					 .text(value));
					 
			});
			
			$.each(damageTypes, function(key, value) {
				console.log(damageTypes[0])				
				 $('.uti_effectPowerCheckbox')
					 .append($("<label class='checkbox'><input id='power_uti_card_-element-5-" + key + "' type='checkbox' name='uti-power-dmgType-{?}[]' value='" + key + "'>" + value + "</label>"));					  
			});	
			
			
			$('.utility_repeater > .field-group').addClass('hero_form_power_repeater utility_repeater');
		},
		deleteTrigger: '#power_uti_card_-element-9',
		template: "#utility-power"
    });
});





  $( "#tabs" ).tabs({active: 0});
