<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load dependencies
if (!class_exists('RP_WCDPD_Condition_Method')) {
    require_once('rp-wcdpd-condition-method.class.php');
}

/**
 * Condition Method: List Advanced
 *
 * Note: This is supposed to be used with arrays of numeric ids only (e.g. lists of product ids, category ids etc)
 *
 * @class RP_WCDPD_Condition_Method_List_Advanced
 * @package WooCommerce Dynamic Pricing & Discounts
 * @author RightPress
 */
if (!class_exists('RP_WCDPD_Condition_Method_List_Advanced')) {

class RP_WCDPD_Condition_Method_List_Advanced extends RP_WCDPD_Condition_Method
{
    protected $key = 'list_advanced';

    // Singleton instance
    protected static $instance = false;

    /**
     * Singleton control
     */
    public static function get_instance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Constructor class
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->hook();
    }

    /**
     * Get method options
     *
     * @access public
     * @return array
     */
    public function get_options()
    {
        return array(
            'at_least_one'  => __('at least one of selected', 'rp_wcdpd'),
            'all'           => __('all of selected', 'rp_wcdpd'),
            'only'          => __('only selected', 'rp_wcdpd'),
            'none'          => __('none of selected', 'rp_wcdpd'),
        );
    }

    /**
     * Check against condition method
     *
     * @access public
     * @param string $option_key
     * @param mixed $value
     * @param mixed $condition_value
     * @return bool
     */
    public function check($option_key, $value, $condition_value)
    {
        // Check if field values support hierarchy, e.g. product categories that may have child categories
        $hierarchy_support = RightPress_Helper::array_is_multidimensional($condition_value);

        // Normalize values
        $value = array_map('strval', $value);
        sort($value);

        // Normalize condition values
        if ($hierarchy_support) {
            foreach ($condition_value as $condition_value_with_children_key => $condition_value_with_children) {
                $condition_value_with_children = array_map('strval', $condition_value_with_children);
                sort($condition_value_with_children);
                $condition_value[$condition_value_with_children_key] = $condition_value_with_children;
            }
        }
        else {
            $condition_value = array_map('strval', $condition_value);
            sort($condition_value);
        }

        // At least one of selected
        if ($option_key === 'at_least_one') {

            // Hierarchial
            if ($hierarchy_support) {

                // At least one value item must exist in at least one condition value parent/children array
                foreach ($condition_value as $condition_value_with_children) {
                    if (count(array_intersect($value, $condition_value_with_children)) > 0) {
                        return true;
                    }
                }
            }
            // Regular
            else if (count(array_intersect($value, $condition_value)) > 0) {
                return true;
            }
        }
        // All of selected
        else if ($option_key === 'all') {

            // Hierarchial
            if ($hierarchy_support) {

                // At least one value item must exist in each condition value parent/children array
                foreach ($condition_value as $condition_value_with_children) {
                    if (count(array_intersect($value, $condition_value_with_children)) === 0) {
                        return false;
                    }
                }

                // Condition is matched if we didn't return false from the block above
                return true;
            }
            // Regular
            else if (count(array_intersect($value, $condition_value)) == count($condition_value)) {
                return true;
            }
        }
        // Only selected
        else if ($option_key === 'only') {

            // Hierarchial
            if ($hierarchy_support) {

                $condition_values_matched = array();

                // Each value item must be present in at least one condition value parent/children array
                foreach ($value as $single_value) {

                    $match_found = false;

                    foreach ($condition_value as $condition_value_with_children_key => $condition_value_with_children) {
                        if (in_array($single_value, $condition_value_with_children, true)) {
                            $condition_values_matched[$condition_value_with_children_key] = $condition_value_with_children_key;
                            $match_found = true;
                        }
                    }

                    if (!$match_found) {
                        return false;
                    }
                }

                // Make sure that all condition values were found
                if (count($condition_values_matched) !== count($condition_value)) {
                    return false;
                }

                // Condition is matched if we didn't return false from the block above
                return true;
            }
            // Regular
            else if ($value === $condition_value) {
                return true;
            }
        }
        // None of selected
        else if ($option_key === 'none') {

            // Hierarchial
            if ($hierarchy_support) {

                // No value items can exist in any of condition value parent/children array
                foreach ($condition_value as $condition_value_with_children) {
                    if (count(array_intersect($value, $condition_value_with_children)) > 0) {
                        return false;
                    }
                }

                // Condition is matched if we didn't return false from the block above
                return true;
            }
            // Regular
            else if (count(array_intersect($value, $condition_value)) === 0) {
                return true;
            }
        }

        return false;
    }




}

RP_WCDPD_Condition_Method_List_Advanced::get_instance();

}
