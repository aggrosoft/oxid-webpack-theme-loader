<?php

namespace Aggrosoft\WebpackThemeLoader\Core;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleSettingBridgeInterface;

class WebpackThemeLoaderViewConfig extends WebpackThemeLoaderViewConfig_parent
{
    protected $_oEntryPoints = null;

    public function getWebpackCSSFiles ($controller = '')
    {
        $entrypoints = $this->getControllerEntryPoints($controller ?: $this->getActiveClassName());
        if ($entrypoints) {
            return $this->stripResourceDir($entrypoints->css);
        }
    }

    public function getWebpackJavascriptFiles ($controller = '')
    {
        $entrypoints = $this->getControllerEntryPoints($controller ?: $this->getActiveClassName());
        if ($entrypoints) {
            return $this->stripResourceDir($entrypoints->js);
        }
    }


    public function getWebpackCriticalCSSIdent ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('sCriticalCSSIdent', 'agwebpackthemeloader');
    }

    public function getPreloadAssets ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('aPreloadAssets', 'agwebpackthemeloader');
    }

    protected function stripResourceDir ($files) {
        $resourceDir = $this->getConfig()->getResourceDir(false);
        $dir = str_replace(getShopBasePath(), '/', $resourceDir);
        return array_map(function($d) use ($dir) {
            return str_replace($dir, '', $d);
        }, $files);
    }

    protected function getControllerEntryPoints ($controller)
    {
        $entrypoints = $this->getEntryPoints();
        if ($entrypoints) {
            return $entrypoints->entrypoints->$controller;
        }
    }

    protected function getEntryPoints ()
    {
        if ($this->_oEntryPoints === null) {
            $dir = Registry::getConfig()->getResourceDir(false);
            $entrypoints = $dir . '/entrypoints.json';
            if (file_exists($entrypoints)){
                $this->_oEntryPoints = json_decode(file_get_contents($entrypoints));
            }else{
                $this->_oEntryPoints = false;
            }
        }
        return $this->_oEntryPoints;
    }
}