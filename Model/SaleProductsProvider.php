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
namespace Faonni\SmartCategorySale\Model;

use Magento\Framework\App\ResourceConnection;
use Magento\Catalog\Model\ResourceModel\Product\Collection;

/**
 * Faonni_SmartCategory SaleProductsProvider
 */
class SaleProductsProvider
{
    /** 
     * Resource Connection
     * 
     * @var \Magento\Framework\App\ResourceConnection 
     */
    protected $_resource;
    
    /**
     * Initialize provider
     * 
     * @param ResourceConnection $resource
     */
    public function __construct(
		ResourceConnection $resource
	) {
        $this->_resource = $resource;
    }

    /**
     * Add collection filters by sale
     *
     * @param Collection $collection
     * @return $this
     */
    public function addSaleFilter(Collection $collection)
    {
		$collection->getSelect()->join(
			['sale' => $this->_resource->getTableName('faonni_catalog_product_index_sale')],
			'sale.entity_id=e.entity_id', 
			[]
		); 				
        return $this;
    }
}
