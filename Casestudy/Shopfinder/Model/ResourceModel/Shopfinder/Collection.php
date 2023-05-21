<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Model\ResourceModel\Shopfinder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'shopfinder_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Casestudy\Shopfinder\Model\Shopfinder::class,
            \Casestudy\Shopfinder\Model\ResourceModel\Shopfinder::class
        );
    }
}

