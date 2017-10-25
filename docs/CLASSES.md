## Table of contents

- [\Geniem\ACF\Group](#class-geniemacfgroup)
- [\Geniem\ACF\ConditionalLogicGroup](#class-geniemacfconditionallogicgroup)
- [\Geniem\ACF\RuleGroup](#class-geniemacfrulegroup)
- [\Geniem\ACF\Exception](#class-geniemacfexception)
- [\Geniem\ACF\Field (abstract)](#class-geniemacffield-abstract)
- [\Geniem\ACF\Field\PostObject](#class-geniemacffieldpostobject)
- [\Geniem\ACF\Field\Link](#class-geniemacffieldlink)
- [\Geniem\ACF\Field\Checkbox](#class-geniemacffieldcheckbox)
- [\Geniem\ACF\Field\Textarea](#class-geniemacffieldtextarea)
- [\Geniem\ACF\Field\PageLink](#class-geniemacffieldpagelink)
- [\Geniem\ACF\Field\FlexibleContent](#class-geniemacffieldflexiblecontent)
- [\Geniem\ACF\Field\Group](#class-geniemacffieldgroup)
- [\Geniem\ACF\Field\Select](#class-geniemacffieldselect)
- [\Geniem\ACF\Field\Image](#class-geniemacffieldimage)
- [\Geniem\ACF\Field\Repeater](#class-geniemacffieldrepeater)
- [\Geniem\ACF\Field\TrueFalse](#class-geniemacffieldtruefalse)
- [\Geniem\ACF\Field\Tab](#class-geniemacffieldtab)
- [\Geniem\ACF\Field\Password](#class-geniemacffieldpassword)
- [\Geniem\ACF\Field\CloneField](#class-geniemacffieldclonefield)
- [\Geniem\ACF\Field\Color](#class-geniemacffieldcolor)
- [\Geniem\ACF\Field\Text](#class-geniemacffieldtext)
- [\Geniem\ACF\Field\DatePicker](#class-geniemacffielddatepicker)
- [\Geniem\ACF\Field\Gallery](#class-geniemacffieldgallery)
- [\Geniem\ACF\Field\Oembed](#class-geniemacffieldoembed)
- [\Geniem\ACF\Field\Message](#class-geniemacffieldmessage)
- [\Geniem\ACF\Field\Taxonomy](#class-geniemacffieldtaxonomy)
- [\Geniem\ACF\Field\Radio](#class-geniemacffieldradio)
- [\Geniem\ACF\Field\Email](#class-geniemacffieldemail)
- [\Geniem\ACF\Field\User](#class-geniemacffielduser)
- [\Geniem\ACF\Field\GoogleMap](#class-geniemacffieldgooglemap)
- [\Geniem\ACF\Field\URL](#class-geniemacffieldurl)
- [\Geniem\ACF\Field\Wysiwyg](#class-geniemacffieldwysiwyg)
- [\Geniem\ACF\Field\Relationship](#class-geniemacffieldrelationship)
- [\Geniem\ACF\Field\DateTimePicker](#class-geniemacffielddatetimepicker)
- [\Geniem\ACF\Field\Number](#class-geniemacffieldnumber)
- [\Geniem\ACF\Field\File](#class-geniemacffieldfile)
- [\Geniem\ACF\Field\Flexible\Layout](#class-geniemacffieldflexiblelayout)

<hr />

### Class: \Geniem\ACF\Group

> Class Group

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$title</strong>, <em>\string</em> <strong>$key=null</strong>)</strong> : <em>void</em><br /><em>Field group constructor</em> |
| public | <strong>activate()</strong> : <em>\Geniem\ACF\self</em><br /><em>Change the field group's status as active.</em> |
| public | <strong>add_field(</strong><em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)</em> <strong>$field</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a field to the field group.</em> |
| public | <strong>add_rule_group(</strong><em>[\Geniem\ACF\RuleGroup](#class-geniemacfrulegroup)</em> <strong>$group</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a location rule group for the field group.</em> |
| public | <strong>clone(</strong><em>\string</em> <strong>$key</strong>, <em>\string</em> <strong>$name=null</strong>)</strong> : <em>\Geniem\ACF\Geniem\ACF\Group</em><br /><em>Clone method Forces the developer to give new key to cloned field group.</em> |
| public | <strong>deactivate()</strong> : <em>\Geniem\ACF\self</em><br /><em>Change the field group's status as not active.</em> |
| public | <strong>export()</strong> : <em>array</em><br /><em>Export fields in ACF's native format.</em> |
| public | <strong>export_fields()</strong> : <em>array</em><br /><em>Export fields in the ACF format.</em> |
| public | <strong>get_field(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)</em><br /><em>Get a field by its key.</em> |
| public | <strong>get_fields()</strong> : <em>array</em><br /><em>Get all fields from the field group.</em> |
| public | <strong>get_hidden_elements()</strong> : <em>array</em><br /><em>Get hidden elements.</em> |
| public | <strong>get_key()</strong> : <em>string</em><br /><em>Get field group key.</em> |
| public | <strong>get_label_placement()</strong> : <em>string</em><br /><em>Get field group label placement value.</em> |
| public | <strong>get_menu_order()</strong> : <em>int</em><br /><em>Get field group menu order.</em> |
| public | <strong>get_position()</strong> : <em>string</em><br /><em>Get field group position value.</em> |
| public | <strong>get_rule_groups()</strong> : <em>array</em><br /><em>Get all rule groups that have been added for the field group.</em> |
| public | <strong>get_style()</strong> : <em>\Geniem\ACF\self</em><br /><em>Get field group display style.</em> |
| public | <strong>get_title()</strong> : <em>string</em><br /><em>Get field group title.</em> |
| public | <strong>hide_element(</strong><em>\string</em> <strong>$element</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set an element to be hid on the edit post screen.</em> |
| public | <strong>register()</strong> : <em>void</em><br /><em>Register the field group to ACF.</em> |
| public | <strong>remove_field(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Remove a field from the field group.</em> |
| public | <strong>reset()</strong> : <em>void</em><br /><em>Reset the field group's registered status.</em> |
| public | <strong>set_hidden_elements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set elements to be hid on the post edit screen.</em> |
| public | <strong>set_instruction_placement(</strong><em>\string</em> <strong>$placement=`'label'`</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set field group instructions placement value.</em> |
| public | <strong>set_key(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set new key for the field group.</em> |
| public | <strong>set_label_placement(</strong><em>\string</em> <strong>$placement=`'top'`</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set field group label placement value.</em> |
| public | <strong>set_menu_order(</strong><em>\integer</em> <strong>$order</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set field group menu order.</em> |
| public | <strong>set_position(</strong><em>\string</em> <strong>$position=`'normal'`</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set field group position within the edit post screen.</em> |
| public | <strong>set_style(</strong><em>\string</em> <strong>$style=`'default'`</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set field group display style.</em> |
| public | <strong>set_title(</strong><em>\string</em> <strong>$title</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set new title for the field group.</em> |
| public | <strong>show_element(</strong><em>\string</em> <strong>$element</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Show previously hidden element on the edit post screen.</em> |

<hr />

### Class: \Geniem\ACF\ConditionalLogicGroup

> Class ConditionalLogicGroup

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_rule(</strong><em>\string</em> <strong>$field</strong>, <em>\string</em> <strong>$operator</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a conditional logic rule.</em> |
| public | <strong>get_rules()</strong> : <em>array</em><br /><em>Get added conditional logic rules.</em> |

<hr />

### Class: \Geniem\ACF\RuleGroup

> Class RuleGroup

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_rule(</strong><em>\string</em> <strong>$param</strong>, <em>\string</em> <strong>$operator</strong>, <em>\string</em> <strong>$value</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a location rule to the rule group</em> |
| public | <strong>get_rules()</strong> : <em>array</em><br /><em>Get all rules in the rule group.</em> |

<hr />

### Class: \Geniem\ACF\Exception

> Class Exception

| Visibility | Function |
|:-----------|:---------|

*This class extends \Exception*

*This class implements \Throwable*

<hr />

### Class: \Geniem\ACF\Field (abstract)

> Class Field

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$label</strong>, <em>\string</em> <strong>$key=null</strong>, <em>\string</em> <strong>$name=null</strong>)</strong> : <em>void</em><br /><em>Constructor.</em> |
| public | <strong>add_conditional_logic(</strong><em>[\Geniem\ACF\ConditionalLogicGroup](#class-geniemacfconditionallogicgroup)</em> <strong>$group</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a conditional logic for the field.</em> |
| public | <strong>add_wrapper_class(</strong><em>\string</em> <strong>$class</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a single wrapper class to be added for the field.</em> |
| public | <strong>clone(</strong><em>string</em> <strong>$key</strong>, <em>string</em> <strong>$name=null</strong>)</strong> : <em>\Geniem\ACF\Geniem\ACF\Field</em><br /><em>Clone method Forces the developer to give new key to cloned field.</em> |
| public | <strong>export()</strong> : <em>array</em><br /><em>Export field in ACF's native format.</em> |
| public | <strong>get_conditional_logic()</strong> : <em>[\Geniem\ACF\ConditionalLogicGroup](#class-geniemacfconditionallogicgroup)</em><br /><em>Get the conditional logic group that have been added to the group.</em> |
| public | <strong>get_default_value()</strong> : <em>mixed</em><br /><em>Get the default value of the field.</em> |
| public | <strong>get_instructions()</strong> : <em>string</em><br /><em>Get the instruction text of the field.</em> |
| public | <strong>get_key()</strong> : <em>string</em><br /><em>Get the key of the field.</em> |
| public | <strong>get_label()</strong> : <em>string</em><br /><em>Get the label of the field.</em> |
| public | <strong>get_name()</strong> : <em>string</em><br /><em>Get the name of the field.</em> |
| public | <strong>get_required()</strong> : <em>boolean</em><br /><em>Get the required status of the field.</em> |
| public | <strong>get_type()</strong> : <em>string</em><br /><em>Get the type of the field.</em> |
| public | <strong>get_wrapper_classes()</strong> : <em>array</em><br /><em>Get all wrapper classes that have been added for the field.</em> |
| public | <strong>get_wrapper_id()</strong> : <em>string</em><br /><em>Get the id that has been added for the field.</em> |
| public | <strong>get_wrapper_width()</strong> : <em>int</em><br /><em>Get the wrapper width.</em> |
| public | <strong>remove_wrapper_class(</strong><em>\string</em> <strong>$class</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Remove a single wrapper class from the field.</em> |
| public | <strong>set_default_value(</strong><em>mixed</em> <strong>$value</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set the default value for the field.</em> |
| public | <strong>set_instructions(</strong><em>\string</em> <strong>$instructions</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set instruction text for the field.</em> |
| public | <strong>set_key(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set key for the field.</em> |
| public | <strong>set_label(</strong><em>\string</em> <strong>$label</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set label for the field.</em> |
| public | <strong>set_name(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set name for the field.</em> |
| public | <strong>set_required()</strong> : <em>\Geniem\ACF\self</em><br /><em>Set the field to be required.</em> |
| public | <strong>set_unrequired()</strong> : <em>\Geniem\ACF\self</em><br /><em>Set the field to be unrequired.</em> |
| public | <strong>set_wrapper_classes(</strong><em>mixed</em> <strong>$classes</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set classes to be added for the field.</em> |
| public | <strong>set_wrapper_id(</strong><em>\string</em> <strong>$id</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Add a wrapper id for the field.</em> |
| public | <strong>set_wrapper_width(</strong><em>\integer</em> <strong>$width</strong>)</strong> : <em>\Geniem\ACF\self</em><br /><em>Set the wrapper width in percents.</em> |

<hr />

### Class: \Geniem\ACF\Field\PostObject

> Class PostObject

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_post_type(</strong><em>\string</em> <strong>$post_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a post type to allowed post types</em> |
| public | <strong>add_taxonomy(</strong><em>string</em> <strong>$taxonomy</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add an allowed taxonomy</em> |
| public | <strong>allow_multiple()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow multiple values</em> |
| public | <strong>allow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow null value</em> |
| public | <strong>disallow_multiple()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow multiple values</em> |
| public | <strong>disallow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow null value</em> |
| public | <strong>get_ajax()</strong> : <em>integer</em><br /><em>Get ajax loading state</em> |
| public | <strong>get_allow_multiple()</strong> : <em>integer</em><br /><em>Get allow multiple status</em> |
| public | <strong>get_allow_null()</strong> : <em>integer</em><br /><em>Get allow null status</em> |
| public | <strong>get_post_types()</strong> : <em>array</em><br /><em>Get allowed post types</em> |
| public | <strong>get_return_format()</strong> : <em>string</em><br /><em>Get return format</em> |
| public | <strong>get_taxonomies()</strong> : <em>array</em><br /><em>Get allowed taxonomies</em> |
| public | <strong>no_ajax()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable loading values via ajax</em> |
| public | <strong>remove_post_type(</strong><em>string</em> <strong>$post_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove post type by name from allowed</em> |
| public | <strong>remove_taxonomy(</strong><em>string</em> <strong>$taxonomy</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove taxonomy from allowed by slug</em> |
| public | <strong>set_post_types(</strong><em>array</em> <strong>$post_types</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set post types to show</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$return_format=`'object'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set return format</em> |
| public | <strong>set_taxonomies(</strong><em>array</em> <strong>$taxonomies</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set taxonomies to show</em> |
| public | <strong>use_ajax()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable loading values via ajax</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Link

> Class Link

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_return_format()</strong> : <em>string</em><br /><em>Get the placeholder of the field.</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$format</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the return format of the field.</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Checkbox

> Class Checkbox

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_choice(</strong><em>\string</em> <strong>$choice</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a choice.</em> |
| public | <strong>allow_custom()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow custom values</em> |
| public | <strong>allow_save_custom()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow saving custom values to default values</em> |
| public | <strong>allow_toggle()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow toggle all checkbox</em> |
| public | <strong>disallow_custom()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow custom values</em> |
| public | <strong>disallow_save_custom()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow saving custom values to default values</em> |
| public | <strong>disallow_toggle()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow toggle all checkbox</em> |
| public | <strong>get_choices()</strong> : <em>array</em><br /><em>Get all choices.</em> |
| public | <strong>get_custom()</strong> : <em>integer</em><br /><em>Get allow custom values status</em> |
| public | <strong>get_layout()</strong> : <em>string</em><br /><em>Get the current display style of the checkbox.</em> |
| public | <strong>get_save_custom()</strong> : <em>integer</em><br /><em>Get save custom status</em> |
| public | <strong>get_toggle()</strong> : <em>integer</em><br /><em>Get toggle all checkbox</em> |
| public | <strong>remove_choice(</strong><em>\string</em> <strong>$choice</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove a choice.</em> |
| public | <strong>set_choices(</strong><em>array</em> <strong>$choices</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set choices for the checkbox</em> |
| public | <strong>set_layout(</strong><em>\string</em> <strong>$layout=`'vertical'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set whether the checkboxes are displayed vertically or horizontally.</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Textarea

> Class Textarea

| Visibility | Function |
|:-----------|:---------|
| public | <strong>disable()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable field</em> |
| public | <strong>enable()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable field</em> |
| public | <strong>get_disabled()</strong> : <em>boolean</em><br /><em>Get whether field is disabled or not</em> |
| public | <strong>get_new_lines()</strong> : <em>string</em><br /><em>Get new line handling way</em> |
| public | <strong>get_placeholder()</strong> : <em>string</em><br /><em>Get placeholder value</em> |
| public | <strong>get_readonly()</strong> : <em>boolean</em><br /><em>Get field readonly state</em> |
| public | <strong>get_rows()</strong> : <em>integer</em><br /><em>Get max rows</em> |
| public | <strong>set_maxlength(</strong><em>\integer</em> <strong>$maxlength</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set text max length</em> |
| public | <strong>set_new_lines(</strong><em>\string</em> <strong>$new_lines=`'wpautop'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set new line handling</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set placeholder value</em> |
| public | <strong>set_readonly()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set field to read only</em> |
| public | <strong>set_rows(</strong><em>\integer</em> <strong>$rows</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set max rows</em> |
| public | <strong>set_writable()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set field to writable</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\PageLink

> Class PageLink

| Visibility | Function |
|:-----------|:---------|
| public | <strong>allow_archives()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow archive links</em> |
| public | <strong>disallow_archives()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow archive links</em> |
| public | <strong>get_allow_archives()</strong> : <em>integer</em><br /><em>Get whether archives should be allowed or not</em> |

*This class extends [\Geniem\ACF\Field\PostObject](#class-geniemacffieldpostobject)*

<hr />

### Class: \Geniem\ACF\Field\FlexibleContent

> Class FlexibleContent

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$label</strong>)</strong> : <em>void</em><br /><em>Override field construction method to add default button label but run parent constructor after that</em> |
| public | <strong>add_layout(</strong><em>[\Geniem\ACF\Field\Flexible\Layout](#class-geniemacffieldflexiblelayout)</em> <strong>$layout</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a layout to the layouts</em> |
| public | <strong>export()</strong> : <em>array</em><br /><em>Export field in ACF's native format. This also exports layout fields</em> |
| public | <strong>get_button_label()</strong> : <em>string Button label</em><br /><em>Get button label</em> |
| public | <strong>get_layout(</strong><em>\string</em> <strong>$layout</strong>)</strong> : <em>[\Geniem\ACF\Field\Flexible\Layout](#class-geniemacffieldflexiblelayout)</em><br /><em>Get layout by name</em> |
| public | <strong>get_layouts()</strong> : <em>array</em><br /><em>Get all layouts</em> |
| public | <strong>get_max()</strong> : <em>integer Maximum amount</em><br /><em>Get maximum amount of layouts</em> |
| public | <strong>get_min()</strong> : <em>integer Minimum amount</em><br /><em>Get minimum amount of layouts</em> |
| public | <strong>remove_layout(</strong><em>[\Geniem\ACF\Field\Flexible\Layout](#class-geniemacffieldflexiblelayout)/string</em> <strong>$layout</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove layout from layouts</em> |
| public | <strong>set_button_label(</strong><em>\string</em> <strong>$button_label</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set add row button label</em> |
| public | <strong>set_max(</strong><em>\integer</em> <strong>$max</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum amount of layouts</em> |
| public | <strong>set_min(</strong><em>\integer</em> <strong>$min</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum amount of layouts</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Group

> Class Group

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_field(</strong><em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add field to group</em> |
| public | <strong>export()</strong> : <em>array Acf fields</em><br /><em>Export current field and sub fields to acf compatible format</em> |
| public | <strong>get_fields()</strong> : <em>array</em><br /><em>Get fields</em> |
| public | <strong>get_layout()</strong> : <em>string</em><br /><em>Get layout</em> |
| public | <strong>remove_field(</strong><em>\integer</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove field from sub fields</em> |
| public | <strong>set_layout(</strong><em>\string</em> <strong>$layout=`'table'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set layout</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Select

> Class Select

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_choice(</strong><em>mixed</em> <strong>$choice</strong>, <em>mixed</em> <strong>$value</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Adds a choice to the choices array</em> |
| public | <strong>allow_multiple()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow multiple values</em> |
| public | <strong>allow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow null value</em> |
| public | <strong>disallow_multiple()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow multiple values</em> |
| public | <strong>disallow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow null value</em> |
| public | <strong>get_ajax()</strong> : <em>integer</em><br /><em>Get ajax loading state</em> |
| public | <strong>get_allow_multiple()</strong> : <em>integer</em><br /><em>Get allow multiple status</em> |
| public | <strong>get_allow_null()</strong> : <em>integer</em><br /><em>Get allow null status</em> |
| public | <strong>get_choices()</strong> : <em>array</em><br /><em>Get all choices.</em> |
| public | <strong>get_placeholder()</strong> : <em>string</em><br /><em>Get field placeholder text</em> |
| public | <strong>no_ajax()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable loading values via ajax</em> |
| public | <strong>no_ui()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable custom ui</em> |
| public | <strong>remove_choice(</strong><em>mixed</em> <strong>$choice</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove a choice.</em> |
| public | <strong>set_choices(</strong><em>array</em> <strong>$choices</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set choices for the checkbox</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set field placeholder</em> |
| public | <strong>ui()</strong> : <em>integer</em><br /><em>Get custom ui state</em> |
| public | <strong>use_ajax()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable loading values via ajax</em> |
| public | <strong>use_ui()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable custom ui</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Image

> Class Image

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_mime_type(</strong><em>\string</em> <strong>$mime_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Adds a mime types to allowed mime types</em> |
| public | <strong>get_library()</strong> : <em>string Library</em><br /><em>Get library</em> |
| public | <strong>get_max_height()</strong> : <em>integer Maximum height</em><br /><em>Get maximum height</em> |
| public | <strong>get_max_size()</strong> : <em>string Maximum size</em><br /><em>Get maximum size</em> |
| public | <strong>get_max_width()</strong> : <em>integer Maximum width</em><br /><em>Get maximum width</em> |
| public | <strong>get_mime_types()</strong> : <em>array Mime types</em><br /><em>Get mime types</em> |
| public | <strong>get_min_height()</strong> : <em>integer Minimum height</em><br /><em>Get minimum height</em> |
| public | <strong>get_min_size()</strong> : <em>string Minimum size</em><br /><em>Get minimum size</em> |
| public | <strong>get_min_width()</strong> : <em>integer Minimum width</em><br /><em>Get minimum width</em> |
| public | <strong>get_preview_size()</strong> : <em>string Preview size</em><br /><em>Get preview size</em> |
| public | <strong>get_return_format()</strong> : <em>string Return format</em><br /><em>Get return format</em> |
| public | <strong>remove_mime_type(</strong><em>\string</em> <strong>$mime_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove a mime type from allowed mime types</em> |
| public | <strong>set_library(</strong><em>\string</em> <strong>$library=`'all'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Sets library</em> |
| public | <strong>set_max_height(</strong><em>\integer</em> <strong>$max_height</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum height</em> |
| public | <strong>set_max_size(</strong><em>\string</em> <strong>$max_size</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum size</em> |
| public | <strong>set_max_width(</strong><em>\integer</em> <strong>$max_width</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum width</em> |
| public | <strong>set_mime_types(</strong><em>array</em> <strong>$mime_types</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set allowed mime types</em> |
| public | <strong>set_min_height(</strong><em>\integer</em> <strong>$min_height</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum height</em> |
| public | <strong>set_min_size(</strong><em>\string</em> <strong>$min_size</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum size</em> |
| public | <strong>set_min_width(</strong><em>\integer</em> <strong>$min_width</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum width</em> |
| public | <strong>set_preview_size(</strong><em>\string</em> <strong>$preview_size=`'thumbnail'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set preview size</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$format=`'array'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Sets return format</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Repeater

> Class Repeater

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>string</em> <strong>$label</strong>)</strong> : <em>void</em><br /><em>Override field construction method to add default button label but run parent constructor after that</em> |
| public | <strong>add_field(</strong><em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add sub field</em> |
| public | <strong>export()</strong> : <em>array</em><br /><em>Export field in ACF's native format. This also exports sub fields</em> |
| public | <strong>get_button_label()</strong> : <em>string Button label</em><br /><em>Get button label</em> |
| public | <strong>get_fields()</strong> : <em>array</em><br /><em>Get fields</em> |
| public | <strong>get_layout()</strong> : <em>string</em><br /><em>Get layout</em> |
| public | <strong>get_max()</strong> : <em>integer Maximum amount</em><br /><em>Get maximum amount of layouts</em> |
| public | <strong>get_min()</strong> : <em>integer Minimum amount</em><br /><em>Get minimum amount of layouts</em> |
| public | <strong>remove_field(</strong><em>\integer</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove field from sub fields</em> |
| public | <strong>set_button_label(</strong><em>\string</em> <strong>$button_label</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set add row button label</em> |
| public | <strong>set_layout(</strong><em>\string</em> <strong>$layout=`'table'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set layout</em> |
| public | <strong>set_max(</strong><em>\integer</em> <strong>$max</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum amount of layouts</em> |
| public | <strong>set_min(</strong><em>\integer</em> <strong>$min</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum amount of layouts</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\TrueFalse

> Class TrueFalse

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_message()</strong> : <em>string</em><br /><em>Get message</em> |
| public | <strong>get_ui_off_text()</strong> : <em>string</em><br /><em>Get button off text</em> |
| public | <strong>get_ui_on_text()</strong> : <em>string</em><br /><em>Get button on text</em> |
| public | <strong>no_ui()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable custom ui</em> |
| public | <strong>set_message(</strong><em>\string</em> <strong>$message</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set message</em> |
| public | <strong>set_ui_off_text(</strong><em>\string</em> <strong>$text</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set button off text</em> |
| public | <strong>set_ui_on_text(</strong><em>\string</em> <strong>$text</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set button on text</em> |
| public | <strong>ui()</strong> : <em>integer</em><br /><em>Get custom ui state</em> |
| public | <strong>use_ui()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable custom ui</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Tab

> Class Tab

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_field(</strong><em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a sub field</em> |
| public | <strong>get_endpoint()</strong> : <em>integer</em><br /><em>Get endpoint status</em> |
| public | <strong>get_fields()</strong> : <em>array</em><br /><em>Get fields</em> |
| public | <strong>get_layout()</strong> : <em>string</em><br /><em>Get layout</em> |
| public | <strong>get_placement()</strong> : <em>string</em><br /><em>Get placement</em> |
| public | <strong>remove_endpoint()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable endpoint</em> |
| public | <strong>remove_field(</strong><em>integer</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove field from sub fields</em> |
| public | <strong>remove_fields()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove all sub fields</em> |
| public | <strong>set_endpoint()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable endpoint</em> |
| public | <strong>set_layout(</strong><em>\string</em> <strong>$layout=`'table'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set layout</em> |
| public | <strong>set_placement(</strong><em>\string</em> <strong>$placement=`'top'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set tab placement</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Password

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_append()</strong> : <em>mixed</em> |
| public | <strong>get_placeholder()</strong> : <em>mixed</em> |
| public | <strong>get_prepend()</strong> : <em>mixed</em> |
| public | <strong>set_append(</strong><em>\string</em> <strong>$append</strong>)</strong> : <em>void</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>void</em> |
| public | <strong>set_prepend(</strong><em>\string</em> <strong>$prepend</strong>)</strong> : <em>void</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\CloneField

> Class CloneField Named like this because 'Clone' is a reserved word in PHP.

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_clone(</strong><em>mixed</em> <strong>$clone</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a field or a group to be cloned.</em> |
| public | <strong>export()</strong> : <em>array</em><br /><em>Export the fields to be cloned in ACF's native format.</em> |
| public | <strong>get_clones()</strong> : <em>array</em><br /><em>Get an array of cloned fields.</em> |
| public | <strong>get_display_mode()</strong> : <em>string</em><br /><em>Get the display mode.</em> |
| public | <strong>get_label_prefix()</strong> : <em>boolean</em><br /><em>Get the label prefixing status.</em> |
| public | <strong>get_layout()</strong> : <em>string</em><br /><em>Get the field's layout mode.</em> |
| public | <strong>get_name_prefix()</strong> : <em>boolean</em><br /><em>Get the name prefixing status.</em> |
| public | <strong>remove_clone(</strong><em>mixed</em> <strong>$clone</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove a cloned item.</em> |
| public | <strong>remove_label_prefix()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Don't prefix the field's label.</em> |
| public | <strong>remove_name_prefix()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Don't prefix the field's name.</em> |
| public | <strong>set_display_mode(</strong><em>\string</em> <strong>$display_mode=`'seamless'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the clone field's display mode.</em> |
| public | <strong>set_label_prefix()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Prefix the field's label.</em> |
| public | <strong>set_layout(</strong><em>\string</em> <strong>$layout=`'block'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the clone field's layout mode.</em> |
| public | <strong>set_name_prefix()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Prefix the field's name.</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Color

> Class Color

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Text

> Class Text

| Visibility | Function |
|:-----------|:---------|
| public | <strong>disable()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable field</em> |
| public | <strong>enable()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable field</em> |
| public | <strong>get_append()</strong> : <em>string</em><br /><em>Get append value</em> |
| public | <strong>get_disabled()</strong> : <em>boolean</em><br /><em>Get whether field is disabled or not</em> |
| public | <strong>get_placeholder()</strong> : <em>string</em><br /><em>Get placeholder value</em> |
| public | <strong>get_prepend()</strong> : <em>string</em><br /><em>Get prepend value</em> |
| public | <strong>get_readonly()</strong> : <em>boolean</em><br /><em>Get field readonly state</em> |
| public | <strong>set_append(</strong><em>\string</em> <strong>$append</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set append text</em> |
| public | <strong>set_maxlength(</strong><em>\integer</em> <strong>$maxlength</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set text max length</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set placeholder value</em> |
| public | <strong>set_prepend(</strong><em>\string</em> <strong>$prepend</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set prepend text</em> |
| public | <strong>set_readonly()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set field to read only</em> |
| public | <strong>set_writable()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set field to writable</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\DatePicker

> Class DatePicker

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_display_format()</strong> : <em>string</em><br /><em>Get display_format variable</em> |
| public | <strong>get_first_day()</strong> : <em>integer</em><br /><em>Get first_day variable</em> |
| public | <strong>get_return_format()</strong> : <em>string</em><br /><em>Get return_format variable</em> |
| public | <strong>set_display_format(</strong><em>\string</em> <strong>$format</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set display_format variable</em> |
| public | <strong>set_first_day(</strong><em>\integer</em> <strong>$day</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set first_day variable</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$format</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set return_format variable</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Gallery

> Class Gallery

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_max()</strong> : <em>integer Maximum amount</em><br /><em>Get maximum amount</em> |
| public | <strong>get_min()</strong> : <em>integer Minimum amount</em><br /><em>Get minimum amount</em> |
| public | <strong>set_max(</strong><em>\integer</em> <strong>$max</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum amount</em> |
| public | <strong>set_min(</strong><em>\integer</em> <strong>$min</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum amount</em> |

*This class extends [\Geniem\ACF\Field\Image](#class-geniemacffieldimage)*

<hr />

### Class: \Geniem\ACF\Field\Oembed

> Class Oembed

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_height()</strong> : <em>string</em><br /><em>Get embed height</em> |
| public | <strong>get_width()</strong> : <em>string</em><br /><em>Get embed width</em> |
| public | <strong>set_height(</strong><em>\string</em> <strong>$height</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set embed height</em> |
| public | <strong>set_width(</strong><em>\string</em> <strong>$width</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set embed width</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Message

> Class Message

| Visibility | Function |
|:-----------|:---------|
| public | <strong>esc_html()</strong> : <em>integer Escape html status.</em><br /><em>Get escape html</em> |
| public | <strong>get_message()</strong> : <em>string Message.</em><br /><em>Get message</em> |
| public | <strong>get_new_lines()</strong> : <em>string Newline type.</em><br /><em>Get newline type</em> |
| public | <strong>no_esc_html()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable escape html</em> |
| public | <strong>set_message(</strong><em>\string</em> <strong>$message</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set message</em> |
| public | <strong>set_new_lines(</strong><em>\string</em> <strong>$type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set newline handling</em> |
| public | <strong>use_esc_html()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable escape html</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Taxonomy

> Class Taxonomy

| Visibility | Function |
|:-----------|:---------|
| public | <strong>allow_add_term()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable adding terms</em> |
| public | <strong>allow_load_save_terms()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Enable load_save_terms</em> |
| public | <strong>allow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow null value</em> |
| public | <strong>disallow_add_term()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable adding terms</em> |
| public | <strong>disallow_load_save_terms()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disable load_save_terms</em> |
| public | <strong>disallow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow null value</em> |
| public | <strong>get_add_term()</strong> : <em>integer</em><br /><em>Get whether terms can be added</em> |
| public | <strong>get_allow_null()</strong> : <em>integer</em><br /><em>Get allow null status</em> |
| public | <strong>get_field_type()</strong> : <em>string</em><br /><em>Get displayed field type</em> |
| public | <strong>get_load_save_terms()</strong> : <em>integer</em><br /><em>Get load_save_terms state</em> |
| public | <strong>get_return_format()</strong> : <em>string</em><br /><em>Get return format</em> |
| public | <strong>get_taxonomy()</strong> : <em>string</em><br /><em>Get taxonomy</em> |
| public | <strong>set_field_type(</strong><em>\string</em> <strong>$field_type=`'checkbox'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set displayed field type</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$return_format=`'object'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set return format</em> |
| public | <strong>set_taxonomy(</strong><em>\string</em> <strong>$taxonomy=`'category'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set taxonomy</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Radio

> Class Radio

| Visibility | Function |
|:-----------|:---------|
| public | <strong>allow_other_choice()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow other choice</em> |
| public | <strong>allow_save_other_choice()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow saving custom values to default values</em> |
| public | <strong>disallow_other_choice()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow other choice</em> |
| public | <strong>disallow_save_other_choice()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow saving custom values to default values</em> |
| public | <strong>get_other_choice()</strong> : <em>integer</em><br /><em>Get other choice values status</em> |
| public | <strong>get_save_other_choice()</strong> : <em>integer</em><br /><em>Get save other choice status</em> |

*This class extends [\Geniem\ACF\Field\Checkbox](#class-geniemacffieldcheckbox)*

<hr />

### Class: \Geniem\ACF\Field\Email

> Class Email

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_append()</strong> : <em>string</em><br /><em>Get the append value of the field.</em> |
| public | <strong>get_placeholder()</strong> : <em>string</em><br /><em>Get the placeholder of the field.</em> |
| public | <strong>get_prepend()</strong> : <em>string</em><br /><em>Get the prepend value of the field.</em> |
| public | <strong>set_append(</strong><em>\string</em> <strong>$append</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the append value of the field.</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the placeholder of the field.</em> |
| public | <strong>set_prepend(</strong><em>\string</em> <strong>$prepend</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the prepend value of the field.</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\User

> Class User

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_role(</strong><em>\string</em> <strong>$role</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a single role to allowed roles</em> |
| public | <strong>allow_multiple()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow multiple values</em> |
| public | <strong>allow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Allow null value</em> |
| public | <strong>disallow_multiple()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow multiple values</em> |
| public | <strong>disallow_null()</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Disallow null value</em> |
| public | <strong>get_allow_multiple()</strong> : <em>integer</em><br /><em>Get allow multiple status</em> |
| public | <strong>get_allow_null()</strong> : <em>integer</em><br /><em>Get allow null status</em> |
| public | <strong>get_roles()</strong> : <em>array</em><br /><em>Get allowed roles</em> |
| public | <strong>remove_role(</strong><em>string</em> <strong>$role</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove role from allowed roles</em> |
| public | <strong>set_roles(</strong><em>array</em> <strong>$roles</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set allowed roles</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\GoogleMap

> Class GoogleMap

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_center_lat()</strong> : <em>integer</em><br /><em>Get center_lat variable</em> |
| public | <strong>get_center_lng()</strong> : <em>integer</em><br /><em>Get center_lng variable</em> |
| public | <strong>get_height()</strong> : <em>integer</em><br /><em>Get height variable</em> |
| public | <strong>get_zoom()</strong> : <em>integer</em><br /><em>Get zoom variable</em> |
| public | <strong>set_center_lat(</strong><em>\integer</em> <strong>$lat</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set center_lat variable</em> |
| public | <strong>set_center_lng(</strong><em>\integer</em> <strong>$lng</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set center_lng variable</em> |
| public | <strong>set_height(</strong><em>\integer</em> <strong>$height</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set height variable</em> |
| public | <strong>set_zoom(</strong><em>\integer</em> <strong>$zoom</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set zoom variable</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\URL

> Class URL

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_placeholder()</strong> : <em>string</em><br /><em>Get placeholder value</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set placeholder value</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Wysiwyg

> Class Wysiwyg

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_media_upload()</strong> : <em>boolean</em><br /><em>Get media upload state</em> |
| public | <strong>get_tabs()</strong> : <em>string</em><br /><em>Get allowed tabs</em> |
| public | <strong>get_toolbar()</strong> : <em>string</em><br /><em>Get what toolbars to show</em> |
| public | <strong>set_media_upload(</strong><em>\boolean</em> <strong>$media_upload</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set whether media upload is enabled or not</em> |
| public | <strong>set_tabs(</strong><em>\string</em> <strong>$tabs=`'all'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set tabs to show</em> |
| public | <strong>set_toolbar(</strong><em>\string</em> <strong>$toolbar=`'full'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set what toolbars should be shown</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Relationship

> Class Relationship

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_element(</strong><em>\string</em> <strong>$element</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add an element to show</em> |
| public | <strong>add_filter(</strong><em>\string</em> <strong>$filter</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a filter</em> |
| public | <strong>add_post_type(</strong><em>\string</em> <strong>$post_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add a post type to allowed post types</em> |
| public | <strong>add_taxonomy(</strong><em>string</em> <strong>$taxonomy</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add an allowed taxonomy</em> |
| public | <strong>get_elements()</strong> : <em>array</em><br /><em>Get elements to show</em> |
| public | <strong>get_filters()</strong> : <em>array</em><br /><em>Get usable filters</em> |
| public | <strong>get_max()</strong> : <em>integer Maximum value.</em><br /><em>Get maximum value</em> |
| public | <strong>get_min()</strong> : <em>integer Minimum value.</em><br /><em>Get minimum value</em> |
| public | <strong>get_post_types()</strong> : <em>array</em><br /><em>Get allowed post types</em> |
| public | <strong>get_return_format()</strong> : <em>string</em><br /><em>Get return format</em> |
| public | <strong>get_taxonomies()</strong> : <em>array</em><br /><em>Get allowed taxonomies</em> |
| public | <strong>remove_element(</strong><em>\string</em> <strong>$element</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove element by name</em> |
| public | <strong>remove_filter(</strong><em>\string</em> <strong>$filter</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove filter by name</em> |
| public | <strong>remove_post_type(</strong><em>\string</em> <strong>$post_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove post type by name from allowed</em> |
| public | <strong>remove_taxonomy(</strong><em>string</em> <strong>$taxonomy</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove taxonomy from allowed by slug</em> |
| public | <strong>set_elements(</strong><em>array</em> <strong>$elements</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set elements to show</em> |
| public | <strong>set_filters(</strong><em>array</em> <strong>$filters</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set filters to show</em> |
| public | <strong>set_max(</strong><em>\integer</em> <strong>$max</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum value</em> |
| public | <strong>set_min(</strong><em>\integer</em> <strong>$min</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum value</em> |
| public | <strong>set_post_types(</strong><em>array</em> <strong>$post_types</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set post types to show</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$return_format=`'object'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set return format</em> |
| public | <strong>set_taxonomies(</strong><em>array</em> <strong>$taxonomies</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set taxonomies to show</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\DateTimePicker

> Class DateTimePicker

| Visibility | Function |
|:-----------|:---------|

*This class extends [\Geniem\ACF\Field\DatePicker](#class-geniemacffielddatepicker)*

<hr />

### Class: \Geniem\ACF\Field\Number

> Class Number

| Visibility | Function |
|:-----------|:---------|
| public | <strong>get_append()</strong> : <em>string</em><br /><em>Get append value</em> |
| public | <strong>get_max()</strong> : <em>integer Maximum value.</em><br /><em>Get maximum value</em> |
| public | <strong>get_min()</strong> : <em>integer Minimum value.</em><br /><em>Get minimum value</em> |
| public | <strong>get_placeholder()</strong> : <em>string</em><br /><em>Get placeholder value</em> |
| public | <strong>get_prepend()</strong> : <em>string</em><br /><em>Get prepend value</em> |
| public | <strong>get_step()</strong> : <em>integer</em><br /><em>Get step size</em> |
| public | <strong>set_append(</strong><em>\string</em> <strong>$append</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set append text</em> |
| public | <strong>set_max(</strong><em>\integer</em> <strong>$max</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set maximum value</em> |
| public | <strong>set_min(</strong><em>\integer</em> <strong>$min</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set minimum value</em> |
| public | <strong>set_placeholder(</strong><em>\string</em> <strong>$placeholder</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set placeholder value</em> |
| public | <strong>set_prepend(</strong><em>\string</em> <strong>$prepend</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set prepend text</em> |
| public | <strong>set_step(</strong><em>\integer</em> <strong>$step</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set step size</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\File

> Class File

| Visibility | Function |
|:-----------|:---------|
| public | <strong>add_mime_type(</strong><em>\string</em> <strong>$mime_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Add an allowed MIME type for the file</em> |
| public | <strong>get_library()</strong> : <em>string</em><br /><em>Get the target library of the field.$_COOKIE</em> |
| public | <strong>get_max_size()</strong> : <em>string</em><br /><em>Get the maximum size of the file.</em> |
| public | <strong>get_mime_types()</strong> : <em>array</em><br /><em>Get allowed MIME types.</em> |
| public | <strong>get_min_size()</strong> : <em>string</em><br /><em>Get the minimum size of the file.</em> |
| public | <strong>get_preview_size()</strong> : <em>string</em><br /><em>Get the preview size of the field.</em> |
| public | <strong>get_return_format()</strong> : <em>string</em><br /><em>Get the return format of the field.</em> |
| public | <strong>remove_mime_type(</strong><em>\string</em> <strong>$mime_type</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Remove an allowed MIME type from the field.</em> |
| public | <strong>set_library(</strong><em>\string</em> <strong>$library=`'all'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the target library of the field.</em> |
| public | <strong>set_max_size(</strong><em>\string</em> <strong>$max_size</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the maximum size of the file.</em> |
| public | <strong>set_mime_types(</strong><em>array</em> <strong>$mime_types</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set allowed MIME types for the file.</em> |
| public | <strong>set_min_size(</strong><em>\string</em> <strong>$min_size</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the minimum size of the file.</em> |
| public | <strong>set_preview_size(</strong><em>\string</em> <strong>$preview_size=`'thumbnail'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the preview size of the field.</em> |
| public | <strong>set_return_format(</strong><em>\string</em> <strong>$format=`'array'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\self</em><br /><em>Set the return format of the field.</em> |

*This class extends [\Geniem\ACF\Field](#class-geniemacffield-abstract)*

<hr />

### Class: \Geniem\ACF\Field\Flexible\Layout

> Class Layout

| Visibility | Function |
|:-----------|:---------|
| public | <strong>__construct(</strong><em>\string</em> <strong>$label</strong>, <em>\string</em> <strong>$key=null</strong>, <em>\string</em> <strong>$name=null</strong>)</strong> : <em>void</em><br /><em>Constructor</em> |
| public | <strong>add_field(</strong><em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)</em> <strong>$field</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\self</em><br /><em>Add field to layout</em> |
| public | <strong>clone(</strong><em>string</em> <strong>$key</strong>, <em>\string</em> <strong>$name=null</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\Geniem\ACF\Field</em><br /><em>Clone method Forces the developer to give new key to cloned field.</em> |
| public | <strong>export()</strong> : <em>array Exported acf compatible version</em><br /><em>Export field in ACF's native format.</em> |
| public | <strong>get_field(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract) $name Field name.</em><br /><em>Get sub field by name</em> |
| public | <strong>get_fields()</strong> : <em>array Fields</em><br /><em>Get all sub fields</em> |
| public | <strong>get_key()</strong> : <em>string Key</em><br /><em>Get key</em> |
| public | <strong>get_label()</strong> : <em>string Label</em><br /><em>Get label</em> |
| public | <strong>get_name()</strong> : <em>string Name</em><br /><em>Get name</em> |
| public | <strong>remove_field(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\self</em><br /><em>Remove field from sub fields</em> |
| public | <strong>set_display_mode(</strong><em>\string</em> <strong>$display_mode=`'block'`</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\self</em><br /><em>Set display mode</em> |
| public | <strong>set_key(</strong><em>\string</em> <strong>$key</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\self</em><br /><em>Set key</em> |
| public | <strong>set_label(</strong><em>\string</em> <strong>$label</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\self</em><br /><em>Set label</em> |
| public | <strong>set_name(</strong><em>\string</em> <strong>$name</strong>)</strong> : <em>[\Geniem\ACF\Field](#class-geniemacffield-abstract)\Flexible\self</em><br /><em>Set name</em> |

