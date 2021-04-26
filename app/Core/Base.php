<?php

namespace WordpressBase\Core;

use WordpressBase\Blade\View;
use ReflectionClass;
use ReflectionMethod;

class Base
{
	use Menu;
	use Theme;
	use Post;

	function __construct()
	{
		$data = $this->data();
		$view = property_exists($this, 'template') ? $this->template : strtolower(get_called_class());
		$this->loadView($data, $view);
	}

	protected function loadView($data, $template = 'index')
	{
		array_key_exists('debug', $_GET) ? dump($data) : false;
		return new View($template, $data);
	}

	private function data()
	{
		$data = [];
		$reflection = new ReflectionClass($this);
		$methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
		foreach ($methods as $method) {
			preg_match('/get(.*)Attribute/', $method->name, $matches);
			if (isset($matches[1])) {
				$data[strtolower($matches[1])] = $this->{$method->name}();
			}
		}
		
		return $data;
	}
}
