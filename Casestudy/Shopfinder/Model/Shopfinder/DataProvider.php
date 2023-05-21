<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Model\Shopfinder;

use Casestudy\Shopfinder\Model\ResourceModel\Shopfinder\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;

class DataProvider extends AbstractDataProvider
{

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @inheritDoc
     */
    protected $collection;


    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = [],
        \Magento\Store\Model\StoreManagerInterface $storeManager
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->storeManager = $storeManager;
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        $baseUrl = $this->storeManager->getStore()
                ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA) . "shopfinder/image/";
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $formLoadedData = $this->loadedData[$model->getId()] = $model->getData();
            if ($formLoadedData['image']){
                $categoryThumbnail = [];
                $categoryThumbnail[0]['name'] = $formLoadedData['image'];
                $categoryThumbnail[0]['url'] = $baseUrl.$formLoadedData['image'];
                $formLoadedData['image'] = $categoryThumbnail;
            }
        }
        $data = $this->dataPersistor->get('casestudy_shopfinder_shopfinder');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('casestudy_shopfinder_shopfinder');
        }else {
            if ($items) {
                $featureUpload[$model->getId()] = $formLoadedData;
                return $featureUpload;
            }
        }

                return $this->loadedData;
    }
}

