<?php
namespace Scraper;

use Scraper\Interfaces\ViewInterface;

class View implements ViewInterface
{
    protected $template;

    /**
     * Create a new View object, and set the template.
     * @param String $template Location of the template file
     */
    public function __construct($template) {
        $this->template = $template;
    }

    /**
     * Encode a string to be displayed in HTML
     * @param  String $data String to be encoded
     * @return String       The encoded string
     */
    public function encode($data)
    {
        return htmlspecialchars($data);
    }

    /**
     * Render the view
     * @param  Array/String $data The data that will be shown in the view.
     * @return Void
     */
    public function render($data=[])
    {
        if(is_array($data))
        {
            extract($data);
        }

        ob_start();
        require $this->template;
        $html = ob_get_clean();

        echo $html;
    }

}
