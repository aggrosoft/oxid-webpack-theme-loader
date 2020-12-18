<?php

namespace Aggrosoft\WebpackThemeLoader\Core;

use Aggrosoft\WebpackThemeLoader\Core\Smarty\WebpackThemeLoaderPrefilter;

class WebpackThemeLoaderUtilsView extends WebpackThemeLoaderUtilsView_parent
{
    protected function _fillCommonSmartyProperties($oSmarty)
    {
        parent::_fillCommonSmartyProperties($oSmarty);
        $oSmarty->register_prefilter([WebpackThemeLoaderPrefilter::class, 'prefilter']);
    }
}