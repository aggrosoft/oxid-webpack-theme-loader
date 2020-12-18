<?php

namespace Aggrosoft\WebpackThemeLoader\Core;

use OxidEsales\Eshop\Core\Registry;

class WebpackThemeLoaderViewConfig extends WebpackThemeLoaderViewConfig_parent
{
    protected $_oEntryPoints = null;

    public function getWebpackCSSFiles ($controller = '')
    {
        $entrypoints = $this->getControllerEntryPoints($controller ?: $this->getActiveClassName());
        if ($entrypoints) {
            return $entrypoints->css;
        }
    }

    public function getWebpackJavascriptFiles ($controller = '')
    {
        $entrypoints = $this->getControllerEntryPoints($controller ?: $this->getActiveClassName());
        if ($entrypoints) {
            return $entrypoints->js;
        }
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