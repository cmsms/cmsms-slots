<?php

$lang = array(
	
	'add template' => 'Add template',
	'form_template' => 'Template',
	'form_code' => 'Code',
	'form_restore_template_from' => 'Restore template from',
	'form_default_template_for' => 'Default template for',
	'select one' => 'Select one',
	
	
	'help' => '
	<h4>Usage of Slots</h4>
	<p>Use {SlotCapture name="name of your slot"}The content you want to capture{/SlotCapture} to capture some content (could be a module of course)</p>
	<p>Use {Slots name="name of your slot"} to show the slot (it only output something if it have something to show). You can also use the param template to specify the template to use.</p>
	<p>Use {Slots action="has_content" name="name of your slot"} to set the var {$SlotHasContent} to 1 if the slot has content or 0 if not.</p>
	
	<h4>Templates</h4>
	<p>Available variables</p>
	<ul>
		<li><strong>slot_content</strong>: The content of a slot</li>
		<li><strong>slot_content_array</strong>: An array containing all the slots contents (you can use the param "key" in the capture to define a key for the content)</li>
		<li><strong>slot_params</strong>: An array containing all the slots params</li>
	',
	
);