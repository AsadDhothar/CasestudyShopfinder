<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Controller\Adminhtml\Shopfinder;

class InlineEdit extends \Magento\Backend\App\Action
{

    protected $jsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Casestudy\Shopfinder\Api\ShopfinderRepositoryInterface $ShopfinderRepositoryInterface,
        \Casestudy\Shopfinder\Api\Data\ShopfinderInterface $ShopfinderInterface
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->ShopfinderRepositoryInterface = $ShopfinderRepositoryInterface;
        $this->DataShopfinderInterface = $ShopfinderInterface;
    }

    /**
     * Inline edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $modelid) {
                    $ShopfinderRepositoryInterface = $this->ShopfinderRepositoryInterface->get($modelid);
                    try {
                        $DataShopfinderInterface = $this->DataShopfinderInterface;
                        $DataShopfinderInterface->setData(array_merge($ShopfinderRepositoryInterface->getData(), $postItems[$modelid]));
                        $this->ShopfinderRepositoryInterface->save($DataShopfinderInterface);
                    } catch (\Exception $e) {
                        $messages[] = "[Shopfinder ID: {$modelid}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}

