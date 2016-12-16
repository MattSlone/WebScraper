<?php
namespace Scraper\Interfaces;

use Masterminds\HTML5;

interface ParserInterface
{
    public function __construct(HTML5 $html5);
    public function setCode($fullCode);
    public function parse($tagType, $innerHTML);
}
