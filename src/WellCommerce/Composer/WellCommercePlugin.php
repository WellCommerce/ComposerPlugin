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

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 * Class WellCommercePlugin
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class WellCommercePlugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io)
    {
        $developmentMode = $io->askConfirmation("Do you want to enable development mode? (yes/no) ", false);
        
        $bundleInstaller = new BundleInstaller($io, $composer, $developmentMode);
        $composer->getInstallationManager()->addInstaller($bundleInstaller);
        
        $componentInstaller = new ComponentInstaller($io, $composer, $developmentMode);
        $composer->getInstallationManager()->addInstaller($componentInstaller);
        
        $themeInstaller = new ThemeInstaller($io, $composer);
        $composer->getInstallationManager()->addInstaller($themeInstaller);
    }
}
