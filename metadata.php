<?php

$sMetadataVersion = '2.0';

$aModule = array(
    'id'           => 'agwebpackthemeloader',
    'title'        => 'Aggrosoft Webpack Theme Loader',
    'description'  => 'Allow loading webpack built themes',
    'thumbnail'    => '',
    'version'      => '1.2.2',
    'author'       => 'Aggrosoft GmbH',
    'extend'      => [
        \OxidEsales\Eshop\Core\ViewConfig::class => \Aggrosoft\WebpackThemeLoader\Core\WebpackThemeLoaderViewConfig::class,
        \OxidEsales\Eshop\Core\WidgetControl::class => \Aggrosoft\WebpackThemeLoader\Core\WebpackThemeLoaderWidgetControl::class,
        \OxidEsales\Eshop\Core\ShopControl::class => \Aggrosoft\WebpackThemeLoader\Core\WebpackThemeLoaderShopControl::class,
        \OxidEsales\Eshop\Core\UtilsView::class => \Aggrosoft\WebpackThemeLoader\Core\WebpackThemeLoaderUtilsView::class,
        \OxidEsales\Eshop\Core\ViewHelper\StyleRenderer::class => \Aggrosoft\WebpackThemeLoader\Core\ViewHelper\WebpackThemeLoaderStyleRenderer::class,
        \OxidEsales\Eshop\Application\Controller\Admin\ThemeMain::class => \Aggrosoft\WebpackThemeLoader\Controller\Admin\WebpackThemeMain::class
    ],
    'settings' => [
        ['group' => 'agwebpackthemeloader_main', 'name' => 'aJSBlacklist', 'type' => 'arr', 'value' => ['js/script.min.js', 'js/libs/photoswipe.min.js', 'js/libs/photoswipe-ui-default.min.js', 'js/libs/jquery.flexslider.min.js']],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'aCSSBlacklist', 'type' => 'arr',   'value' => ['css/styles.min.css', 'css/libs/jquery.flexslider.min.css']],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'aPreloadAssets', 'type' => 'arr',   'value' => []],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'sCriticalCSSIdent', 'type' => 'str',   'value' => ''],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'blInlineSVGIcons', 'type' => 'bool',   'value' => false],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'sWebpackFolder', 'type' => 'str',   'value' => ''],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'sYarnBinary', 'type' => 'str',   'value' => 'yarn'],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'sPathEnv', 'type' => 'str',   'value' => ''],
    ],
    'blocks' => [
        ['template' => 'layout/base.tpl','block'=>'base_js','file'=>'/views/blocks/base_js.tpl'],
        ['template' => 'layout/base.tpl','block'=>'base_style','file'=>'/views/blocks/base_style.tpl'],
        ['template' => 'layout/base.tpl','block'=>'base_style','file'=>'/views/blocks/theme_svg_icons.tpl'],
        ['template' => 'theme_main.tpl','block'=>'admin_theme_main_form','file'=>'/views/blocks/admin_theme_main_form.tpl']
    ]
);
