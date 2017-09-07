<?php

class shopSeofilterTemplate
{
    private $types;

    public function __construct($types)
    {
        $this->types = $types;
    }

    public function fetch($template)
    {
        $result = $template;

        foreach ($this->types as $type)
        {
            switch ($type)
            {
                case 'base':
					$replace_set = new shopSeofilterReplaceSet();
                    $result = $replace_set->fetch($result);
                    break;
            }
        }

        return $result;
    }
}
