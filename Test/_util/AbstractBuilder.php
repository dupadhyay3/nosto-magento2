<?php
namespace Nosto\Tagging\Test\_util;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableType;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\TestFramework\Helper\Bootstrap;
use Magento\Catalog\Model\Product\Type;
use Magento\Framework\Data\Collection;

abstract class AbstractBuilder
{
    /**
     * @var Product
     */
    protected $objectManager;

    public function __construct(ObjectManagerInterface $manager)
    {
        $this->objectManager = $manager;
    }
}