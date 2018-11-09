<?php

namespace Ontio\SDK\Wallet;

class Identity
{
    public $label = "";
    public $ontid = "";
    public $isDefault = false;
    public $lock = false;
    public $controls = [];
    public $extra = null;

    public function toString()
    {
        $pairs = [];

        foreach ($this as $key => $val) {
            $pairs[$key] = $val;
        }

        return json_encode($pairs);
    }

    public function __toString()
    {
        return $this->toString();
    }
}