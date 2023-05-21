<?php
Namespace Casestudy\Shopfinder\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;

class CustomGraphql implements ResolverInterface
{

    public function __construct(
        \Casestudy\Shopfinder\Model\ResourceModel\Shopfinder\CollectionFactory $Shopfinder
    ) {
        $this->Shopfinder = $Shopfinder;
    }
    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|\Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     * @throws GraphQlInputException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null)
    {

        $output = [];
            $shopFinderCollection = $this->Shopfinder->create();
            if (!empty($args['identifier'])) {
                $shopFinderCollection->addFieldToFilter('identifier', $args['identifier']);
            }
            foreach ($shopFinderCollection as $shopfinder){
                $output['shop_data'][$shopfinder->getShopfinderId()]['shop_name'] = $shopfinder->getShopName();
                $output['shop_data'][$shopfinder->getShopfinderId()]['identifier'] = $shopfinder->getIdentifier();
                $output['shop_data'][$shopfinder->getShopfinderId()]['country'] = $shopfinder->getCountry();
                $output['shop_data'][$shopfinder->getShopfinderId()]['image'] = "pub/meida/shopfinder/image/".$shopfinder->getImage();
                $output['shop_data'][$shopfinder->getShopfinderId()]['longitude_latitude'] = $shopfinder->getLongitudeLatitude();
            }

        return $output;
    }
}
