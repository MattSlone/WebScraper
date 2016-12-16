<?php
namespace Scraper;

use Scraper\Interfaces\ParserInterface;
use Masterminds\HTML5;

class PageParser implements ParserInterface {

    public $fullCode;
    public $tags;
    protected $html5;

    public function __construct(HTML5 $html5)
    {
        $this->html5 = $html5;
    }

    public function setCode($fullCode)
    {
        $this->fullCode = $fullCode;
    }

    /**
     * Parse the HTML code of the Page for a given tag
     * @param  String $tagType   The type of tag to parse
     * @param  String $innerHTML Whether or not to grab the innerHTML of the tag
     * @return Void
     */
    public function parse($tagType, $innerHTML=false)
    {
        $tags = $this->separateTags($this->fullCode['HTML'], $tagType);

        $parsedTags = [];
        foreach($tags as $key => $tag)
        {
            $parsedTags[$key]['Tag Type'] = $this->parseTagType($tag);

            foreach($this->parseTagAttributes($tag) as $attribute => $value)
            {
                $parsedTags[$key][$attribute] = $value;
            }

            if($innerHTML)
            {
                $parsedTags[$key]['innerHTML'] = $tag->nodeValue;
            }

            $parsedTags[$key]['Full Tag'] = $this->makeFullTag($parsedTags[$key]);
        }

        $this->tags = $parsedTags;
    }

    /**
     * Separate the full HTML code into individual tags of the given tag type.
     * @param  String $html    The full HTML code
     * @param  String $tagType The type of tag to parse
     * @return DOMNodeList     The separated tags
     */
    private function separateTags($html, $tagType)
    {
        $dom = $this->html5->loadHTML($html);

        return $dom->getElementsByTagName($tagType);
    }

    /**
     * Parse the type of tag from the full tag
     * @param  DOMNode $tag Tag from the DOMNodeList
     * @return String       The type of tag
     */
    private function parseTagType($tag)
    {
        if(is_null($tag->nodeName))
        {
            return "Can\'t parse tag type";
        }

        return $tag->nodeName;
    }

    /**
     * Parse the tag attributes
     * @param  DOMNode $tag Tag from the DOMNodeList
     * @return Array        Formatted array of attributes
     */
    private function parseTagAttributes($tag)
    {
        if(is_null($tag->attributes))
        {
            return 'No tag attributes found';
        }

        $attributes = [];
        foreach ($tag->attributes as $attribute)
        {
            $attributes[$attribute->name] =  $attribute->value;
        }

        return $attributes;
    }

    /**
     * Makes a full tag from the other tag values
     * @param  Array $tag The tag that has already been formatted with the
     * individual parts of the tag.
     * @return String     The full formatted tag
     */
    private function makeFullTag($tag)
    {
        $fullTag = '<'.$tag['Tag Type'].' ';

        foreach($tag as $attribute => $value)
        {
            if($attribute !== 'Tag Type' && $attribute !== 'innerHTML')
            {
                $fullTag .= $attribute."=\"".$value."\"".' ';
            }

        }

        $fullTag = rtrim($fullTag);

        if(isset($tag['innerHTML']))
        {
            $fullTag .= '>'.$tag['innerHTML'].'</'.$tag['Tag Type'].'>';
            return $fullTag;
        }

        $fullTag .= '></'.$tag['Tag Type'].'>';
        return $fullTag;
    }

}
