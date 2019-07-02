<?php

namespace App\Classes\View;

use App\MagicalFunction;

class View
    implements \ArrayAccess
{
    use MagicalFunction;

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
    /**
     * Метод, возвращающий буфер вывода
     * @param $template
     * @return false|string
     */
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

    /**
     * Метод, выводящий на экран буфер вывода
     * @param $path string путь к шаблону
     */
    public function display($template)
    {
        echo $this->render($template);
    }
}