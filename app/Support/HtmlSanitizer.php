<?php

namespace App\Support;

use DOMDocument;
use DOMElement;
use DOMXPath;

class HtmlSanitizer
{
    /**
     * Sanitize rich-text HTML from the editor before rendering publicly.
     */
    public static function sanitizeArticleHtml(?string $html): string
    {
        $html = trim((string) $html);

        if ($html === '') {
            return '';
        }

        $wrappedHtml = '<!DOCTYPE html><html><body>' . $html . '</body></html>';

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($wrappedHtml, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        foreach (['script', 'style', 'iframe', 'object', 'embed', 'form', 'input', 'button', 'meta', 'link'] as $tag) {
            foreach ($xpath->query('//' . $tag) as $node) {
                $node->parentNode?->removeChild($node);
            }
        }

        /** @var DOMElement $element */
        foreach ($xpath->query('//*') as $element) {
            if (! $element->hasAttributes()) {
                continue;
            }

            $toRemove = [];
            foreach ($element->attributes as $attribute) {
                $name = strtolower($attribute->name);
                $value = trim(strtolower($attribute->value));

                if (str_starts_with($name, 'on')) {
                    $toRemove[] = $attribute->name;
                    continue;
                }

                if (in_array($name, ['href', 'src'], true)) {
                    if (str_starts_with($value, 'javascript:') || str_starts_with($value, 'vbscript:') || str_starts_with($value, 'data:')) {
                        $toRemove[] = $attribute->name;
                    }
                }
            }

            foreach ($toRemove as $attributeName) {
                $element->removeAttribute($attributeName);
            }
        }

        $allowedTags = '<p><br><strong><b><em><i><u><s><ul><ol><li><blockquote><h1><h2><h3><h4><h5><h6><a><img><pre><code>';
        $sanitizedHtml = strip_tags($dom->saveHTML(), $allowedTags);

        return trim($sanitizedHtml);
    }
}
