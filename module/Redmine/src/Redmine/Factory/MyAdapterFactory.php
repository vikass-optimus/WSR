<?php
namespace Redmine\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Db\Adapter\Adapter;

class MyAdapterFactory implements FactoryInterface
{

  protected $configKey;

  public function __construct($key)
  {
      $this->configKey = $key;
  }

  public function createService(ServiceLocatorInterface $serviceLocator)
  {
      $config = $serviceLocator->get('Config');
      return new Adapter($config[$this->configKey]);
  }
}