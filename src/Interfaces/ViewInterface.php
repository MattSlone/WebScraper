<?php
namespace Scraper\Interfaces;

interface ViewInterface
{
    public function __construct($template);
    public function encode($data);
    public function render($data);
}
