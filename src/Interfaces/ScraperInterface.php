<?php
namespace Scraper\Interfaces;

interface ScraperInterface
{
    public function __construct();
    public function setURL($url);
    public function scrape();
    public function __destruct();
}
