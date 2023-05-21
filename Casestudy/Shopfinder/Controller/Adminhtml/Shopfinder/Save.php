<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Controller\Adminhtml\Shopfinder;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Casestudy\Shopfinder\Model\ImageUploader $ImageUploader,
        \Casestudy\Shopfinder\Api\ShopfinderRepositoryInterface $ShopfinderRepositoryInterface,
        \Casestudy\Shopfinder\Api\Data\ShopfinderInterface $ShopfinderInterface
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
        $this->ImageUploader = $ImageUploader;
        $this->ShopfinderRepositoryInterface = $ShopfinderRepositoryInterface;
        $this->DataShopfinderInterface = $ShopfinderInterface;
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('shopfinder_id');
            if ($id) {
                $ShopfinderRepositoryInterface = $this->ShopfinderRepositoryInterface->get($id);
            }
            if (isset($data['image'])) {
                $this->ImageUploader->moveFileFromTmp($data['image'][0]['name']);
                $data['image'] = $data['image'][0]['name'];
            }elseif (!isset($data['image']) && $id){
                $data['image'] = '';
            }
            $DataShopfinderInterface = $this->DataShopfinderInterface;
            $DataShopfinderInterface->setData($data);

            try {
                $this->ShopfinderRepositoryInterface->save($DataShopfinderInterface);
                $this->messageManager->addSuccessMessage(__('You saved the Shopfinder.'));
                $this->dataPersistor->clear('casestudy_shopfinder_shopfinder');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['shopfinder_id' => $DataShopfinderInterface->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Shopfinder.'));
            }

            $this->dataPersistor->set('casestudy_shopfinder_shopfinder', $data);
            return $resultRedirect->setPath('*/*/edit', ['shopfinder_id' => $this->getRequest()->getParam('shopfinder_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}

