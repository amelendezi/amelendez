<?php
namespace test;

/**
 * Description of testResult
 *
 * @author amelendezi
 */
class AssertResult {
    
    public $result;
    public $message;
    public $detail;    
    
    public function __construct($result, $message, $detail) {
        $this->result = $result;
        $this->message = $message;
        $this->detail = $detail;        
    }
}
