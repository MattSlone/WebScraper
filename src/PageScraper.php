<?php
namespace Scraper;

use Scraper\Interfaces\ScraperInterface;

class PageScraper implements ScraperInterface
{
    protected $ch;

    /**
     * Create a new Page object, and setup cURL to scrape the page.
     * @param [type] $url [description]
     */
    public function __construct()
    {
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    }

    public function setURL($url)
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
    }

    /**
     * Scrape the full HTML code from the page
     * @return Void
     */
    public function scrape()
    {
        return ['HTML' => curl_exec($this->ch)];
    }

    /**
     * Close curl
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }

}
