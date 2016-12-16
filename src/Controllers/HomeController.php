<?php
namespace Scraper\Controllers;

use Scraper\Interfaces\ScraperInterface;
use Scraper\Interfaces\ParserInterface;
use Scraper\Interfaces\MessengerInterface;
use Scraper\Interfaces\ViewInterface;
use Scraper\Interfaces\ValidatorInterface;
use Scraper\Interfaces\QueryInterface;

class HomeController
{

    public function __construct(
      ViewInterface $view,
      ScraperInterface $scraper,
      ParserInterface $parser,
      MessengerInterface $messenger,
      ValidatorInterface $validator,
      QueryInterface $query
    ) {
      $this->view = $view;
      $this->scraper = $scraper;
      $this->parser = $parser;
      $this->messenger = $messenger;
      $this->validator = $validator;
      $this->query = $query;
    }

    public function index()
    {
        $this->view->render(array('title' => 'Home | Web Scraper'));
    }

    public function create()
    {
        $this->validator->validate([
            'url' => 'required',
            'tagType' => 'required'
        ]);

        $this->scraper->setURL($this->query->url);
        $fullCode = $this->scraper->scrape();

        if(isset($this->query->fullPage))
        {
            $this->messenger->send('/results', [$fullCode]);
        }

        $this->parser->setCode($fullCode);
        $this->parser->parse(
          $this->query->tagType,
          isset($this->query->innerHTML) ? true : false
        );

        $this->messenger->send('/results', $this->parser->tags);
    }

}
