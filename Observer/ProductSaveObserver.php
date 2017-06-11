<?php
/**
 * Faonni
 *  
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade module to newer
 * versions in the future.
 * 
 * @package     Faonni_SmartCategorySale
 * @copyright   Copyright (c) 2017 Karliuka Vitalii(karliuka.vitalii@gmail.com) 
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
namespace Faonni\SmartCategorySale\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Faonni\ProductSaleIndexer\Model\Indexer\Product\SaleIndexer;

/**
 * Product save observer
 */
class ProductSaveObserver implements ObserverInterface
{
    /**
     * Sale Indexer instance
     *
     * @var \Faonni\ProductSaleIndexer\Model\Indexer\Product\SaleIndexer
     */
    protected $_indexer;         
    
    /**
	 * Initialize plugin
	 *	
     * @param SaleIndexer $indexer
     */
    public function __construct(
        SaleIndexer $indexer
    ) {
        $this->_indexer = $indexer;
    }
       	
    /**
     * Reindex sale after product model save
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
		$product = $observer->getEvent()->getProduct();		
        if (!$product->getIsMassupdate()) {           
			$this->_indexer->executeRow($product->getId());
        }
        return $this;
    }
}  
