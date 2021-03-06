<?php

/*
 * This file is part of the Symfony framework.
 *
 * (c) Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Symfony\Bundle\AsseticBundle\Factory;

use Assetic\Factory\AssetFactory as BaseAssetFactory;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Loads asset formulae from the filesystem.
 *
 * @author Kris Wallsmith <kris.wallsmith@symfony-project.com>
 */
class AssetFactory extends BaseAssetFactory
{
    protected $kernel;

    public function __construct(Kernel $kernel, $baseDir, $debug = false)
    {
        $this->kernel = $kernel;

        parent::__construct($baseDir, $debug);
    }

    protected function parseAsset($sourceUrl)
    {
        // expand bundle notation
        if ('@' == $sourceUrl[0] && false !== strpos($sourceUrl, '/')) {
            $sourceUrl = $this->kernel->locateResource($sourceUrl);
        }

        return parent::parseAsset($sourceUrl);
    }
}
