<?php
if (!cmsms()) exit;

if (isset($params['name']))
{
  $content = cms_utils::get_module('Slots')->slots[$params['name']];
  if (count($content) > 0)
  {
    $this->smarty->assign('SlotHasContent', 1);
  }
  else
  {
    $this->smarty->assign('SlotHasContent', 0);    
  }
}