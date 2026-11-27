<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Label override
    |--------------------------------------------------------------------------
    |
    | The label to use when creating a localized form element.
    | Useful for indicating that the form element is meant for a certain language.
    | To have the label itself translated you still need to pass a trans() value as label in the view.
    |
    | Available placeholders:
    |   %label   The original (eventually translated) label.
    |   %locale  The locale  (e.g. 'en')
    |
    | E.g. for '%label (%locale)' and TranslatableBootForm::text(trans('nameTranslationKey'), 'name')
    | this would yield the following labels:
    |   <label for="en[name]">Name (en)</label>
    |   <label for="nl[name]">Naam (nl)</label>
    |
    */

    'label-locale-indicator' => '<span>%label</span> <span>(%locale)</span>',

    /*
    |--------------------------------------------------------------------------
    | Form Group class
    |--------------------------------------------------------------------------
    |
    | The class to apply to the form group of localized form elements.
    | Useful for showing/hiding only form inputs of a certain language.
    | By styling this class to be hidden by default and then have Javascript show/hide
    | the form group based on the language that it contains, flickering of form elements
    | can be prevented.
    |
    | Available placeholders:
    |   %locale  The locale (e.g. 'en')
    |
    | E.g. for 'form-group-translation':
    |   <div class="form-group form-group-translation">
    |     ...
    |   </div>
    */

    'form-group-class' => 'form-group-translation',

    /*
    |--------------------------------------------------------------------------
    | Input locale attribute
    |--------------------------------------------------------------------------
    |
    | The attribute to use when attaching the corresponding locale to a localized form element.
    | Useful for showing/hiding only form inputs of a certain language.
    |
    | E.g. for 'data-language':
    |   <input name="en[someName]" data-language="en" />
    |
    */

    'input-locale-attribute' => 'data-language',
];
