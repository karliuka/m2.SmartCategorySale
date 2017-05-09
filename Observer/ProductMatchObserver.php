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
use Faonni\SmartCategorySale\Model\SaleProductsProvider;

/**
 * Product match observer
 */
class ProductMatchObserver implements ObserverInterface
{
    /**
     * Sale Products Provider
     *  
     * @var \Faonni\SmartCategorySale\Model\SaleProductsProvider
     */
    protected $_saleProductsProvider;
    
    /**
     * Initialize observer
     * 
     * @param SaleProductsProvider $saleProductsProvider
     */
    public function __construct(
        SaleProductsProvider $saleProductsProvider
    ) {
        $this->_saleProductsProvider = $saleProductsProvider;
    }    
    		
    /**
     * Handler for product match event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {		
		$rule = $observer->getEvent()->getRule();
		$object = $rule->getCategory() ?: $rule;
		
		if ($object->getFilterSale()) {
			$collection = $observer->getEvent()->getCollection();
			$this->_saleProductsProvider->addSaleFilter($collection);					
		}
        return $this;
    }
}  
