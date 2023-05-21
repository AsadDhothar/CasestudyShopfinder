<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_GraphQlMutation
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited  (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
declare(strict_types=1);
namespace Casestudy\Shopfinder\Model\Resolver;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\GraphQl\Model\Query\ContextInterface;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
class EditShopData implements ResolverInterface
{

    /**
     * @inheritdoc
     */
    public function __construct(
        \Casestudy\Shopfinder\Api\ShopfinderRepositoryInterface $ShopfinderRepositoryInterface,
        \Casestudy\Shopfinder\Api\Data\ShopfinderInterface $ShopfinderInterface
    ) {
        $this->ShopfinderRepositoryInterface = $ShopfinderRepositoryInterface;
        $this->DataShopfinderInterface = $ShopfinderInterface;
    }
    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        try {

            $ShopfinderId = $args['shopfinder_id'];
            $ShopfinderRepositoryInterface = $this->ShopfinderRepositoryInterface->get($ShopfinderId);


            $ShopName = isset($args['shop_name'])?$args['shop_name']:$ShopfinderRepositoryInterface->getShopName();
            $Identifier = isset($args['identifier'])?$args['identifier']:$ShopfinderRepositoryInterface->getIdentifier();
            $Country = isset($args['country'])?$args['country']:$ShopfinderRepositoryInterface->getCountry();
            $Image = isset($args['image'])?$args['image']:$ShopfinderRepositoryInterface->getImage();
            $LongitudeLatitude = isset($args['longitude_latitude'])?$args['longitude_latitude']:$ShopfinderRepositoryInterface->getLongitudeLatitude();


            if ($ShopfinderRepositoryInterface->getData()) {
                $DataShopfinderInterface = $this->DataShopfinderInterface;
                $DataShopfinderInterface->setShopfinderId($ShopfinderId);
                $DataShopfinderInterface->setShopName($ShopName);
                $DataShopfinderInterface->setIdentifier($Identifier);
                $DataShopfinderInterface->setCountry($Country);
                $DataShopfinderInterface->setImage($Image);
                $DataShopfinderInterface->setLongitudeLatitude($LongitudeLatitude);
                $this->ShopfinderRepositoryInterface->save($DataShopfinderInterface);
                return [
                    'shopfinder_id' => $DataShopfinderInterface->getShopfinderId(),
                    'shop_name' => $DataShopfinderInterface->getShopName(),
                    'identifier' => $DataShopfinderInterface->getIdentifier(),
                    'country' => $DataShopfinderInterface->getCountry(),
                    'image' => "pub/meida/shopfinder/image/".$DataShopfinderInterface->getImage(),
                    'longitude_latitude' => $DataShopfinderInterface->getLongitudeLatitude()
                ];
            } else {
                throw new GraphQlNoSuchEntityException(
                    __('Shoper with shop id %1 not found',                                          $ShopfinderId));
            }
        } catch (NoSuchEntityException $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        } catch (LocalizedException $e) {
            throw new GraphQlNoSuchEntityException(__($e->getMessage()));
        }
    }
}
