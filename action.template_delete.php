<?php
if(!cmsms()) exit;
/** @var Slots $this */

if (! $this->CheckAccess()) // Restrict to admin panel and users with permission
{
    return $this->DisplayErrorPage($id, $params, $returnid,$this->Lang('accessdenied'));
    exit;
}


    if(isset($params['template']) && !empty($params['template']))
    {
        $this->DeleteTemplate($params['template']);
    }

    return $this->Redirect($id, 'defaultadmin', $returnid, array('active_tab' => 'templates'));