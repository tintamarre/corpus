<?php

Form::macro('textField', function ($name, $label = null, $value = null, $attributes = []) {
    $element = Form::text($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $element, $label);
});

Form::macro('emailField', function ($name, $label = null, $value = null, $attributes = []) {
    $element = Form::email($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $element, $label);
});

Form::macro('passwordField', function ($name, $label = null, $value = null, $attributes = []) {
    $element = Form::password($name, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $element, $label);
});

Form::macro('textareaField', function ($name, $label = null, $value = null, $attributes = []) {
    if (!isset($attributes['rows'])) {
        $attributes = array_merge($attributes, [
        'rows' => 10, 'cols' => 50,
        ]);
    }
    $element = Form::textarea($name, $value, fieldAttributes($name, $attributes));

    return fieldWrapper($name, $element, $label);
});

/*
 * Return the html to render an individual radio control
 *
 * @param string $name
 *          - name of the radio
 * @param string $displayName
 *          - display name of the radio
 * @param string $value
 *          - value of control if selected
 * @param string $checked
 *          - is the radio selected?
 * @param array $attributes
 *          - other attributes (class, id etc)
 * @return string - The html rendering of the radio control
 */
if (!function_exists('radio')) {
    function radio($name, $displayName, $value, $checked = null, $attributes = [])
    {
        $out = '';
        $attributes = array_merge([
        'id' => 'id-field-' . $name . '-' . $displayName,
        ], $attributes);
        $out .= '<label for="' . 'id-field-' . $name . '-' . $displayName . '" class="radio-inline">';
        $out .= Form::radio($name, $value, $checked, $attributes) . ' ' . $displayName;
        $out .= '</label>';

        return $out;
    }
}
/*
 * Return the html to render an individual checkbox control
 *
 * @param string $name
 *          - Name of the checkbox
 * @param string $displayName
 *          - Display name of the checkbox
 * @param string $value
 *          - Value if control is checked
 * @param string $checked
 *          - Is the checkbox checked by default
 * @param array $attributes
 *          - other attributes (class, id etc)
 * @return string - html rendering of the checkbox control. Note that
 *         it includes a hidden field. This simplifies form processing when checkbox is unchecked
 */
if (!function_exists('checkBox')) {
    function checkBox($name, $displayName, $value = 1, $checked = null, $attributes = [])
    {
        $out = '';
        $attributes = array_merge([
        'id' => 'id-field-' . $name,
        ], $attributes);
        $out .= '<label for="' . 'id-field-' . $name . '" class="checkbox-inline">';
        $out .= '<input type="hidden" name="' . $name . '" value="0" />'; // spl handling for checkbox that is not checked
        // $out .= Form::hidden($name, 0); //note that this does NOT work well!
        $out .= Form::checkbox($name, $value, $checked, $attributes) . ' ' . $displayName;
        $out .= '</label>';

        return $out;
    }
}
/*
 * Wrap an element with twitter bootstrap 3.0 specific code for proper rendering
 *
 * @param string $field
 *          - field name
 * @param string $element
 *          - html rendering of internal form element to be output
 * @param string $label
 *          - label that is displayed to the left
 * @return string - formatted html with all divs etc for final display on screen
 */
if (!function_exists('fieldWrapper')) {
    function fieldWrapper($field, $element, $label = null)
    {
        $out = '<div class="row">';
        $out .= '<div class="form-group';
        $out .= fieldError($field) . '">'; // set error class
        $out .= fieldLabel($field, $label); // gen label
        $out .= '<div class="col-lg-12">'; // 20150408 Remove class="col-lg-9"
        $out .= $element;
        $out .= errorMessage($field); // display error message
        $out .= '</div>';
        $out .= '</div>';
        $out .= '</div>';

        return $out;
    }
}
/*
 * return formatted error message associated with a field
 *
 * @param string $field
 *          - name of the field to be checked for errors
 * @return string - TBS 3.0 formatted span tag that is to be displayed alongside the field
 */
if (!function_exists('errorMessage')) {
    function errorMessage($field)
    {
        if ($errors = Session::get('errors')) {
            return '<span class="label label-danger">' . $errors->first($field) . '</span>';
        }
    }
}
/*
 * Return string 'has-error' that can be tagged to element div to signal erroneous entry
 *
 * @param string $field
 *          - the field name
 * @return string - 'has-error' in case the field has a validation error
 */
if (!function_exists('fieldError')) {
    function fieldError($field)
    {
        $error = '';
        if ($errors = Session::get('errors')) {
            $error = $errors->first($field) ? 'is-invalid has-error' : '';
        }

        return $error;
    }
}
/*
 * html required for displaying the field label.
 * In case an explicit label is not passed,
 * generate one
 *
 * @param unknown $name
 *          - field name
 * @param unknown $label
 *          - label to be used
 * @return string - html for the label (TBS 3.0 formatted)
 */
if (!function_exists('fieldLabel')) {
    function fieldLabel($name, $label)
    {
        $out = '<label for="' . 'id-field-' . $name . '" class="control-label col-lg-12">';  // 20150408 Remove col-lg-3
        if ($label === null) {
            // remove _id, [].. replace _ and - with space.
            $out .= ucfirst(str_replace([
            '_',
            '-',
            ], ' ', str_replace([
              '_id',
              '[]',
              ], '', $name)));
        } else {
            $out .= $label;
        }
        $out .= '</label>';

        return $out;
    }
}
/*
 * helper function to add required classes (TBS 3.0) for "text input" fields
 *
 * @param string $name
 *          - field name
 * @param array $attributes
 *          - control attribs passed by user
 * @return array - attributes array merged with TBS specific classes
 */
if (!function_exists('fieldAttributes')) {
    function fieldAttributes($name, $attributes = [])
    {
        return array_merge([
        'class' => 'form-control',
        'id' => 'id-field-' . $name,
        ], $attributes);
    }
}

/*
 * Form::selectOpt()
 *
 * Parameters:
 *   $collection    A I\S\Collection instance
 *   $name          The HTML "name"
 *   $groupBy       Field by which options are grouped
 *   $labelBy       Field to use as an option label  (default="name")
 *   $valueBy       Field to use as option's value (default="id")
 *   $value         Value of selected item or items
 *   $attributes    An array of additional HTML attributes
 */
Form::macro('selectOpt', function (ArrayAccess $collection, $name, $groupBy, $labelBy = 'name', $valueBy = 'id', $value = null, $attributes = []) {
    $select_optgroup_arr = [];
    foreach ($collection as $item) {
        $select_optgroup_arr[$item->$groupBy][$item->$valueBy] = $item->$labelBy;
    }

    return Form::select($name, $select_optgroup_arr, $value, $attributes);
});

/*
 * Form::selectOptMulti()
 *
 * A shortcut for Form::selectOpt with multiple selection
 */
Form::macro('selectOptMulti', function (ArrayAccess $collection, $name, $groupBy, $labelBy = 'name', $valueBy = 'id', $value = null, $attributes = []) {
    $attributes = array_merge($attributes, ['multiple' => true]);

    return Form::selectOpt($collection, $name, $groupBy, $labelBy, $valueBy, $value, $attributes);
});
