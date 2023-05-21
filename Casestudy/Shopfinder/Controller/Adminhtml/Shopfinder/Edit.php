<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Casestudy\Shopfinder\Controller\Adminhtml\Shopfinder;

class Edit extends \Casestudy\Shopfinder\Controller\Adminhtml\Shopfinder
{

    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Casestudy\Shopfinder\Api\ShopfinderRepositoryInterface $ShopfinderRepositoryInterface
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $coreRegistry);
        $this->ShopfinderRepositoryInterface = $ShopfinderRepositoryInterface;
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('shopfinder_id');

        // 2. Initial checking
        if ($id) {
            $ShopfinderRepositoryInterface = $this->ShopfinderRepositoryInterface->get($id);
            if (!$ShopfinderRepositoryInterface->getId()) {
                $this->messageManager->addErrorMessage(__('This Shopfinder no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('casestudy_shopfinder_shopfinder', $this->ShopfinderRepositoryInterface);

        // 3. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Shopfinder') : __('New Shopfinder'),
            $id ? __('Edit Shopfinder') : __('New Shopfinder')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('Shopfinders'));
        $resultPage->getConfig()->getTitle()->prepend(isset($id) ? __('Edit Shopfinder %1', $ShopfinderRepositoryInterface->getId()) : __('New Shopfinder'));
        return $resultPage;
    }
}

