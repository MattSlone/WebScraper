<?php
namespace Scraper\Interfaces;

interface MessengerInterface
{
    public function send($url, $data);
}
