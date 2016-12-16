<?php
namespace Scraper;

use Scraper\Interfaces\MessengerInterface;

class Messenger implements MessengerInterface
{
    /**
     * Send data to a new url within the application
     * @param  String $url  The URL to send the data to
     * @param  Array/String $data The data to be sent
     * @return Void
     */
    public function send($url, $data)
    {
        $_SESSION['data'] = $data;
        header("Location: ".$url, true, 301);
        exit();
    }

}
