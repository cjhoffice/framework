<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-03-10 14:12
 */
namespace Notadd\Foundation\Module\Abstracts;

use Illuminate\Container\Container;
use Illuminate\Support\Collection;
use Notadd\Foundation\Module\Module;
use Notadd\Foundation\Setting\Contracts\SettingsRepository;
use Notadd\Foundation\Translation\Translator;

/**
 * Class Installer.
 */
abstract class Installer
{
    /**
     * @var Container
     */
    protected $container;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $info;

    /**
     * @var \Notadd\Foundation\Module\Module
     */
    protected $module;

    /**
     * @var \Notadd\Foundation\Setting\Contracts\SettingsRepository
     */
    protected $settings;

    /**
     * @var \Notadd\Foundation\Translation\Translator
     */
    protected $translator;

    /**
     * Installer constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->info = new Collection();
        $this->settings = $this->container->make(SettingsRepository::class);
        $this->translator = $this->container->make(Translator::class);
    }

    /**
     * @return bool
     */
    abstract public function handle();

    /**
     * Return output info for installation.
     *
     * @return \Illuminate\Support\Collection
     */
    public function info()
    {
        return $this->info;
    }

    /**
     * @return bool
     */
    public final function install()
    {
        if ($this->settings->get('module.' . $this->module->getIdentification() . '.installed', false)) {
            $this->info->put('errors', '模块标识[]已经被占用，如需继续安装，请卸载同标识插件！');

            return false;
        }

        $requires = collect($this->require());
        $noInstalled = new Collection();
        $requires->each(function ($require) use ($noInstalled) {
            if (!$this->settings->get('module.' . $require . '.installed', false)) {
                $noInstalled->push($require);
            }
        });

        if ($noInstalled->isNotEmpty()) {
            $this->info->put('errors', '依赖的模块[' . $noInstalled->implode(',') . ']尚未安装！');

            return false;
        }

        if (!$this->require()) {
            return false;
        }

        return $this->handle();
    }

    /**
     * @return array
     */
    abstract public function require ();

    /**
     * @param \Notadd\Foundation\Module\Module $module
     */
    public function setModule(Module $module)
    {
        $this->module = $module;
    }
}