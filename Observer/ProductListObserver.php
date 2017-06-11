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

/**
 * Product list observer
 */
class ProductListObserver implements ObserverInterface
{	
    /**
     * Handler for product match event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {		
		$collection = $observer->getEvent()->getCollection();
		$select = $collection->getSelect();
		$connection = $select->getConnection();	
		
		$select	
			->joinLeft(
				['sale_index' => $collection->getTable('faonni_catalog_product_index_sale')],
				join(
					' AND ',
					[
						'e.entity_id = sale_index.entity_id',
						'price_index.website_id = sale_index.website_id'
					]
				),				
				[]
			)
			->where('(smart_category.rule_id IS NOT NULL AND sale_flag.entity_id IS NOT NULL) OR smart_category.rule_id IS NULL');		
			
        return $this;
    }
}  
