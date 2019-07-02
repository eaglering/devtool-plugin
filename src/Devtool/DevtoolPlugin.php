<?php
namespace Elite\Plugins\Devtool;

use Elite\Plugins\Devtool\Command\EntityCmd;
use ESD\Core\Context\Context;
use ESD\Core\PlugIn\AbstractPlugin;
use ESD\Core\PlugIn\PluginInterfaceManager;
use ESD\Plugins\Console\ConsoleConfig;
use ESD\Plugins\Console\ConsolePlugin;
use ESD\Plugins\Mysql\MysqlPlugin;

class DevtoolPlugin extends AbstractPlugin
{
    /**
     * @var DevtoolConfig
     */
    private $devtoolConfig;

    /**
     * 获取插件名字
     * @return string
     */
    public function getName(): string
    {
        return 'Devtool';
    }

    /**
     * ConsolePlugin constructor.
     * @param DevtoolConfig|null $devtoolConfig
     */
    public function __construct(?DevtoolConfig $devtoolConfig = null)
    {
        parent::__construct();
        $this->atAfter(ConsolePlugin::class);
        if ($devtoolConfig == null) {
            $devtoolConfig = new DevtoolConfig();
        }
        $this->devtoolConfig = $devtoolConfig;
    }

    /**
     * @param PluginInterfaceManager $pluginInterfaceManager
     * @return mixed|void
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     * @throws \ESD\Core\Exception
     * @throws \ESD\Core\Plugins\Config\ConfigException
     * @throws \ReflectionException
     */
    public function onAdded(PluginInterfaceManager $pluginInterfaceManager)
    {
        parent::onAdded($pluginInterfaceManager);
        $pluginInterfaceManager->addPlug(new ConsolePlugin());
        //添加一个cmd
        $console = new ConsoleConfig();
        $console->addCmdClass(EntityCmd::class);
        $console->merge();
    }

    /**
     * 在服务启动前
     * @param Context $context
     * @return mixed
     * @throws \Exception
     */
    public function beforeServerStart(Context $context)
    {
        return;
    }

    /**
     * 在进程启动前
     * @param Context $context
     * @return mixed
     */
    public function beforeProcessStart(Context $context)
    {
        $this->ready();
    }
}