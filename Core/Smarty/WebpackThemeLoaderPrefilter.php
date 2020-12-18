<?php

namespace Aggrosoft\WebpackThemeLoader\Core\Smarty;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleSettingBridgeInterface;

class WebpackThemeLoaderPrefilter
{
    public function prefilter($tpl_source, &$smarty)
    {

        return $tpl_source;
    }

    protected function getCSSBlacklist ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('aCSSBlacklist', 'agwebpackthemeloader');
    }

    protected function getJSBlacklist ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('aJSBlacklist', 'agwebpackthemeloader');
    }
}