<?php
/**
 * This file is part of Notadd.
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-11-03 10:13
 */
namespace Notadd\Foundation\Composer\Commands;
use Notadd\Foundation\Composer\Abstracts\Command;
/**
 * Class UpdateCommand
 * @package Notadd\Foundation\Composer\Commands
 */
class UpdateCommand extends Command {
    /**
     * @return void
     */
    public function configure() {
        $this->setDescription('The Default Composer Update Command');
        $this->setName('composer:update');
    }
    /**
     * @return void
     */
    public function fire() {
        $this->updateComposer();
    }
}