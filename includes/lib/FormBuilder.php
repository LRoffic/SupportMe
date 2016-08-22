<?php

/**
 * Form Builder Class
 *
 * Form builder & validator
 *
 * @package		Classes
 * @category	Forms
 * @author		@RedStarZOn on twitter
 * @link		https://github.com/RedStarZOn
 */

class FormBuilder {

	/**
	 * Form method (GET or POST)
	 * @var string
	 */
	var $method 		= 'POST';

	/**
	 * All inputs, textareas etc.
	 * @var array
	 */
	var $fields 		= [];

	/**
	 * CSS Style, can be a class or an id
	 * @var string
	 */
	var $style 			= null; 

	/**
	 * Submit button value
	 * @var string
	 */
	var $submit 		= null;

	/**
	 * Fieldsets legends
	 * @var array
	 */
	var $legend 		= [];

	/**
	 * Fieldsets array
	 * @var array
	 */
	var $fieldsets 		= [];

	/**
	 * Fieldset ending
	 * @var boolean
	 */
	var $end 			= false;

	/**
	 * HTML Form content
	 * @var string
	 */
	var $form 			= null; 

	/**
	 * Optgroups array for select inputs
	 * @var array
	 */
	var $optgroups 		= [];

	/**
	 * Form enctype
	 * @var string
	 */
	var $enctype 		= null;

	/**
	 * Form action
	 * @var string
	 */
	var $action			= null;

	/**
	 * Latest field type
	 * @var string
	 */
	var $last			= null;

	/**
	 * Input submit name
	 * @var string
	 */
	var $submitName		= null;

	/**
	 * Valid form ?
	 * @var boolean
	 */
	var $valid 			= true;

	/**
	 * Validation errors
	 * @var array
	 */
	var $errors			= [];

	/**
	 * Instance handler
	 * @var string
	 */
	var $handler		= null;

	/**
	 * Error tag
	 * @var string
	 */
	var $tag			= 'p';

	/**
	 * Error CSS style
	 * @var string
	 */
	var $errorStyle		= null;

	/**
	 * Error position
	 * @var string
	 */
	var $errorPosition	= 'after';

	/**
	 * Use labels ?
	 * @var boolean
	 */
	var $labels 		= true;

	/**
	 * Input error Class
	 * @var string
	 */
	var $inputError		= null;

	/**
	 * Clear fields ?
	 * @var boolean
	 */
	var $clearFields	= false;

	##############################################################################################################################
	##
	##	FORM BUILDER MANAGEMENT
	##
	##############################################################################################################################

	/**
	 * Add new form field
	 * @param string $name
	 * @param string $type
	 * @param boolean $checked
	 */
	public function add($call, $type, $checked = null) {
		// Some fieldsets ?
		$fieldset = ($this->fieldsets) ? sizeOf($this->fieldsets) - 1 : null;
		$fieldsetEnd = ($this->end) ? $fieldset : null;

		// File input ?
		($type == 'file') AND $this->enctype = ' enctype="multipart/form-data"';

		$not_required = ['button', 'hidden'];
		$required = (in_array($type, $not_required)) ? null : ' required = "required"';

		// Hidden input ?
		$name = self::rewrite($call);

		// Field settings
		$this->fields[] = [

					'call' 				=> $call, 
					'type' 				=> $type, 
					'name' 				=> $name, 
					'id'				=> $name,
					'size'				=> null,
					'maxlength'			=> null,
					'rows'				=> null,
					'cols'				=> null,
					'min'				=> null,
					'max'				=> null,
					'step'				=> null,
					'autofocus'			=> null,
					'required'			=> $required,
					'src'				=> null,
					'class'				=> null,
					'placeholder' 		=> null, 
					'fieldset' 			=> $fieldset, 
					'checked' 			=> $checked, 
					'fieldsetEnd' 		=> $fieldsetEnd, 
					'optgroup' 			=> null, 
					'value' 			=> null,
					'validator'			=> null

		];

		// Field type
		$this->last = 'field';

		return $this;
	}

	/**
	 * Get POST or GET value
	 * @param  string $ask
	 * @return $_POST or $_GET
	 */
	public function item($ask) {
		foreach($this->fields as $key => $value) {
			($this->fields[$key]['name'] == $ask) AND $item = $key;
		}

		if(isset($item) AND (isset($_POST[$this->fields[$item]['name']]) OR isset($_GET[$this->fields[$item]['name']])))
			return ($this->method == 'post' || $this->method == 'POST') ? $_POST[$this->fields[$item]['name']] : $_GET[$this->fields[$item]['name']];
		else
			return false;
	}

	/**
	 * Clear fields
	 * @return $this
	 */
	public function clearFields() {
		$this->clearFields = true;
		return $this;
	}

	/**
	 * Error tag
	 * @param  string $value
	 * @return $this
	 */
	public function errorTag($value) {
		$this->tag = $value;
		return $this;
	}

	/**
	 * Error position
	 * @param  string $position
	 * @return $this
	 */
	public function errorPosition($position) {
		$this->errorPosition = $position;
		return $this;
	}

	/**
	 * Error style (CSS)
	 * @param  string $type
	 * @return $this
	 */
	public function errorStyle($type = null) {
		(strstr($type, '.')) AND $this->errorStyle = ' class="'. str_replace('.', null, $type) .'"';
		(strstr($type, '#')) AND $this->errorStyle = ' id="'. str_replace('#', null, $type) .'"';
		return $this;
	}

	/**
	 * Define field name
	 * @param  string $value
	 * @return $this
	 */
	public function name($value) {
		$this->fields[sizeOf($this->fields) - 1]['name'] = $value;
		return $this;
	}

	/**
	 * Define field id
	 * @param  string $value
	 * @return $this
	 */
	public function id($value) {
		$this->fields[sizeOf($this->fields) - 1]['id'] = $value;
		return $this;
	}

	/**
	 * Define field class
	 * @param  string $value
	 * @return $this
	 */
	public function inputClass($value) {
		$this->fields[sizeOf($this->fields) - 1]['class'] = $value .' ';
		return $this;
	}

	/**
	 * Disable labels
	 * @return $this
	 */
	public function disableLabels() {
		$this->labels = false;
		return $this;
	}

	/**
	 * Define field size
	 * @param  string $value
	 * @return $this
	 */
	public function size($value) {
		$this->fields[sizeOf($this->fields) - 1]['size'] = ' size="'. $value .'"';
		return $this;
	}

	/**
	 * Define field maxlength
	 * @param  string $value
	 * @return $this
	 */
	public function maxlength($value) {
		$this->fields[sizeOf($this->fields) - 1]['maxlength'] = ' maxlength="'. $value .'"';
		return $this;
	}

	/**
	 * Define textarea rows
	 * @param  string $value
	 * @return $this
	 */
	public function rows($value) {
		$this->fields[sizeOf($this->fields) - 1]['rows'] = ' rows="'. $value .'"';
		return $this;
	}

	/**
	 * Define textarea cols
	 * @param  string $value
	 * @return $this
	 */
	public function cols($value) {
		$this->fields[sizeOf($this->fields) - 1]['cols'] = ' cols="'. $value .'"';
		return $this;
	}

	/**
	 * Define range min attribute
	 * @param  string $value
	 * @return $this
	 */
	public function min($value) {
		$this->fields[sizeOf($this->fields) - 1]['min'] = ' min="'. $value .'"';
		return $this;
	}

	/**
	 * Define range max attribute
	 * @param  string $value
	 * @return $this
	 */
	public function max($value) {
		$this->fields[sizeOf($this->fields) - 1]['max'] = ' max="'. $value .'"';
		return $this;
	}

	/**
	 * Define range step attribute
	 * @param  string $value
	 * @return $this
	 */
	public function step($value) {
		$this->fields[sizeOf($this->fields) - 1]['step'] = ' step="'. $value .'"';
		return $this;
	}

	/**
	 * Autofocus field
	 * @return $this
	 */
	public function autofocus() {
		$this->fields[sizeOf($this->fields) - 1]['autofocus'] = ' autofocus';
		return $this;
	}

	/**
	 * Optional field ?
	 * @return $this
	 */
	public function optional() {
		$this->fields[sizeOf($this->fields) - 1]['required'] = null;
		return $this;
	}

	/**
	 * Input image ?
	 * @param  string $src
	 * @return $this
	 */
	public function src($src) {
		$this->fields[sizeOf($this->fields) - 1]['src'] = ' src="'. $src .'"';
		return $this;
	}

	/**
	 * Define field value
	 * @param  string $value
	 * @return $this
	 */
	public function value($value) {
		$value = str_replace('"', '&quot;', $value);
		if($this->last == 'choice') {
			$this->fields[sizeOf($this->fields) - 1]['choices'][sizeOf($this->fields[sizeOf($this->fields) - 1]['choices']) - 1]['value'] = $value;
		}
		elseif($this->last == 'radio') {
			$this->fields[sizeOf($this->fields) - 1]['radios'][sizeOf($this->fields[sizeOf($this->fields) - 1]['radios']) - 1]['value'] = $value;
		}
		else
			$this->fields[sizeOf($this->fields) - 1]['value'] = $value;

		return $this;
	}

	/**
	 * Add <select> choice
	 * @param  string  $name
	 * @param  boolean $selected
	 * @return $this
	 */
	public function choice($name, $value, $selected = false, $parent = null) {

		if($parent) {
			foreach($this->fields as $key => $value) {
				if($value['name'] == $parent) {
					$optgroup = ($this->optgroups AND $this->fields[$key]['optgroup']) ? sizeOf($this->optgroups) - 1 : null;
					($selected) AND $selected = ' selected'; // Selected ?

					$this->fields[$key]['choices'][] = [
						'value' 				=> $value, 
						'name' 				=> $name, 
						'selected' 			=> $selected, 
						'optgroup' 			=> $optgroup
					];
				}
			} 
		}
		else {
			// Some optgroups ?
			$optgroup = ($this->optgroups AND $this->fields[sizeOf($this->fields) - 1]['optgroup']) ? sizeOf($this->optgroups) - 1 : null;
			($selected) AND $selected = ' selected'; // Selected ?

			$this->fields[sizeOf($this->fields) - 1]['choices'][] = [

						'value' 				=> $value, 
						'name' 				=> $name, 
						'selected' 			=> $selected, 
						'optgroup' 			=> $optgroup

			];
		}

		// Field type
		$this->last = 'choice';

		return $this;
	}

	/**
	 * Add radio button
	 * @param  string  $name
	 * @param  boolean $selected
	 * @return $this
	 */
	public function radio($name, $selected = false, $parent) {
		($selected) AND $selected = ' checked'; // Checked radio ?

		if($parent) {
			foreach($this->fields as $key => $value) {
				if($value['name'] == $parent) {
					$this->fields[$key]['radios'][] = [
						'value' => self::rewrite($name), 
						'name' => $name, 
						'selected' => $selected
					];
				}
			} 
		}
		else {
			$this->fields[sizeOf($this->fields) - 1]['radios'][] = [

						'value' => self::rewrite($name), 
						'name' => $name, 
						'selected' => $selected

			];
		}

		// Field type
		$this->last = 'radio';

		return $this;
	}

	/**
	 * Fieldset ending
	 * @return $this
	 */
	public function fieldsetBreak() {
		$this->end = true;
		return $this;
	}

	/**
	 * Define field placeholder
	 * @param  string $value
	 * @return $this
	 */
	public function placeholder($value) {
		$this->fields[sizeOf($this->fields) - 1]['placeholder'] = ' placeholder="'. $value .'"';
		return $this;
	}

	/**
	 * Define fieldset legend
	 * @param  string $value
	 * @return $this
	 */
	public function legend($value) {
		$this->legend[sizeOf($this->fieldsets) - 1] = '<legend>'. $value .'</legend>' . "\r\n";
		return $this;
	}

	/**
	 * Create fieldset
	 * @param  string $name
	 * @return $this
	 */
	public function fieldset($name) {
		$this->end = false;
		$this->fieldsets[] = $name;
		return $this;
	}

	/**
	 * Create <select> optgroup
	 * @param  string $name
	 * @return $this
	 */
	public function optgroup($name) {
		$this->optgroups[] = $name;
		$this->fields[sizeOf($this->fields) - 1]['optgroup'] = true;
		return $this;
	}

	/**
	 * Form method (post or get)
	 * @param  string $type
	 * @return $this->method
	 */
	public function method($type) {
		$this->method = strtoupper($type);
		return $this;
	}

	/**
	 * Form action
	 * @param  string $type
	 * @return $this->action
	 */
	public function action($type) {
		$this->action = ' action="'. $type .'"';
		return $this;
	}

	/**
	 * Form style (CSS)
	 * @param  string $type
	 * @return $this
	 */
	public function style($type = null) {
		(strstr($type, '.')) AND $this->style = ' class="'. str_replace('.', null, $type) .'"';
		(strstr($type, '#')) AND $this->style = ' id="'. str_replace('#', null, $type) .'"';
		return $this;
	}

	/**
	 * Submit button value
	 * @param  string $value
	 * @return $this
	 */
	public function submit($value) {
		$this->submit = 'value="'. $value .'" ';
		return $this;
	}

	/**
	 * Current token
	 * @return $token
	 */
	public function getToken() {
		$token = 'token-'. sha1('?:saé"("'. $_SERVER['REMOTE_ADDR'] . ((sizeOf($this->fields) * 50) / 15) . $this->fields[0]['name'] .'é"(-é"?');
		return $token;
	}

	/**
	 * Submit CSS style
	 * @param  string $type
	 * @return $this
	 */
	public function submitStyle($type) {
		(strstr($type, '.')) AND $this->submit .= 'class="'. str_replace('.', null, $type) .'" ';
		(strstr($type, '#')) AND $this->submit .= 'id="'. str_replace('#', null, $type) .'" ';
		return $this;
	}

	/**
	 * Form sent ?
	 * @return boolean
	 */
	public function sent() {
		return (isset($_POST[self::getToken()]) || isset($_GET[self::getToken()])) ? true : false;
	}

	/**
	 * Input error class
	 * @param  string $class
	 * @return $this
	 */
	public function inputError($class) {
		$this->inputError = $class;
		return $this;
	}

	/**
	 * Text rewriting
	 * @param  string $value
	 * @return $value
	 */
	public function rewrite($value)
	{
	   	$letters = [

			'a' 	=> ['à', 'á', 'â', 'ã', 'ä', 'å'],
			'e' 	=> ['è', 'é', 'ê', 'ë'],
			'i' 	=> ['ì', 'í', 'î', 'ï'],
			'o' 	=> ['ò', 'ó', 'ô', 'õ', 'ö'],
			'u' 	=> ['ù', 'ú', 'û', 'ü'],
			'y' 	=> ['ý', 'ÿ']

	    ];
	   	$value = trim(strtolower($value));
	   	$value = preg_replace('#\s#', '-', $value);
	   	$value = preg_replace('#-{2,}#', '-', $value);
	   	$value = str_replace($letters['a'], 'a', $value);
	   	$value = str_replace($letters['e'], 'e', $value);
	   	$value = str_replace($letters['i'], 'i', $value);
	   	$value = str_replace($letters['o'], 'o', $value);
	   	$value = str_replace($letters['u'], 'u', $value);
	   	$value = str_replace($letters['y'], 'y', $value);
	   	$value = str_replace(array('ç', 'ñ'), array('c', 'n'), $value);
	   	$value = preg_replace('#[^a-z0-9-]#', null, $value);
	   	(substr($value, -1, 1) == '-') AND $value = substr($value, 0, -1);
	 
	   	return $value;
	}

	/**
	 * HTML Form builder
	 * @param  string $value
	 * @return $value
	 */
	private function draw($value) {
		// Fields values
		$field_value = ($value['value']) ? 'value="'. htmlentities($value['value']) .'"' : null;
		$textarea_value = ($value['value']) ? $value['value'] : null;

		// Errors
		$error = null;
		$errors = null;
		if(self::sent()) {
			$getErrors = self::getErrors();
			foreach($getErrors as $id => $element) {
				($getErrors[$id]['name'] == $value['name']) AND $errors = $getErrors[$id]['error'];
			}
		}

		// Labels values
		$label = ($this->labels) ? '<label for="'. $value['name'] .'">'. $value['call'] .'</label>' . "\r\n" : null;

		// General inputs
		$ignore = ['textarea', 'select', 'checkbox', 'html', 'radio', 'hidden', 'button', 'reset', 'image', 'submit', "recaptcha"];

		// Input errors
		$inputError = (self::sent() AND $errors) ? $this->inputError : null;

		// General inputs
		if(!in_array($value['type'], $ignore)) {
			$field_value = (self::sent() AND self::item($value['name']) AND !$this->clearFields) ? ' value="'. self::item($value['name']).'"' : $field_value;
			$this->form .= $label;
			if(self::sent() AND $errors) {
				$error = '<'. $this->tag . $this->errorStyle .' name="error_'. $value['name'] .'">'. $value['validator']['message'] .'</'. $this->tag .'>' . "\r\n";
			}
			($this->errorPosition == 'before') AND $this->form .= $error;
			$this->form .= '<input type="'. $value['type'] .'" name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'"'. $value['size'] . $value['maxlength'] . $value['min'] . $value['max'] . $value['step'] . $value['placeholder'] . $field_value . $value['autofocus'] . $value['required'] .'/>' . "\r\n";
			($this->errorPosition == 'after') AND $this->form .= $error;
		}

		//Recaptcha inputs
		if($value['type'] == 'recaptcha'){
			$this->form.= '<div class="g-recaptcha" data-sitekey="'.$value['value'].'"></div>'."\r\n";
		}

		// Hidden inputs
		if($value['type'] == 'hidden') {
			$this->form .= '<input type="'. $value['type'] .'" name="'. $value['name'] .'" '. $field_value .'/>' . "\r\n";
		}

		// Buttons
		if($value['type'] == 'button' OR $value['type'] == 'reset' OR $value['type'] == 'image' OR $value['type'] == 'submit') {
			$value['call'] = str_replace('"', '&quot;', $value['call']);
			$this->form .= '<input type="'. $value['type'] .'" name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'" value="'. $value['call'] .'"'. $value['src'] .' />' . "\r\n";
		}

		// Checkbox
		if($value['type'] == 'checkbox') {
			(self::sent() AND $errors) AND $error = '<'. $this->tag . $this->errorStyle .' name="error_'. $value['name'] .'">'. $value['validator']['message'] .'</'. $this->tag .'>' . "\r\n";
			($this->errorPosition == 'before') AND $this->form .= $error;
			$checked = ($value['checked']) ? ' checked' : null;
			if(self::sent() AND !$this->clearFields) { $checked = (self::item($value['name'])) ? ' checked' : null; }
			$this->form .= '<input type="'. $value['type'] .'" name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'"'. $value['placeholder'] . $value['required'] . $field_value . $checked .'/>'. "\r\n" . $label . "\r\n";
			($this->errorPosition == 'after') AND $this->form .= $error;
		}

		// HTML Text
		if($value['type'] == 'html') {
			$this->form .= $value['call'] . "\r\n";
		}

		// Textareas
		if($value['type'] == 'textarea') {
			$textarea_value = (self::sent() AND self::item($value['name']) AND !$this->clearFields) ? self::item($value['name']) : $textarea_value;
			$this->form .= $label;
			(self::sent() AND $errors) AND $error = '<'. $this->tag . $this->errorStyle .' name="error_'. $value['name'] .'">'. $value['validator']['message'] .'</'. $this->tag .'>' . "\r\n";
			($this->errorPosition == 'before') AND $this->form .= $error;
			$this->form .= '<textarea name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'"' . $value['rows'] . $value['cols'] . $value['placeholder'] . $value['required'] . $value['autofocus'] .'>'. $textarea_value .'</textarea>' . "\r\n";
			($this->errorPosition == 'after') AND $this->form .= $error;
		}

		// Select inputs
		if($value['type'] == 'select') {
			$this->form .= $label;
			(self::sent() AND $errors) AND $error = '<'. $this->tag . $this->errorStyle .' name="error_'. $value['name'] .'">'. $value['validator']['message'] .'</'. $this->tag .'>' . "\r\n";
			($this->errorPosition == 'before') AND $this->form .= $error;
			$this->form .= '<select name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'">' . "\r\n";

				if($value['optgroup']) {
					foreach($this->optgroups as $id => $name) {

						$this->form .= '<optgroup label="'. self::rewrite($name) .'">';

						foreach($value['choices'] as $entry => $label) {
							if($value['choices'][$entry]['optgroup'] == $id) {
								if(self::sent() AND !$this->clearFields) {
									$selected = (self::item($value['name']) == $value['choices'][$entry]['value']) ? ' selected' : null;
									$this->form .= '<option value="'. $value['choices'][$entry]['value'] .'"'. $selected .'>'. $value['choices'][$entry]['name'] .'</option>' . "\r\n";
								}
								else {
									$this->form .= '<option value="'. $value['choices'][$entry]['value'] .'"'. $value['choices'][$entry]['selected'] .'>'. $value['choices'][$entry]['name'] .'</option>' . "\r\n";
								}
							}
						}

						$this->form .= '</optgroup>';
					}
				}
				else {
					foreach($value['choices'] as $key => $select) {
						$selected = ((self::item($value['name']) == $select['value'] AND !$this->clearFields) OR ($select['selected'] AND !self::item($value['name']) AND !$this->clearFields) OR ($this->clearFields AND $select['selected'])) ? ' selected' : null;
						$this->form .= '<option value="'. $select['value'] .'"'. $selected .'>'. $select['name'] .'</option>' . "\r\n";
					}
				}

			$this->form .= '</select>' . "\r\n";
			($this->errorPosition == 'after') AND $this->form .= $error;
		}

		// Radios
		if($value['type'] == 'radio') {
			(self::sent() AND $errors) AND $error = '<'. $this->tag . $this->errorStyle .' name="error_'. $value['name'] .'">'. $value['validator']['message'] .'</'. $this->tag .'>' . "\r\n";
			($this->errorPosition == 'before') AND $this->form .= $error;
			foreach($value['radios'] as $key => $entry) {
				if(self::sent() AND !$this->clearFields)
					$selected = (self::item($value['name']) == $entry['value']) ? 'checked' : null;
				else
					$selected = $entry['selected'];

				$this->form .= '<input type="radio" name="'. $value['name'] .'" class="'. $value['class'] . $inputError .'" value="'. $entry['value'] .'" id="'. self::rewrite($entry['name']) .'"'. $value['required'] .' '. $selected .'><label for="'. $entry['value'] .'">'. $entry['name'] .'</label>' . "\r\n";
			}
			($this->errorPosition == 'after') AND $this->form .= $error;
		}
	}

	/**
	 * HTML Form render
	 * @return $this->form
	 */
	public function build() {
		// Current token
		$token = self::getToken();

		// Form method
		$this->form .= '<form method="'. $this->method .'"'. $this->style . $this->action . ''. $this->enctype .'>' . "\r\n";

		// Some fieldsets ?
		if($this->fieldsets) {
			foreach($this->fieldsets as $entry => $name) {

				$this->form .= '<fieldset name="'. $name .'">' . "\r\n";
				$this->form .= $this->legend[$entry];

				foreach($this->fields as $key => $value)
					($value['fieldset'] == $entry AND is_null($value['fieldsetEnd'])) AND self::draw($value);

				$this->form .= '</fieldset>' . "\r\n";

				foreach($this->fields as $key => $value)
					(!is_null($value['fieldsetEnd']) AND $value['fieldsetEnd'] == $entry) AND self::draw($value);
			}
			
		}
		else { // Or not
			foreach($this->fields as $key => $value)
				self::draw($value);
		}

		// Token
		$this->form .= '<input type="hidden" name="'. $token .'" />';

		// Submit button
		$this->form .= '<input type="submit" '. $this->submit .'/> '. "\r\n" .'</form>';

		$context = $this->form;
		$context = str_replace(' class=""', null, $context);

		return $context;
	}

	public function declareForm() {
		$form = '<form method="'. $this->method .'"'. $this->style . $this->action . ''. $this->enctype .'>' . "\r\n";
		return $form;
	}

	public function endForm() {
		$form = '<input type="hidden" name="'. self::getToken() .'" /></form>';
		return $form;
	}

	public function getSubmit() {
		return '<input type="submit" '. $this->submit .'/> '. "\r\n" .'';
	}

	public function getError($item) {
		foreach($this->fields as $key => $value) {
			if($this->fields[$key]['name'] == $item) {
				$errors = $error = null;
				if(self::sent()) {
					$getErrors = self::getErrors();
					foreach($getErrors as $id => $element) {
						($getErrors[$id]['name'] == $value['name']) AND $errors = $getErrors[$id]['error'];
					}
				}
				(self::sent() AND $errors) AND $error = $error = '<'. $this->tag . $this->errorStyle .' name="error_'. $value['name'] .'">'. $value['validator']['message'] .'</'. $this->tag .'>' . "\r\n";
			}
		}
		return $error;
	}

	public function getLabel($item) {
		foreach($this->fields as $key => $value) {
			if($this->fields[$key]['name'] == $item)
				$label = '<label for="'. $value['name'] .'">'. $value['call'] .'</label>';
		}
		return $label;
	}

	public function getInput($item) {
		$ignore = ['textarea', 'select', 'checkbox', 'html', 'radio', 'hidden', 'button', 'reset', 'image', 'submit'];
		foreach($this->fields as $key => $value) {

			$errors = false;
			if(self::sent()) {
				$getErrors = self::getErrors();
				foreach($getErrors as $id => $element) {
					($getErrors[$id]['name'] == $value['name']) AND $errors = $getErrors[$id]['error'];
				}
			}
			$inputError = (self::sent() AND $errors) ? $this->inputError : null;
			$field_value = ($value['value']) ? 'value="'. htmlentities($value['value']) .'"' : null;
			$textarea_value = ($value['value']) ? $value['value'] : null;

			if($this->fields[$key]['name'] == $item) {

				// General inputs
				if(!in_array($value['type'], $ignore)) {
					$field_value = (self::sent() AND self::item($value['name']) AND !$this->clearFields) ? ' value="'. self::item($value['name']).'"' : $field_value;
					($this->clearFields) AND $field_value = null;
					$context = '<input type="'. $value['type'] .'" name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'"'. $value['size'] . $value['maxlength'] . $value['min'] . $value['max'] . $value['step'] . $value['placeholder'] . $field_value . $value['autofocus'] . $value['required'] .'/>' . "\r\n";
				}

				// Hidden inputs
				if($value['type'] == 'hidden') {
					$context = '<input type="'. $value['type'] .'" name="'. $value['name'] .'" '. $field_value .'/>' . "\r\n";
				}

				// Buttons
				if($value['type'] == 'button' OR $value['type'] == 'reset' OR $value['type'] == 'image' OR $value['type'] == 'submit') {
					$value['call'] = str_replace('"', '&quot;', $value['call']);
					$context = '<input type="'. $value['type'] .'" name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'" value="'. $value['call'] .'"'. $value['src'] .' />' . "\r\n";
				}

				// Checkbox
				if($value['type'] == 'checkbox') {
					$checked = ($value['checked']) ? ' checked' : null;
					if(self::sent() AND !$this->clearFields) { $checked = (self::item($value['name'])) ? ' checked' : null; }
					$context = '<input type="'. $value['type'] .'" name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'"'. $value['placeholder'] . $value['required'] . $field_value . $checked .'/>'. "\r\n";
				}

				// Textareas
				if($value['type'] == 'textarea') {
					$textarea_value = (self::sent() AND self::item($value['name']) AND !$this->clearFields) ? self::item($value['name']) : $textarea_value;
					$context = '<textarea name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'"' . $value['rows'] . $value['cols'] . $value['placeholder'] . $value['required'] . $value['autofocus'] .'>'. $textarea_value .'</textarea>' . "\r\n";
				}

				// Select inputs
				if($value['type'] == 'select') {
					$context = null;
					$context .= '<select name="'. $value['name'] .'" id="'. $value['id'] .'" class="'. $value['class'] . $inputError .'">' . "\r\n";

						if($value['optgroup']) {
							foreach($this->optgroups as $id => $name) {

								$context .= '<optgroup label="'. self::rewrite($name) .'">';

								foreach($value['choices'] as $entry => $label) {
									if($value['choices'][$entry]['optgroup'] == $id) {
										if(self::sent() AND !$this->clearFields) {
											$selected = (self::item($value['name']) == $value['choices'][$entry]['value']) ? ' selected' : null;
											$context .= '<option value="'. $value['choices'][$entry]['value'] .'"'. $selected .'>'. $value['choices'][$entry]['name'] .'</option>' . "\r\n";
										}
										else
											$context .= '<option value="'. $value['choices'][$entry]['value'] .'"'. $value['choices'][$entry]['selected'] .'>'. $value['choices'][$entry]['name'] .'</option>' . "\r\n";
									}
								}

								$context .= '</optgroup>';
							}
						}
						else {
							foreach($value['choices'] as $key => $select) {
								$selected = ((self::item($value['name']) == $select['value'] AND !$this->clearFields) OR ($select['selected'] AND !self::item($value['name']) AND !$this->clearFields) OR ($this->clearFields AND $select['selected'])) ? ' selected' : null;
								$context .= '<option value="'. $select['value'] .'"'. $selected .'>'. $select['name'] .'</option>' . "\r\n";
							}
						}

					$context .= '</select>' . "\r\n";
				}

				// Radios
				if($value['type'] == 'radio') {
					$context = null;
					foreach($value['radios'] as $key => $entry) {
						if(self::sent() AND !$this->clearFields)
							$selected = (self::item($value['name']) == $entry['value']) ? 'checked' : null;
						else
							$selected = $entry['selected'];

						$context .= '<input type="radio" name="'. $value['name'] .'" class="'. $value['class'] . $inputError .'" value="'. $entry['value'] .'" id="'. self::rewrite($entry['name']) .'"'. $value['required'] .' '. $selected .'><label for="'. $entry['value'] .'">'. $entry['name'] .'</label>' . "\r\n";
					}
				}
			
			}
		}
		$context = str_replace(' class=""', null, $context);
		return $context;
	}

	##############################################################################################################################
	##
	##	VALIDATOR MANAGEMENT
	##
	##############################################################################################################################

	/**
	 * Form validator rules
	 * @param  string $exceptions
	 * @param  string $message
	 * @return $this
	 */
	public function validator($exceptions, $message) {
		$this->fields[sizeOf($this->fields) - 1]['validator'] = [];

		$validator = explode('|', trim($exceptions));

		foreach($validator as $key => $value) {
			if(preg_match_all('#(.*)\((.*)\)#isU', $value, $matches)) {
				$matches[1][0] = str_replace(' ', null, $matches[1][0]);
				$this->fields[sizeOf($this->fields) - 1]['validator']['functions'][] = $matches[1][0];

				if(strstr($matches[2][0], ',')) {
					$matches[2][0] = str_replace(' ', null, $matches[2][0]);
					$matches[2][0] = explode(',', trim($matches[2][0]));
				}

				$this->fields[sizeOf($this->fields) - 1]['validator']['params'][] = $matches[2][0];

				$this->fields[sizeOf($this->fields) - 1]['validator']['message'] = $message;
			}
		}

		return $this;
	}

	/**
	 * Valid form ?
	 * @return boolean
	 */
	public function isValid() {
		foreach($this->fields as $id => $entry) {
			if($this->fields[$id]['required'] AND empty(self::item($this->fields[$id]['name']))) {
				$this->valid = false;
				$this->errors[] = ['id' => $id, 'name' => $this->fields[$id]['name'], 'error' => 'This is a required field. Cannot be empty.', 'value' => null];
				$this->fields[$id]['validator']['message'] = 'This is a required field. Cannot be empty.';
			}

			if($entry['validator']) {
				foreach($entry['validator']['functions'] as $type => $function) {
					// Start verifications here
					(!is_array($entry['validator']['params'][$type])) AND $entry['validator']['params'][$type] = (array) $entry['validator']['params'][$type];

					// Parameters
					foreach($entry['validator']['params'][$type] as $param => $value) {
						$this->handler = ($this->method == 'POST') ? $_POST[$this->fields[$id]['name']] : $_GET[$this->fields[$id]['name']];
						if($value == 'parent') {
							$entry['validator']['params'][$type][$param] = ($this->method == 'POST') ? $_POST[$this->fields[$id - 1]['name']] : $_GET[$this->fields[$id - 1]['name']];
						}

						if($value == 'self') {
							$entry['validator']['params'][$type][$param] = ($this->method == 'POST') ? $_POST[$this->fields[$id]['name']] : $_GET[$this->fields[$id]['name']];
						}

						if(!is_numeric($value)) {
							foreach($this->fields as $field => $data)
								($this->fields[$field]['name'] == $value) AND $entry['validator']['params'][$type][$param] = ($this->method == 'POST') ? $_POST[$this->fields[$field]['name']] : $_GET[$this->fields[$field]['name']];
						}
					}

					// Method or function ?
					if(strstr($function, '::')) {
						preg_match('#(\w+)::#isU', $function, $result);
						$call = $result[1];
						$function = str_replace($result[0], null, $function);
					}
					else
						$call = $this;

					// Exec functions
					if(method_exists($call, $function)) {
						if(!call_user_func_array([$call, $function], $entry['validator']['params'][$type]) AND $entry['required']) {
							$this->valid = false;

							$exists = false;
							foreach($this->errors as $field => $element) {
								if($this->errors[$field]['id'] == $id) {
									$exists = true;
									if(!isset($this->errors[$field]['on']))
										$this->errors[$field]['on'] = $function .'('. implode(', ', $entry['validator']['params'][$type]) .')';
									else
										$this->errors[$field]['on'] .= ', '. $function .'('. implode(', ', $entry['validator']['params'][$type]) .')';
								}
							}

							(!$exists) AND $this->errors[] = ['id' => $id, 'name' => $entry['name'], 'on' => $function .'('. implode(', ', $entry['validator']['params'][$type]) .')', 'error' => $entry['validator']['message'], 'value' => $this->handler];
						}
					}
					if(is_callable($function)) {
						if(!call_user_func_array($function, $entry['validator']['params'][$type]) AND $entry['required']) {
							$this->valid = false;
							$this->errors[] = ['id' => $id, 'name' => $entry['name'], 'error' => $entry['validator']['message'], 'value' => $this->handler];
						}
					}
				}
			} // End if validator functions
		}

		return $this->valid;
	}

	/**
	 * Get form errors
	 * @return $this->errors
	 */
	public function getErrors() {
		return $this->errors;
	}

	##############################################################################################################################
	##
	##	VALIDATOR FUNCTIONS (PHP)
	##
	##############################################################################################################################

	/**
	 * Min len and max len
	 * @param  int $begin
	 * @param  int $end
	 * @return boolean
	 */
	public function len($begin, $end) {
		return (strlen($this->handler) >= $begin AND strlen($this->handler) <= $end) ? true : false;
	}

	/**
	 * Min length
	 * @param  int $value
	 * @return boolean
	 */
	public function minlen($value) {
		return (strlen($this->handler) >= $value) ? true : false;
	}

	/**
	 * Maximum length
	 * @param  int $value
	 * @return boolean
	 */
	public function maxlen($value) {
		return (strlen($this->handler) <= $value) ? true : false;
	}

	/**
	 * Equal to = ?
	 * @param  string or int $value
	 * @return boolean
	 */
	public function equalTo($value) {
		return ($this->handler == $value) ? true : false;
	}

	/**
	 * Some special characters ?
	 * @return boolean
	 */
	public function specialchars() {
		return (preg_match("#^[a-z0-9]+$#i", $this->handler)) ? true : false;
	}

	/**
	 * Valid mail address ?
	 * @return boolean
	 */
	public function mailcheck() { 
		return (filter_var($this->handler, FILTER_VALIDATE_EMAIL)) ? true : false; 
	}

	/**
	 * Is string ?
	 * @return boolean
	 */
	public function string() { 
		return (is_string($this->handler)) ? true : false; 
	}

	/**
	 * Is numeric ?
	 * @return boolean
	 */
	public function numeric() { 
		return (is_numeric($this->handler)) ? true : false; 
	}

	/**
	 * Valid phone number ?
	 * @return boolean
	 */
	public function phone() {
		return (preg_match('`^(0[1-6789][-.\s]?(\d{2}[-.\s]?){3}\d{2})$`', $this->handler)) ? true : false;
	}

	/**
	 * Valid url ?
	 * @return boolean
	 */
	public function url() {
		return (filter_var($this->handler, FILTER_VALIDATE_URL) === FALSE) ? false : true;
	}

}

?>