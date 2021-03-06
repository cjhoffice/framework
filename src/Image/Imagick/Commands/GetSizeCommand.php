<?php
/**
 * This file is part of Notadd.
 *
 * @author TwilRoad <269044570@qq.com>
 * @copyright (c) 2017, iBenchu.org
 * @datetime 2017-02-10 18:56
 */
namespace Notadd\Foundation\Image\Imagick\Commands;

use Notadd\Foundation\Image\Commands\AbstractCommand;
use Notadd\Foundation\Image\Size;

/**
 * Class GetSizeCommand.
 */
class GetSizeCommand extends AbstractCommand
{
    /**
     * @param \Notadd\Foundation\Image\Image $image
     *
     * @return bool
     */
    public function execute($image)
    {
        $core = $image->getCore();
        $this->setOutput(new Size($core->getImageWidth(), $core->getImageHeight()));

        return true;
    }
}
