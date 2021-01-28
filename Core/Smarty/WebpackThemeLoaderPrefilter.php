<?php

namespace Aggrosoft\WebpackThemeLoader\Core\Smarty;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleSettingBridgeInterface;

class WebpackThemeLoaderPrefilter
{
    public static function prefilter($tpl_source, &$smarty)
    {
        $scripts = self::getJSBlacklist();
        $css = self::getCSSBlacklist();

        foreach($scripts as $script) {
            $tpl_source = preg_replace('/\[\{oxscript.*include="?.*'.preg_quote($script, '/').'.*"?.*\}\]/', '', $tpl_source) . "\n\n";
        }

        foreach($css as $stylesheet) {
            $tpl_source = preg_replace('/\[\{oxstyle.*include="?.*'.preg_quote($stylesheet, '/').'.*"?.*\}\]/', '', $tpl_source)  . "\n\n";
        }

        return $tpl_source;
    }

    protected static function getCSSBlacklist ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('aCSSBlacklist', 'agwebpackthemeloader');
    }

    protected static function getJSBlacklist ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('aJSBlacklist', 'agwebpackthemeloader');
    }
}