<?php

namespace WordpressBase\Core;

trait Modular
{
	public function getModulesAttribute()
	{
		$modulesFieldName = property_exists($this, 'modules') ? $this->modules : strtolower(get_called_class()) . '_modules';
		$modules = get_field($modulesFieldName);

		return array_map(fn($module) => [
			'name' => $module['acf_fc_layout'],
			'data' => $module
		], $modules ?? []);
	}
}
