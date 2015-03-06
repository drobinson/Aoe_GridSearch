<?php
/**
 * Text grid column filter
 *
 * @category   Aoe
 * @package    Aoe_GridSearch
 * @author     David Robinson <david.robinson@aoemedia.com>
 * @since      2013-05-08
 */
class Aoe_GridSearch_Block_Adminhtml_Widget_Grid_Column_Filter_Text extends Mage_Adminhtml_Block_Widget_Grid_Column_Filter_Text
{
    /**
     * Retrieve condition
     *
     * @return array
     */
    public function getCondition()
    {
        $searchLevel = Mage::getStoreConfig(Aoe_GridSearch_Helper_Data::SEARCHLEVEL_CONFIG_PATH);
        $expression = null;

        if ($searchLevel == Aoe_GridSearch_Model_System_Config_Source_Regex_Level::DEFAULT_SEARCH) {

            $helper = Mage::getResourceHelper('core');
            $expression = array('like' => $helper->addLikeEscape($this->getValue(), array('position' => 'any')));

        } elseif ($searchLevel == Aoe_GridSearch_Model_System_Config_Source_Regex_Level::SIMPLE_SEARCH) {

            $helper = Mage::Helper('aoe_gridsearch');
            $expression = array('regexp' => $helper->parseSimpleToExpression($this->getValue()));

        } elseif ($searchLevel == Aoe_GridSearch_Model_System_Config_Source_Regex_Level::REGEX_SEARCH) {

            $expression = array('regexp' => $this->getValue());
        }

        return $expression;
    }
}
