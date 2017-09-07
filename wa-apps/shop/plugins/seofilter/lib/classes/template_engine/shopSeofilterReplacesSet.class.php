<?php

abstract class shopSeofilterReplacesSet implements shopSeofilterIReplacer
{
    public function fetch($template)
    {
        $result = $template;

        foreach ($this->getReplaces() as $replacer)
        {
            if ($replacer instanceof shopSeofilterIReplacer)
            {
                $result = $replacer->fetch($result);
            }
        }

        return $result;
    }

    abstract public function getReplaces();
}