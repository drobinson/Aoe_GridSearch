<?php
/**
 * Config Source for search level
 *
 * @category   Aoe
 * @package    Aoe_GridSearch
 * @author     David Robinson <david.robinson@aoemedia.com>
 * @since      2013-05-08
 */
class Aoe_GridSearch_Model_System_Config_Source_Regex_Level {

    /**
     * Option constants
     */
    const DEFAULT_SEARCH = 'default';
    const SIMPLE_SEARCH  = 'simple';
    const REGEX_SEARCH   = 'regex';

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray() {
        return array(
            array('value' => self::DEFAULT_SEARCH, 'label' => Mage::helper('core')->__('Default')),
            array('value' => self::SIMPLE_SEARCH, 'label' => Mage::helper('core')->__('Simple')),
            array('value' => self::REGEX_SEARCH, 'label' => Mage::helper('core')->__('Regex')),
        );
    }

}
