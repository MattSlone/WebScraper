<?php
namespace Scraper\Controllers;

use Scraper\Interfaces\ViewInterface;

class ResultsController
{

    public function __construct(ViewInterface $view) {
        $this->view = $view;
    }

    /**
     * Show the results page.
     * @return Void
     */
    public function show()
    {
        $this->view->render(array_merge(
            ['title' => 'Results | Web Scraper'],
            $_SESSION['data']
        ));
    }

}
