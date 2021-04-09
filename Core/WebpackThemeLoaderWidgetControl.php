<?php

namespace Aggrosoft\WebpackThemeLoader\Core;

use Aggrosoft\WebpackThemeLoader\Core\Smarty\WebpackThemeLoaderPrefilter;
use OxidEsales\EshopCommunity\Internal\Framework\Templating\TemplateRendererBridgeInterface;

class WebpackThemeLoaderWidgetControl extends WebpackThemeLoaderWidgetControl_parent {

    protected $_blSmartySetup = false;

    protected function _render($view) // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
    {
        $this->setupRenderer();
        return parent::_render($view);
    }

    private function setupRenderer()
    {
        $renderer = $this->getContainer()
            ->get(TemplateRendererBridgeInterface::class)
            ->getTemplateRenderer();

        if (!$this->_blSmartySetup) {
            $engine = $renderer->getTemplateEngine();
            $engine->getSmarty()->register_prefilter([WebpackThemeLoaderPrefilter::class, 'prefilter']);
            $this->_blSmartySetup = true;
        }

    }

}