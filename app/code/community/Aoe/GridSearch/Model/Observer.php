<?php
/**
 * Aoe_GridSearch Observer
 *
 * @author David Robinson <david.robinson@aoe.com>
 * @since 2015-03-06
 */

class Aoe_GridSearch_Model_Observer extends Mage_Core_Model_Observer
{
    /**
     * Sends reload response if needed
     *
     * @param Varien_Event_Observer $event
     * @return void
     */
    public function coreBlockAbstractToHtmlAfter(Varien_Event_Observer $event)
    {
        $block = $event->getBlock();
        if (($regex = Mage::registry('aoe_gridsearch_invalid_regex'))
            && $block instanceof Mage_Adminhtml_Block_Widget_Grid
            && Mage::app()->getRequest()->getQuery('ajax')
        ) {
            $response = array(
                'error' => true,
                'message' => 'Invalid Expression "' . $regex . '"'
            );

            $transportObject = $event->getTransport(); /* @var Varien_Object $transportObject */
            $transportObject->setHtml(json_encode($response));
            Mage::unregister('aoe_gridsearch_invalid_regex');
        }
    }
}
