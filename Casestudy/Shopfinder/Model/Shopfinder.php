<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Model;

use Casestudy\Shopfinder\Api\Data\ShopfinderInterface;
use Magento\Framework\Model\AbstractModel;

class Shopfinder extends AbstractModel implements ShopfinderInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Casestudy\Shopfinder\Model\ResourceModel\Shopfinder::class);
    }

    /**
     * @inheritDoc
     */
    public function getShopfinderId()
    {
        return $this->getData(self::SHOPFINDER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setShopfinderId($shopfinderId)
    {
        return $this->setData(self::SHOPFINDER_ID, $shopfinderId);
    }

    /**
     * @inheritDoc
     */
    public function getShopName()
    {
        return $this->getData(self::SHOP_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setShopName($shopName)
    {
        return $this->setData(self::SHOP_NAME, $shopName);
    }

    /**
     * @inheritDoc
     */
    public function getIdentifier()
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * @inheritDoc
     */
    public function setIdentifier($identifier)
    {
        return $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * @inheritDoc
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * @inheritDoc
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @inheritDoc
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

    /**
     * @inheritDoc
     */
    public function getLongitudeLatitude()
    {
        return $this->getData(self::LONGITUDE_LATITUDE);
    }

    /**
     * @inheritDoc
     */
    public function setLongitudeLatitude($longitudeLatitude)
    {
        return $this->setData(self::LONGITUDE_LATITUDE, $longitudeLatitude);
    }
}

