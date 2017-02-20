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
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Package\PackageInterface;

/**
 * Class BundleInstaller
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class BundleInstaller extends LibraryInstaller
{
    private $developmentMode = false;
    
    public function __construct(IOInterface $io, Composer $composer, bool $developmentMode = false)
    {
        parent::__construct($io, $composer);
        $this->developmentMode = $developmentMode;
    }
    
    public function getInstallPath(PackageInterface $package)
    {
        if (false === $this->developmentMode) {
            $extra = $package->getExtra();
            if (isset($extra['wellcommerce-bundle']['install-dir'])) {
                return $extra['wellcommerce-bundle']['install-dir'];
            } else {
                list($vendor, $package) = explode('/', $package->getRepository());
                
                return 'src/' . $vendor . '/Bundle/' . $package;
            }
        }
    }
    
    public function supports($packageType)
    {
        return 'wellcommerce-bundle' === $packageType;
    }
} 
