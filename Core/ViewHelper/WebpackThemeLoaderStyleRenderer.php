<?php

namespace Aggrosoft\WebpackThemeLoader\Core\ViewHelper;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleSettingBridgeInterface;

class WebpackThemeLoaderStyleRenderer extends WebpackThemeLoaderStyleRenderer_parent {

    protected function formStylesOutput($styles)
    {
        if (!isAdmin() && $this->getWebpackCriticalCSSIdent()) {
            $preparedStyles = [];
            $template = '<link rel="preload" type="text/css" href="%s" as="style" onload="this.onload=null;this.rel=\'stylesheet\'" />';
            foreach ($styles as $style) {
                $preparedStyles[] = sprintf($template, $style);
            }
            $critical = '<style>' . $this->getWebpackCriticalCSS() . '</style>';
            return $critical . PHP_EOL . implode(PHP_EOL, $preparedStyles);
        }else{
            return parent::formStylesOutput($styles);
        }

    }

    protected function getWebpackCriticalCSSIdent ()
    {
        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        return $moduleSettingBridge->get('sCriticalCSSIdent', 'agwebpackthemeloader');
    }

    protected function getWebpackCriticalCSS ()
    {
        $ident = $this->getWebpackCriticalCSSIdent();
        $oContent = oxNew(\OxidEsales\Eshop\Application\Model\Content::class);
        $blRes = $oContent->loadByIdent($ident);
        return $oContent->oxcontents__oxcontent->rawValue;
    }

}