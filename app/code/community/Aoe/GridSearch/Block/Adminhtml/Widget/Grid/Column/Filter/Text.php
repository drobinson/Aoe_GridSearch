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
        $gridSearchHelper = Mage::Helper('aoe_gridsearch'); /* @var Aoe_GridSearch_Helper_Data $gridSearchHelper */
        $expression = null;

        if ($searchLevel == Aoe_GridSearch_Model_System_Config_Source_Regex_Level::DEFAULT_SEARCH) {

            $helper = Mage::getResourceHelper('core');
            $expression = array('like' => $helper->addLikeEscape($this->getValue(), array('position' => 'any')));

        } elseif ($searchLevel == Aoe_GridSearch_Model_System_Config_Source_Regex_Level::SIMPLE_SEARCH) {

            $expression = array('regexp' => $gridSearchHelper->parseSimpleToExpression($this->getValue()));

        } elseif ($searchLevel == Aoe_GridSearch_Model_System_Config_Source_Regex_Level::REGEX_SEARCH) {

            if ($gridSearchHelper->isValidRegex($this->getValue())) {
                $expression = array('regexp' => $this->getValue());
            } else {
                Mage::register('aoe_gridsearch_invalid_regex', $this->getValue());
            }
        }

        return $expression;
    }
}
