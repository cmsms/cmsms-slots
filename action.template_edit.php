<?php
if(!cmsms()) exit;
if (! $this->CheckAccess()) // Restrict to admin panel and users with permission
{
	return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
	exit;
}

$form = new CMSForm($this->GetName(), $id, 'template_edit',$returnid);
$form->setButtons(array('submit','apply','cancel'));
$form->setMethod('post');
$form->setWidget('template','text',array('validators' => array('not_empty' => true)));
$form->setWidget('code', 'codearea');

if (!$form->getWidget('template')->isEmpty())
{
	if ($form->getWidget('code')->isEmpty() && !$form->isPosted())
	{
		$form->getWidget('code')->setValues($this->getTemplate($form->getWidget('template')->getValue()));
	}
}
else
{
			$form->getWidget('code')->setValues('{$slot_content}');
}

if ($form->isPosted())
{
	$form->process();
	
	if(!$form->hasErrors())
	{
			$this->SetTemplate($form->getWidget('template')->getValue(), $form->getWidget('code')->getValue());
					
			if ($form->isSubmitted())
			{
					return $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templates'));
			}
	}
}

if ($form->isCancelled())
{
			return $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templates'));
}

$this->smarty->assign('id', $id);
$this->smarty->assign('form', $form);

echo $this->ProcessTemplate('admin.template_edit.tpl');