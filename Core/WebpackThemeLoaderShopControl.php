<?php

namespace Aggrosoft\WebpackThemeLoader\Core;

use Aggrosoft\WebpackThemeLoader\Core\Smarty\WebpackThemeLoaderPrefilter;

class WebpackThemeLoaderShopControl extends WebpackThemeLoaderShopControl_parent {

    protected $_blSmartySetup = false;

    private function getRenderer()
    {
        $renderer = $this->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();

        if (!$this->_blSmartySetup) {
            $engine = $renderer->getEngine();
            $engine->register_prefilter([WebpackThemeLoaderPrefilter::class, 'prefilter']);
            $this->_blSmartySetup = true;
        }

    }

}