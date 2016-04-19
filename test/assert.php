<?php

namespace test;

/**
 * Description of assert
 *
 * @author amelendezi
 */
class Assert {

    const ASSERT_MULTIPLE_SUCCESS = "Assert of multiple cases was successful";
    const ASSERT_MULTIPLE_NOT_SET = "Assert has not changed since initialization";
    const ASSERT_MULTIPLE_FAIL = "Assert on multiple cases has failed";    
    const ASSERT_SUCCESS = "Assert was successful";
    const ASSERT_FAIL = "Assert has failed";
    const ERROR_NOT_EQUAL = "Compared properties are not equal";
    const ERROR_NOT_NULL = "Item is not null";
    const ERROR_NOT_EQUAL_VALUES = "Compared values are not equal";

    public $cumulativeAssert;
    
    function __construct() {
        $this->cumulativeAssert = new AssertResult(true, self::ASSERT_MULTIPLE_NOT_SET, null);
    }
    
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
    
    /**
     * Asserts values are equal
     * @param type $left
     * @param type $right
     * @return AssertResult
     */
    public function ValuesAreEqual($left, $right)
    {
        if($left == $right)
        {
            return new AssertResult(true, self::ASSERT_SUCCESS, null);
        }
        return new AssertResult(false, self::ERROR_NOT_EQUAL_VALUES, "$left is different from $right");
    }
    
    /**
     * Appends assert evaluation to a cumulative assertion
     * @param \test\AssertResult $assertResult
     */
    public function AppendAssertCase(AssertResult $assertResult)
    {
        if($assertResult->result && $this->cumulativeAssert->result)
        {
            $this->cumulativeAssert->result = true;
            $this->cumulativeAssert->message = self::ASSERT_MULTIPLE_SUCCESS;            
        } else {
            $this->cumulativeAssert->result = false;
            $this->cumulativeAssert->message = $assertResult->message;
            $this->cumulativeAssert->detail = $assertResult->detail;
        }
    }
}
