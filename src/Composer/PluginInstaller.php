<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */
namespace WellCommerce\Composer;

use Composer\Installer\LibraryInstaller;

/**
 * Class PluginInstaller
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class PluginInstaller extends LibraryInstaller
{
    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return 'wellcommerce-plugin' === $packageType;
    }
} 