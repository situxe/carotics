<?php


class shopSeofilterConst implements shopSeofilterIReplacer
{
    public function getModifiers()
    {
        return array(
            'lower' => new shopSeofilterLowerModifier(),
            'if_page_not_first' => new shopSeofilterIfPageNotFirstModifier(),
            'if_page_first' => new shopSeofilterIfPageFirstModifier(),
        );
    }

    public function fetch($template)
    {
        return preg_replace_callback('/\{\'(.*?)\'((?:\|[A-z0-9\_\-]+)*)\}/',
            array($this, 'constReplace'), $template);
    }

    public function constReplace(array $matches)
    {
        $string_modifiers = ifset($matches[2]);
        $value = ifset($matches[1]);
        preg_match_all('/\|([A-z0-9\_\-]+)*/', $string_modifiers, $matches_modifiers);
        $found_modifiers = ifset($matches_modifiers[1], array());
        $modifiers = $this->getModifiers();

        foreach ($found_modifiers as $modifier)
        {
            $modifier = ifset($modifiers[$modifier]);

            if ($modifier instanceof shopSeofilterModifier)
            {
                $value = $modifier->modify($value);
            }
        }

        return $value;
    }
}