<?php
namespace App;

use App\Traits\MagicProperties;

class View
{
    /**
     * использование трейта с магическими методами
     * для задания произвольных свойств
     */
    use MagicProperties;
    /**
     * передача переменных в представление
     * @param $template
     * @return string
     */
    protected function render($template)
    {
        ob_start();
        foreach ($this->data as $key => $value) {
            $$key = $value;
        }
        include $template;
        $result = ob_get_contents();
        ob_end_clean();
        return $result;
    }
    public function display($template)
    {
        echo $this->render($template);
    }
}
