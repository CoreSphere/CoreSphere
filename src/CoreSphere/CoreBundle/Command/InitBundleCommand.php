<?php

/*
 * This file is part of the CoreSphere\CoreBundle
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace CoreSphere\CoreBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * CreateBundleCommand.
 *
 * @author  Laszlo Korte <me@laszlokorte.de>
 */
class InitBundleCommand extends Command {

    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('coresphere:init:bundle')
            ->setDescription('Create a new Bundle for CoreSphere')
            ->setDefinition(array(
                new InputArgument('name', InputArgument::REQUIRED, 'The bundles name without Bundle postfix'),
            ))
            ->setHelp(<<<EOT
The <info>coresphere:init:bundle</info> creates a new bundle to be used with CoreSphere:

<info>php app/console coresphere:init:bundle Article</info>
EOT
            );
    }

    /**
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $command = $this->getApplication()->find('init:bundle');

        $arguments = array(
            'namespace' => 'CoreSphere\\' . $input->getArgument('name') . 'Bundle',
            'dir'   => 'vendor/bundles',
            NULL
        );

        $input = new ArrayInput($arguments);
        $returnCode = $command->run($input, $output);
    }

}