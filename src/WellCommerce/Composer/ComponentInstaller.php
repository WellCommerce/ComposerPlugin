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
    private $isDevelopmentMode = false;
    private $isInstall         = false;
    
    public function __construct(IOInterface $io, Composer $composer, bool $isDevelopmentMode = false)
    {
        parent::__construct($io, $composer);
        $this->isDevelopmentMode = $isDevelopmentMode;
    }
    
    public function getInstallPath(PackageInterface $package)
    {
        if ($this->isInstall && $this->isDevelopmentMode) {
            return parent::getInstallPath($package);
        }
        
        return $package->getExtra()['wellcommerce-component']['install-dir'];
    }
    
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $this->isInstall = true;
        parent::install($repo, $package);
    }
    
    public function update(InstalledRepositoryInterface $repo, PackageInterface $initial, PackageInterface $target)
    {
        $this->isInstall = true;
        parent::install($repo, $package);
    }
    
    public function supports($packageType)
    {
        return 'wellcommerce-component' === $packageType;
    }
} 
