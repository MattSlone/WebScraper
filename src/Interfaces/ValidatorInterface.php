<?php
namespace Scraper\Interfaces;

interface ValidatorInterface
{
    public function __construct($data);
    public function validate($rules);
}
