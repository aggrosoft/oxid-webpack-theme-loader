<?php

namespace Aggrosoft\WebpackThemeLoader\Controller\Admin;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Bridge\ModuleSettingBridgeInterface;
use Symfony\Component\Process\Process;

class WebpackThemeMain extends WebpackThemeMain_parent {

    public function webpackCompile () {
        $this->runYarnCommand(['build:prod']);
    }

    public function webpGenerate () {
        $this->runYarnCommand(['generate:webp', '--force']);
    }

    protected function runYarnCommand ($cmd) {
        set_time_limit(0);
        // Turn off output buffering
        ini_set('output_buffering', 'off');
        // Turn off PHP output compression
        ini_set('zlib.output_compression', false);
        ini_set('implicit_flush', true);
        ob_implicit_flush(true);

        // Clear, and turn off output buffering
        while (ob_get_level() > 0) {
            // Get the curent level
            $level = ob_get_level();
            // End the buffering
            ob_end_clean();
            // If the current level has not changed, abort
            if (ob_get_level() == $level) break;
        }

        // Disable apache output buffering/compression
        if (function_exists('apache_setenv')) {
            apache_setenv('no-gzip', '1');
            apache_setenv('dont-vary', '1');
        }

        header("Content-type: text/plain");
        header("Cache-Control: no-cache");

        $moduleSettingBridge = ContainerFactory::getInstance()
            ->getContainer()
            ->get(ModuleSettingBridgeInterface::class);
        $path = $moduleSettingBridge->get('sWebpackFolder', 'agwebpackthemeloader');
        $yarn = $moduleSettingBridge->get('sYarnBinary', 'agwebpackthemeloader');
        $env = $moduleSettingBridge->get('sPathEnv', 'agwebpackthemeloader');
        if ($env) {
            $env = ['PATH' => $env . ':' . getenv('PATH')];
        }

        $process = new Process(array_merge([$yarn], $cmd), null, $env);
        $process->setWorkingDirectory($path);
        $process->setTimeout(0);
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERROR: '.$buffer;
            } else {
                echo $buffer;
            }
            echo str_pad("",1024," ");
            ob_flush();
            flush();
        });
        exit();
    }

}