<?php

/**
 * Grid Search Helper
 *
 * @category   Aoe
 * @package    Aoe_GridSearch
 * @author     David Robinson <david.robinson@aoemedia.com>
 * @since      2013-05-08
 */
class Aoe_GridSearch_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * Config path constants
     */
    const SEARCHLEVEL_CONFIG_PATH   = 'admin/gridsearch/searchlevel';

    /**
     * Convert a simple search string to a full mysql regexp statement
     *
     * @param $filterValue
     * @return string
     */
    public function parseSimpleToExpression($filterValue)
    {
        $filterValue = $this->escapeRegexCharacters($filterValue, array('*', '|', '+'));

        $filterValue = str_replace('*', '.*', $filterValue);
        $filterValue = str_replace('+', '.+', $filterValue);

        return $filterValue;
    }

    /**
     * Escapes mysql regexp special characters
     *
     * @param $string - the string to be escaped
     * @param array $exclude - characters you wish to exclude from escaping
     * @return string
     */
    public function escapeRegexCharacters($string, $exclude)
    {
        $special_chars = array_diff(array('\\', '*', '.', '?', '+', '[', ']', '(', ')', '{', '}', '^', '$', '|'), $exclude);
        $replacements = array();

        foreach ($special_chars as $special_char)
        {
            $replacements[] = '\\' . $special_char;
        }

        return str_replace($special_chars, $replacements, $string);
    }

    /**
     * Tests for a valid regular expression...
     *
     * @param $regex
     * @return bool
     */
    public function isValidRegex($regex)
    {
        try {
            /* @var Varien_Db_Adapter_Interface $connection */
            $connection = Mage::getModel('core/store')->getResource()->getReadConnection();
            $connection->query($connection->quoteInto('SELECT 1 REGEXP ?', $regex));
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}
