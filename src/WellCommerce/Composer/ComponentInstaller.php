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
 * Class ComponentInstaller
 *
 * @author Adam Piotrowski <adam@wellcommerce.org>
 */
class ComponentInstaller extends LibraryInstaller
{
    private $developmentMode = false;
    
    public function __construct(IOInterface $io, Composer $composer, bool $developmentMode = false)
    {
        parent::__construct($io, $composer);
        $this->developmentMode = $developmentMode;
    }
    
    public function getInstallPath(PackageInterface $package)
    {
        if ($this->developmentMode) {
            return parent::getInstallPath($package);
        }
        
        $extra = $package->getExtra();
        if (isset($extra['wellcommerce-component']['install-dir'])) {
            return $extra['wellcommerce-component']['install-dir'];
        } else {
            list($vendor, $package) = explode('/', $package->getRepository());
            
            return 'src/' . $vendor . '/Component/' . $package;
        }
    }
    
    public function supports($packageType)
    {
        return 'wellcommerce-component' === $packageType;
    }
} 
