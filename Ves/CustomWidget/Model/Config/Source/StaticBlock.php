<?php
namespace Ves\CustomWidget\Model\Config\Source;


class StaticBlock implements \Magento\Framework\Option\ArrayInterface
{
	protected $_blockFactory;
	protected $_logger;
	protected $_widgetFactory;

	public function __construct(
        \Magento\Cms\Model\BlockFactory $blockFactory,
        \Magento\Widget\Model\Widget\InstanceFactory $widgetFactory,
        \Psr\Log\LoggerInterface $logger
    ) 
    {
    	$this->_logger = $logger;
        $this->_blockFactory = $blockFactory;
        $this->_widgetFactory = $widgetFactory;
    
    }
    public function toOptionArray()
    {
    	
    	$return = [];
    	$blockCollection = $this->_blockFactory->create()->getCollection();
    	$widgetFactory = $this->_widgetFactory->create()->getCollection();
    	foreach ($widgetFactory as $block) {
    		$this->_logger->info(print_r($block->getData(),true));
    	}
    	foreach ($blockCollection as $block) {
    		$return[] = [
    			'value' => $block->getData('block_id'), 
    			'label' => $block->getData('title')
    		];

    		$this->_logger->info(print_r($block->getData(),true));
    	}
    	
        return $return;
    }
}