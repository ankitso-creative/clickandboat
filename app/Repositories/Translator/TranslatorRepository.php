<?php

namespace App\Repositories\Translator;


use Stichoza\GoogleTranslate\GoogleTranslate;
use PHPHtmlParser\Dom;

class TranslatorRepository
{
    // Function to recursively translate text nodes
    function translateTextNodes($element, $translator) {
        foreach ($element->getChildren() as $child) {
            if ($child->tag->name() === 'text') {
                // Translate the text node
                $translatedText = $translator->translate($child->text());
                $child->setText($translatedText ?? '');
            } else {
                // Recursively handle child elements
                $this->translateTextNodes($child, $translator);
            }
        }
    }

    function translateHtmlContent($htmlContent, $targetLanguage) 
    {
        // Create a new GoogleTranslate instance
        $translator = new GoogleTranslate();
        $translator->setTarget($targetLanguage);

        // Load the HTML content into a DOM parser
         $dom = new Dom;
         $dom->loadStr($htmlContent);
        // Start translating the HTML content
        $this->translateTextNodes($dom->root, $translator);

        // Return the translated HTML content
        return $dom->outerHtml;
    }

    function translateContent($text, $targetLanguage) 
    {
        // Create a new GoogleTranslate instance
        $translator = new GoogleTranslate();
        $translator->setTarget($targetLanguage);

        if($text == '' || $text == null):
            return '';
        endif;
        
       return $translator->translate($text);
    }

    function translateHtmlFromUrl($url, $targetLanguage = 'en') {

        ini_set('max_execution_time', 600);
        $base_path = base_path('/resources/views/arabic/');
        // Fetch HTML content from the URL
        $htmlContent = file_get_contents($url);
        dd($htmlContent);
    
        // Translate the HTML content
        $translatedHtmlContent = translateHtmlContent($htmlContent, $targetLanguage);
        $filePath = $base_path."index.blade.php";

        // Open the file for writing
        $fileHandle = fopen($filePath, 'w');

        // Write the content to the file
        fwrite($fileHandle, $translatedHtmlContent);

        // Close the file
        fclose($fileHandle);
    }
}