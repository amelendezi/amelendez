<?php

namespace test;

/**
 * Description of assert
 *
 * @author amelendezi
 */
class Assert {

    const ASSERT_SUCCESS = "Assert was successful";
    const ERROR_NOT_EQUAL = "Compared properties are not equal";
    const ERROR_NOT_NULL = "Item is not null";    

    /**
     * Asserts a left is equal to right. Excludes id property from evaluation
     * @param $left
     * @param $right
     * @return AssertResult
     */
    public function AreEqual($left, $right) {

        // Read objects as arrays
        $leftArray = (array) $left;
        $rightArray = (array) $right;

        // Loop over properties exluding id
        foreach ($leftArray as $key => $value) {
            if ($key != "id") {
                if ($value != $rightArray[$key]) {
                    return new AssertResult(false, self::ERROR_NOT_EQUAL, "$value is different from $rightArray[$key]");
                }
            }
        }
        return new AssertResult(true, self::ASSERT_SUCCESS, null);
    }
    
    /**
     * Asserts an item is null
     * @param type $item
     * @return AssertResult
     */
    public function IsNull($item)
    {
        if($item != null)
        {
            return new AssertResult(false, self::ERROR_NOT_NULL, null);
        }
        return new AssertResult(true, self::ASSERT_SUCCESS, null);
    }
}
