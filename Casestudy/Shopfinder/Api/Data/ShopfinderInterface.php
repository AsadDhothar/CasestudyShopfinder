<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Api\Data;

interface ShopfinderInterface
{

    const IDENTIFIER = 'identifier';
    const COUNTRY = 'country';
    const SHOPFINDER_ID = 'shopfinder_id';
    const IMAGE = 'image';
    const SHOP_NAME = 'shop_name';
    const LONGITUDE_LATITUDE = 'longitude_latitude';

    /**
     * Get shopfinder_id
     * @return string|null
     */
    public function getShopfinderId();

    /**
     * Set shopfinder_id
     * @param string $shopfinderId
     * @return \Casestudy\Shopfinder\Shopfinder\Api\Data\ShopfinderInterface
     */
    public function setShopfinderId($shopfinderId);

    /**
     * Get shop_name
     * @return string|null
     */
    public function getShopName();

    /**
     * Set shop_name
     * @param string $shopName
     * @return \Casestudy\Shopfinder\Shopfinder\Api\Data\ShopfinderInterface
     */
    public function setShopName($shopName);

    /**
     * Get identifier
     * @return string|null
     */
    public function getIdentifier();

    /**
     * Set identifier
     * @param string $identifier
     * @return \Casestudy\Shopfinder\Shopfinder\Api\Data\ShopfinderInterface
     */
    public function setIdentifier($identifier);

    /**
     * Get country
     * @return string|null
     */
    public function getCountry();

    /**
     * Set country
     * @param string $country
     * @return \Casestudy\Shopfinder\Shopfinder\Api\Data\ShopfinderInterface
     */
    public function setCountry($country);

    /**
     * Get image
     * @return string|null
     */
    public function getImage();

    /**
     * Set image
     * @param string $image
     * @return \Casestudy\Shopfinder\Shopfinder\Api\Data\ShopfinderInterface
     */
    public function setImage($image);

    /**
     * Get longitude_latitude
     * @return string|null
     */
    public function getLongitudeLatitude();

    /**
     * Set longitude_latitude
     * @param string $longitudeLatitude
     * @return \Casestudy\Shopfinder\Shopfinder\Api\Data\ShopfinderInterface
     */
    public function setLongitudeLatitude($longitudeLatitude);
}

