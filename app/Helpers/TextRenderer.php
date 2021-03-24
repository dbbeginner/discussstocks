<?php

namespace App\Helpers;

use Illuminate\Support\HtmlString;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Environment;
use League\CommonMark\Extension\Table\TableExtension;
use Mews\Purifier\Facades\Purifier;

class TextRenderer
{

    public $converter;

    // load the CommonMark environment in order to display posts using MarkDown libraries to format them back to HTML
    public function __construct(array $attributes = [])
    {
        $environment = Environment::createCommonMarkEnvironment();

        $environment->addExtension(new TableExtension);

        $this->converter = new CommonMarkConverter([
            'allow_unsafe_links' => false,
            'max_nesting_level' => 5,
            'html_input' => 'escape'
        ], $environment);
    }

    // The prunes images out of markdown posts. The last thing I want is someone spamming comments with bad images
    public function  markdownToHtml($markdown) {
        if(!$markdown) {
            $markdown = "";
        }
        return Purifier::clean(new HtmlString($this->converter->convertToHtml($markdown)));
    }
}