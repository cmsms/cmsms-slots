<?php


/*
	Module: Slots - This allow you to create slots like in Symfony and to add content in it.
	
	Copyrights: Jean-Christophe Cuvelier - Morris & Chapman Belgium - 2010 ©
	License: GPL
*/

class Slots extends CMSModule
{
    var $slots;

    public function GetName()
    {
        return 'Slots';
    }

    public function GetFriendlyName()
    {
        return 'Slots';
    }

    public function GetVersion()
    {
        return '1.0.4';
    }

    public function GetAuthor()
    {
        return 'Jean-Christophe Cuvelier';
    }

    public function GetAuthorEmail()
    {
        return 'jcc@atomseeds.com';
    }

    public function HasAdmin()
    {
        return true;
    }

    public function VisibleToAdminUser()
    {
        return $this->CheckAccess();
    }

    public function CheckAccess()
    {
        return $this->CheckPermission('Manage Slots');
    }

    public function GetDependencies()
    {
        return array('CMSForms' => '0.0.15');
    }

    public function GetAdminSection()
    {
        return 'layout';
    }

    public function GetHelp()
    {
        return $this->lang('help');
    }

    public function IsPluginModule()
    {
        return true;
    }

    public function setParameters()
    {
        $this->RegisterModulePlugin();
        //			$this->smarty->register_function('Slot',  array('CMSUsers','retrieveUser'));
        $this->smarty->register_block('SlotCapture', array('Slots', 'SlotCapture'));
        $this->smarty->register_block('SlotExecute', array('Slots', 'SlotExecute'));
    }

    public static function SlotCapture($params, $content, $template, &$repeat)
    {
        // only output on the closing tag
        if (!$repeat) {
            if (isset($content)) {
                if (Slots::checkContent($content)) {
                    $slot = (isset($params['name'])) ? $params['name'] : 'default';
                    $module = cms_utils::get_module('Slots');
                    if (self::checkContent($content)) {
                        if (isset($params['key'])) {
                            $module->slots[$slot][$params['key']] = $content;
                        } else {
                            $module->slots[$slot][] = $content;
                        }
                    }
                    $module->smarty->assign('Slot_' . $slot, count($module->slots[$slot]));

                    return null;
                }
            }
        }
    }

    public static function SlotExecute($params, $content, $template, &$repeat)
    {
        if (!$repeat) {
            if (isset($content)) {
                if (self::checkContent($content)) {
                    $module = cms_utils::get_module('Slots');

                    if (isset($params['key'])) {
                        $array = array($params['key'] => $content);
                    } else {
                        $array = array($content);
                    }

                    $module->smarty->assign('slot_content_array', $array);
                    $module->smarty->assign('slot_content', $content);
                    $module->smarty->assign('slot_params', $params);

                    return $module->ProcessTemplateFor('default', $params);
                }
            }
        }
    }

    public static function checkContent($content)
    {
        $content = trim($content);
        $content = str_replace("\r", '', $content);
        $content = str_replace("\n", '', $content);
        $content = str_replace("\t", '', $content);
        $content = str_replace(' ', '', $content);
        $content = str_replace(chr(194), '', $content);
        $content = str_replace(chr(160), '', $content);

        if (strlen($content) > 0) {
            // var_dump(ord(substr($content, 0, 1)));
            // 			var_dump($content);
            // 			echo urlencode($content);
            return true;
        } else {
            return false;
        }
    }

    public function ProcessTemplateFor($action, $params = array())
    {
        if (isset($params['template']) && $this->GetTemplate($params['template'])) {
            return $this->ProcessTemplateFromDatabase($params['template']);
        } // elseif (($template = $this->GetDefaultTemplate($action))	&&	($this->GetTemplate($template) !== false))
        // 	{
        // 		return $this->ProcessTemplateFromDatabase($template);
        // 	}
        else {
            return $this->ProcessTemplate('frontend.' . $action . '.tpl');
        }
    }

}