<?php
namespace Nosto\Tagging\Test\_util;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable;
use Magento\Framework\DataObject;
use Magento\Framework\ObjectManagerInterface;
use Magento\Catalog\Model\Product\Visibility;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\TestFramework\Helper\Bootstrap;
use Magento\Catalog\Model\Product\Type;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableType;
use Magento\Framework\Data\Collection;

class ProductBuilder extends AbstractBuilder implements BuilderInterface
{
    /**
     * @var Product
     */
    private $product;

    public function __construct(ObjectManagerInterface $manager)
    {
        parent::__construct($manager);

        /** @var Product $product */
        $this->product = $manager->create('Magento\Catalog\Model\Product');
    }

    /**
     * @return $this
     */
    public function defaultSimple()
    {
        $this->product->setTypeId(Type::TYPE_SIMPLE)
            ->setId(123)
            ->setAttributeSetId(4)
            ->setWebsiteIds([1])
            ->setName('Nosto Simple Product')
            ->setSku('nosto-simple-sku')
            ->setPrice(10)
            ->setMetaTitle('Nosto Meta Title')
            ->setMetaKeyword('Nosto Mesta Keywords')
            ->setDescription('Nosto Product Description')
            ->setMetaDescription('Nosto Meta Descripption')
            ->setVisibility(Visibility::VISIBILITY_BOTH)
            ->setStatus(Status::STATUS_ENABLED)
            ->setStockData(['use_config_manage_stock' => 0])
            ->setSpecialPrice('5.99');

        return $this;
    }

    /**
     * @return $this
     */
    public function defaultConfigurable()
    {
        $this->product->setTypeId(ConfigurableType::TYPE_CODE)
            ->setId(404)
            ->setAttributeSetId(4)
            ->setWebsiteIds([1])
            ->setName('Configurable Product 404')
            ->setSku('configurable')
            ->setVisibility(Visibility::VISIBILITY_BOTH)
            ->setStatus(Status::STATUS_ENABLED)
            ->setUrlKey('nosto-configurable-product-404')
            ->setDescription('Nosto Configurable Product Description')
            ->setStockData(['use_config_manage_stock' => 1, 'is_in_stock' => 1]);

        $configurableProductsData[5] = array(
            '0' => array(
                'label' => 'Red', //attribute label
                'attribute_id' => 1, //color attribute id
                'value_index' => '193',
                'is_percent' => 0,
                'pricing_value' => '10',
            )
        );
        $configurableProductsData[6] = array(
            '0' => array(
                'label' => 'Green', //attribute label
                'attribute_id' => 2, //color attribute id
                'value_index' => '193',
                'is_percent' => 0,
                'pricing_value' => '10',
            )
        );
        $configurableProductsData[7] = array(
            '0' => array(
                'label' => 'Blue', //attribute label
                'attribute_id' => 2, //color attribute id
                'value_index' => '193',
                'is_percent' => 0,
                'pricing_value' => '10',
            )
        );
        $this->product->setConfigurableProductsData($configurableProductsData);

        return $this;
    }

    /**
     * @return Product
     */
    public function build()
    {
        return $this->product;
    }
}