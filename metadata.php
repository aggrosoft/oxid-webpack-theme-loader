<?php

$sMetadataVersion = '2.0';

$aModule = array(
    'id'           => 'agwebpackthemeloader',
    'title'        => 'Aggrosoft Webpack Theme Loader',
    'description'  => 'Allow loading webpack built themes',
    'thumbnail'    => '',
    'version'      => '1.0.0',
    'author'       => 'Aggrosoft GmbH',
    'extend'      => [
        \OxidEsales\Eshop\Application\Core\ViewConfig::class => \Aggrosoft\WebpackThemeLoader\Core\WebpackThemeLoaderViewConfig::class,
        \OxidEsales\Eshop\Application\Core\UtilsView::class => \Aggrosoft\WebpackThemeLoader\Core\WebpackThemeLoaderUtilsView::class
    ],
    'settings' => [
        ['group' => 'agwebpackthemeloader_main', 'name' => 'aJSBlacklist', 'type' => 'arr', 'value' => ['js/script.min.js']],
        ['group' => 'agwebpackthemeloader_main', 'name' => 'aCSSBlacklist', 'type' => 'arr',   'value' => ['css/styles.min.css']]
    ],
    'blocks' => [
        ['template' => 'layout/base.tpl','block'=>'base_js','file'=>'/views/blocks/base_js.tpl'],
        ['template' => 'layout/base.tpl','block'=>'base_css','file'=>'/views/blocks/base_css.tpl']
    ]
);
