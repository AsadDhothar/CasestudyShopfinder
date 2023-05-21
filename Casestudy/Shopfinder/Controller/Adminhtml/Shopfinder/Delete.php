<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Controller\Adminhtml\Shopfinder;

class Delete extends \Casestudy\Shopfinder\Controller\Adminhtml\Shopfinder
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Casestudy\Shopfinder\Api\ShopfinderRepositoryInterface $ShopfinderRepositoryInterface
    ) {
        $this->ShopfinderRepositoryInterface = $ShopfinderRepositoryInterface;
        parent::__construct($context,$coreRegistry);
    }
    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('shopfinder_id');
        if ($id) {
            try {
                // init model and delete
                $ShopfinderRepositoryInterface = $this->ShopfinderRepositoryInterface->get($id);
                $this->ShopfinderRepositoryInterface->delete($ShopfinderRepositoryInterface);
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Shopfinder.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['shopfinder_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Shopfinder to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}

