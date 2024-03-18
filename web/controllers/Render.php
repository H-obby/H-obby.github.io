<?php
abstract class Render {
    public function __construct() {

    }

    protected function render($data){
        extract($data, EXTR_OVERWRITE);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }
}