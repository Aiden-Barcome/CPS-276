<?php
    // Include the Validation class
    require_once 'Validation.php';
    
    // StickyForm extends Validation and handles sticky values + rendering + validation
    class StickyForm extends Validation {
    
        // Validate form data against form configuration
        public function validateForm($data, $formConfig) {
            foreach ($formConfig as $key => &$element) {
                // Assign sticky value from submitted data
                $element['value'] = $data[$key] ?? '';
    
                // Use custom error message if available
                $customErrorMsg = $element['errorMsg'] ?? null;
    
                // Text or textarea with regex validation
                if (isset($element['type']) && in_array($element['type'], ['text', 'textarea']) && isset($element['regex'])) {
                    $isValid = $this->checkFormat($element['value'], $element['regex'], $customErrorMsg);
                    if (!$isValid) {
                        $element['error'] = $this->getErrors()[$element['regex']];
                    }
                }
    
                // Select dropdown validation
                elseif (isset($element['type']) && $element['type'] === 'select') {
                    $element['selected'] = $data[$key] ?? '';
                    if (isset($element['required']) && $element['required'] && ($element['selected'] === '0' || empty($element['selected']))) {
                        $element['error'] = $customErrorMsg ?? 'This field is required.';
                        $formConfig['masterStatus']['error'] = true;
                    }
                }
    
                // Checkbox (group or single) validation
                elseif (isset($element['type']) && $element['type'] === 'checkbox') {
                    if (isset($element['options'])) {
                        $anyChecked = false;
                        foreach ($element['options'] as &$option) {
                            $option['checked'] = in_array($option['value'], $data[$key] ?? []);
                            if ($option['checked']) {
                                $anyChecked = true;
                            }
                        }
                        if (isset($element['required']) && $element['required'] && !$anyChecked) {
                            $element['error'] = $customErrorMsg ?? 'This field is required.';
                            $formConfig['masterStatus']['error'] = true;
                        }
                    } else {
                        $element['checked'] = isset($data[$key]);
                        if (isset($element['required']) && $element['required'] && !$element['checked']) {
                            $element['error'] = $customErrorMsg ?? 'This field is required.';
                            $formConfig['masterStatus']['error'] = true;
                        }
                    }
                }
    
                // Radio button validation
                elseif (isset($element['type']) && $element['type'] === 'radio') {
                    $isChecked = false;
                    foreach ($element['options'] as &$option) {
                        $option['checked'] = ($option['value'] === ($data[$key] ?? ''));
                        if ($option['checked']) {
                            $isChecked = true;
                        }
                    }
                    if (isset($element['required']) && $element['required'] && !$isChecked) {
                        $element['error'] = $customErrorMsg ?? 'This field is required.';
                        $formConfig['masterStatus']['error'] = true;
                    }
                }
            }
    
            // Return updated form with sticky values and errors
            return $formConfig;
        }
    }
    
        // Create <option> tags for select dropdown
        public function createOptions($options, $selectedValue) {
            $html = '';
            foreach ($options as $value => $label) {
                $selected = ($value == $selectedValue) ? 'selected' : '';
                $html .= "<option value="$value" $selected>$label</option>";
            }
            return $html;
        }
    
        // Render error message if present
        private function renderError($element) {
            return !empty($element['error']) ? "<span class="text-danger">{$element['error']}</span><br>" : '';
        }
    
        // Render a text input field
        public function renderInput($element, $class = '') {
            $errorOutput = $this->renderError($element);
            return <<<HTML
    <div class="$class">
        <label for="{$element['id']}">{$element['label']}</label>
        <input type="text" class="form-control" id="{$element['id']}" name="{$element['name']}" value="{$element['value']}">
        $errorOutput
    </div>
    HTML;
        }
    
        // Render a textarea field
        public function renderTextarea($element, $class = '') {
            $errorOutput = $this->renderError($element);
            return <<<HTML
    <div class="$class">
        <label for="{$element['id']}">{$element['label']}</label>
        <textarea class="form-control" id="{$element['id']}" name="{$element['name']}">{$element['value']}</textarea>
        $errorOutput
    </div>
    HTML;
        }
    
        // Render radio buttons
        public function renderRadio($element, $class = '', $layout = 'vertical') {
            $errorOutput = $this->renderError($element);
            $optionsHtml = '';
            $layoutClass = $layout === 'horizontal' ? 'form-check-inline' : '';
            foreach ($element['options'] as $option) {
                $checked = $option['checked'] ? 'checked' : '';
                $optionsHtml .= <<<HTML
    <div class="form-check $layoutClass">
        <input class="form-check-input" type="radio" id="{$element['id']}_{$option['value']}" name="{$element['name']}" value="{$option['value']}" $checked>
        <label class="form-check-label" for="{$element['id']}_{$option['value']}">{$option['label']}</label>
    </div>
    HTML;
            }
            return <<<HTML
    <div class="$class">
        <label>{$element['label']}</label><br>
        $optionsHtml
        $errorOutput
    </div>
    HTML;
        }
    
        // Render a single checkbox
        public function renderCheckbox($element, $class = '', $layout = 'vertical') {
            $checked = $element['checked'] ? 'checked' : '';
            $errorOutput = $this->renderError($element);
            $layoutClass = $layout === 'horizontal' ? 'form-check-inline' : '';
            return <<<HTML
    <div class="$class">
        <div class="form-check $layoutClass">
            <input class="form-check-input" type="checkbox" id="{$element['id']}" name="{$element['name']}" $checked>
            <label class="form-check-label" for="{$element['id']}">{$element['label']}</label>
    
    ```