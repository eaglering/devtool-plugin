<?php

namespace Elite\Plugins\Devtool\Command;

use Elite\Plugins\Devtool\Model\Logic\SchemaLogic;
use ESD\Core\Context\Context;
use ESD\Core\DI\DI;
use ESD\Core\Plugins\Config\ConfigContext;
use ESD\Plugins\Console\ConsolePlugin;
use ESD\Plugins\Mysql\GetMysql;
use ESD\Plugins\Mysql\MysqlConfig;
use ESD\Plugins\Mysql\MysqliDb;
use ESD\Plugins\Mysql\MysqlOneConfig;
use ESD\Plugins\Mysql\MysqlPlugin;
use ESD\Server\Co\Server;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class EntityCmd extends Command
{
    use GetMysql;

    /**
     * @var Context
     */
    private $context;

    /**
     * StartCmd constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct();
        $this->context = $context;
    }

    protected function configure()
    {
        $this->setName('entity')->setDescription("Entity generator");
        $this->addArgument('pool', InputArgument::OPTIONAL, 'database db pool?', 'default');
        $this->addOption('table', 't', InputOption::VALUE_OPTIONAL|InputOption::VALUE_IS_ARRAY, 'database table name?', []);
        $this->addOption('path', 'p', InputOption::VALUE_OPTIONAL, 'generate entity file path?', '@app/Model/Entity');
        $this->addOption('template', 'a', InputOption::VALUE_OPTIONAL, 'generate entity template path?', '@devtool/resources');
        $this->addOption('confirm', 'y', InputOption::VALUE_NONE, 'confirm execution?');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null
     * @throws \ESD\Core\Exception
     * @throws \ESD\Plugins\Mysql\MysqlException
     * @throws \ReflectionException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $pool = $input->getArgument('pool');
        $tables = $input->getOption('table');
        $path = $input->getOption('path');
        $tpl = $input->getOption('template');
        $confirm = $input->getOption('confirm');

        $schemaLogic = new SchemaLogic($pool, $io);
        $schemaLogic->create($path, $tpl, $tables, $confirm);

        return ConsolePlugin::SUCCESS_EXIT;
    }
}