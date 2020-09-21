<?php

class ModulePage extends Page {
	public static function create(array $props) {
		if (option('medienbaecker.modules.autopublish', false)) {
			$props['num'] = 9999;
		}
		
		return parent::create($props);
	}
	public function url($options = null): string {
		return $this->parents()->filterBy('intendedTemplate', '!=', 'modules')->first()->url() . '#' . $this->slug();
	}
	public function render(array $data = [], $contentType = 'html'): string {
		go($this->parents()->filterBy('intendedTemplate', '!=', 'modules')->first()->url() . '#' . $this->slug());
	}
	public function moduleName() {
		return $this->blueprint()->title();
	}
	function moduleId() {
		return str_replace('.', '_', $this->intendedTemplate());
	}
}

class ModulesPage extends Page {
	public function url($options = null): string {
		return $this->parent()->url();
	}
	public function render(array $data = [], $contentType = 'html'): string {
		go($this->parent()->url());
	}
}