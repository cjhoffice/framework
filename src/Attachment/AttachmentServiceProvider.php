<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2016, iBenchu.org
 * @datetime 2016-11-02 15:55
 */
namespace Notadd\Foundation\Attachment;

use Illuminate\Events\Dispatcher;
use Notadd\Foundation\Attachment\Listeners\CsrfTokenRegister;
use Notadd\Foundation\Attachment\Listeners\RouteRegister;
use Notadd\Foundation\Http\Abstracts\ServiceProvider;

/**
 * Class AttachmentServiceProvider.
 */
class AttachmentServiceProvider extends ServiceProvider
{
    /**
     * Boot service provider.
     */
    public function boot()
    {
        $this->app->make(Dispatcher::class)->subscribe(CsrfTokenRegister::class);
        $this->app->make(Dispatcher::class)->subscribe(RouteRegister::class);
    }
}
