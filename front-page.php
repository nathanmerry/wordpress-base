<?php

class FrontPage extends WordpressBase\Core\Base {
    public $template = "page";
    use \WordpressBase\Core\Modular;
}

new FrontPage;