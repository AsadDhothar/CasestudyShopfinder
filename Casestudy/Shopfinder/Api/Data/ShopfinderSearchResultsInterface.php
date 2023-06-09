<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Api\Data;

interface ShopfinderSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Shopfinder list.
     * @return \Casestudy\Shopfinder\Api\Data\ShopfinderInterface[]
     */
    public function getItems();

    /**
     * Set shop_name list.
     * @param \Casestudy\Shopfinder\Api\Data\ShopfinderInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

