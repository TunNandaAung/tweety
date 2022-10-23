<?php

namespace App;

use HTMLPurifier_HTMLDefinition;
use Stevebauman\Purify\Definitions\Definition;

class PurifierDefinitions implements Definition
{
    /**
     * Apply rules to the HTML Purifier definition.
     *
     * @param HTMLPurifier_HTMLDefinition $definition
     *
     * @return void
     */
    public static function apply(HTMLPurifier_HTMLDefinition $definition)
    {
        $definition->addElement('figure', 'Inline', 'Inline', 'Common');
        $definition->addAttribute('figure', 'class', 'Text');
        $definition->addElement('figcaption', 'Inline', 'Inline', 'Common');
        $definition->addAttribute('figcaption', 'class', 'Text');
        $definition->addAttribute('figcaption', 'data-trix-placeholder', 'Text');

        $definition->addAttribute('a', 'rel', 'Text');
        $definition->addAttribute('a', 'tabindex', 'Text');
        $definition->addAttribute('a', 'contenteditable', 'Enum#true,false');
        $definition->addAttribute('a', 'data-trix-attachment', 'Text');
        $definition->addAttribute('a', 'data-trix-content-type', 'Text');
        $definition->addAttribute('a', 'data-trix-id', 'Number');

        $definition->addElement('span', 'Block', 'Flow', 'Common');
        $definition->addAttribute('span', 'data-trix-cursor-target', 'Enum#right,left');
        $definition->addAttribute('span', 'data-trix-serialize', 'Enum#true,false');

        $definition->addAttribute('img', 'data-trix-mutable', 'Enum#true,false');
        $definition->addAttribute('img', 'data-trix-store-key', 'Text');
    }
}
