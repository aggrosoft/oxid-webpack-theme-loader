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

        if (self::inlineSVGIcons()) {
            $tpl_source = preg_replace('/<i.*?class=".*?fa .*?fa-([a-zA-Z-]+)(.*?)".*?><\/i>/m', '<svg class="svg-icon svg-inline--fa$2" aria-hidden="true"><use xlink:href="#fas-$1"></use></svg>', $tpl_source);
            $tpl_source = preg_replace('/<i.*?class=".*?(fa[a-z]).*?fa-([a-zA-Z-]+)(.*?)".*?><\/i>/m', '<svg class="svg-icon svg-inline--fa$3" aria-hidden="true"><use xlink:href="#$1-$2"></use></svg>', $tpl_source);
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

    protected static function inlineSVGIcons ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('blInlineSVGIcons', 'agwebpackthemeloader');
    }
}

if (!function_exists('smarty_prefilter_webpack_theme_loader')) {
    function smarty_prefilter_webpack_theme_loader ($tpl_source, &$smarty) {
        return WebpackThemeLoaderPrefilter::prefilter($tpl_source, $smarty);
    }
}