<?php

namespace Bro\Code;

use Symfony\CS\Console\Application;
use Symfony\Component\Console\Input\InputOption;

class CsFixerFactory
{
    /**
     * @param array $config
     *
     * @return Application
     */
    public function create(array $config)
    {
        $broLibPath = dirname(dirname($config['binFilePath']));
        $preset = $config['preset'];

        $vendoredPath = $broLibPath . '/../../bro/code';

        $application = new Application();

        if (file_exists($vendoredPath)) {
            $broLibPath = $vendoredPath;
        }

        $broConfigPath = $broLibPath . '/presets/' . basename($preset) . '.php';
        $this->extendApplication($application, $broConfigPath);

        return $application;
    }

    private function extendApplication(Application $application, $defaultConfigFile)
    {
        if (file_exists($defaultConfigFile)) {
            $fixCommand = $application->find('fix');
            /* @var InputOption $configFile */
            $definition = $fixCommand->getDefinition();
            $options = $definition->getOptions();
            $options['config-file']->setDefault(realpath($defaultConfigFile));
        }
    }
}
