<?php
namespace Scraper;

use Scraper\Interfaces\QueryInterface;

class FormQuery implements QueryInterface
{
    public $fullCode;
    public $tagType;
    public $url;
    public $innerHTML;

    public function __construct($query)
    {
        foreach($query as $name => $field)
        {
          $this->$name = $field;
        }

    }

}
