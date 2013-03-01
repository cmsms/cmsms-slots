<?php
if (!cmsms()) exit;

if (isset($params['name']))
{	
 	$content = cms_utils::get_module('Slots')->slots[$params['name']];	
}
else
{
 	$content = cms_utils::get_module('Slots')->slots['default'];	
}

if (count($content) > 0)
{	
	$this->smarty->assign('slot_content_array', $content);
	$this->smarty->assign('slot_content', implode('',$content));
	$this->smarty->assign('slot_params', $params);
	echo $this->ProcessTemplateFor('default', $params);	
}