<?php

namespace App\Classes\View;

class View implements \ArrayAccess
{
    protected $data = [];

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function render($template)
    {
        ob_start();
        foreach ($this->data as $property => $value ) {
            $$property = $value;
        }
        include $template;
        $out = ob_get_contents();
        ob_end_clean();
        return $out;
    }

    public function display($template)
    {
        echo $this->render($template);
    }
}
