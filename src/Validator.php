<?php
namespace Scraper;

use Scraper\Interfaces\ValidatorInterface;

class Validator implements ValidatorInterface
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Validate the data based on set rules
     * @param  Array $rules The rules to validate against
     * @return Void
     */
    public function validate($rules)
    {
        $results = [];
        foreach($rules as $field => $rule)
        {
            $results[] = $this->$rule($field);
        }

        $this->checkResults($results);

    }

    /**
     * Check the results of the Validation
     * @param  Array $results The results of the validation
     * @return Void
     */
    private function checkResults($results)
    {
        foreach($results as $result)
        {
            if($result !== true)
            {
                echo 'Validation Error: '.$result[1].$result[2];
                die;
            }

        }

    }

    /**
     * Check if required field is not empty and return true or false
     * @param  String $field The required field
     * @return Array/String  The results of whether or not the field is empty
     */
    private function required($field)
    {
        if(!empty($this->data[$field]))
        {
            return true;
        }

        return array('false', $field, ' is required');
    }

}
