![geniem-github-banner](https://cloud.githubusercontent.com/assets/5691777/14319886/9ae46166-fc1b-11e5-9630-d60aa3dc4f9e.png)

# ACF Codifier

- Contributors: [devgeniem](https://github.com/devgeniem) / [Nomafin](https://github.com/Nomafin)
- Tags: wordpress, acf
- Requires at least: 4.6.0
- Tested up to: 4.9.3
- License: GPL-3.0 or later
- License URI: http://www.gnu.org/licenses/gpl-3.0.html

## Description

A helper class to make defining ACF field groups and fields easier in the code.

A complete documentation of the classes can be found [here](docs/classes.md).

## Installation

The recommended way to install ACF Codifier is by Composer:

```
$ composer require devgeniem/acf-codifier
```

OR add it in your `composer.json`:

```json
{
  "require": {
    "devgeniem/acf-codifier": "*"
  }
}
```

Installing the plugin with Composer requires [Bedrock's autoloader](https://roots.io/bedrock/docs/mu-plugins-autoloader/). It installs as an mu-plugin and doesn't need to be activated.

You can, however, install it also as an ordinary plugin. It can be done in two ways:

- Clone this repository into your `plugins` directory and run `composer install --no-dev` in the repository folder.

- Download the latest release [here](https://github.com/devgeniem/acf-codifier/releases/latest) and just extract the archive in your `plugins` directory.

## Usage

All classes of the Codifier are under the namespace `Geniem\ACF`. For easiness, it's better to put your declarations in separate file(s) and declare `namespace Geniem\ACF;` on top of them. Rest of this ReadMe supposes you have done that.

### Creating a field group.

Field groups live in a class called `Group`. New group is thus created with:

```php
$field_group = new Group( 'Field Group' );
```

This will create a new field group with `Field Group` as its title and `field-group` as the key.

If you want to define the key yourself, you can either give it as the second parameter to the constructor or use:

```php
$field_group->set_key( 'new_key' );
```

You can also change the title of the group later with `set_title()` method.

There are methods for defining all the other properties of a field group as well. All the field group commands can be chained. For example:

```php
$field_group->set_position( 'side' )         // Set the field group to be shown in the side bar of the edit screen.
            ->set_style( 'seamless' )        // Set the field group to show as seamless.
            ->hide_element( 'the_content' ); // Hide the native WP content field.
```

Very rarely anyone wants their field group to be shown in every edit screen of a WordPress installation. The visibility rules are handled with their own class `RuleGroup`. A rule group is created and linked with a group like this:

```php
$rule_group = new RuleGroup();
$rule_group->add_rule( 'post_type', '==', 'page' );

$field_group->add_rule_group( $rule_group );
```

You can add multiple rules to a rule group, and each rule within a group is considered an 'and'. If you add multiple rule groups to a field group, they are considered an 'or'.

Field group is registered to use with `register` method:

```php
$field_group->register();
```

Obviously your new field group wouldn't have any fields at this point, but don't worry, we get to them later.

Comprehensive documentation of the class can be found [here](docs/group.md).

### Creating fields

Like field groups, fields are also objects of their own. They live in classes named for their field types. For example a text field can be created with:

```php
$text = new Field\Text( 'Text field' );
```

Now the `$text` variable is populated with a text field with `Text field` as its label and `text-field` with both as its key and its name.

The key and the name can also be given to the constructor as its second and third parameters respectively. Obviously there are `set_key()` and `set_name()` methods also available like there were with the groups as well.

The plugin checks that the field key is unique within the project and triggers a notice if there is a collision.

Every property a field type has is defined with its own method. Like the field groups, they can be chained with the fields as well.

```php
$text->set_placeholder( 'Placeholder text' ) // Set a placeholder text.
     ->set_append( 'Appendable' )            // Set an appending text.
     ->set_maxlength( 30 );                  // Set the maxlength.
```

ACF's conditional logic groups work very similarly to groups' location rules. First you need to create an object from `ConditionalLogicGroup` and add the rule there:

```php
$conditional_logic = new ConditionalLogicGroup();
$conditional_logic->add_rule( 'another_field', '==', true );

$text->add_conditional_logic( $conditional_logic );
```

The logic between 'ands' and 'ors' is the same than it is with the groups' location rules.

Fields are added to field groups with the `add_field` method:

```php
$field_group->add_field( $text );
```

Normally `add_field` adds the field to the end of the field group. If you want the field to be inserted first, append a second parameter with `first` as its value:

```php
$field_group->add_field( $text, 'first' );
```

You can also insert the field into the field group after or before another field with following methods:

```php
$field_group->add_field_before( $text, 'target_field_key' );
$field_group->add_field_after( $text, $target_field_object );
```

You can use either the field key or the field object with both methods.

There are also methods like `add_fields()` that can be used to add an array of fields at once, and `add_fields_from()` that takes another _groupable_  object (for example a field group, group field, repeater or a flexible layout) as its first parameter and copies its fields to the calling object.

```php
$field_group->add_fields_from( $repeater );
```

List of all field types and their methods can be found [here](docs/classes.md).

#### Grouping field types

There are several special field types that can have subfields within them.

##### Group and repeater

The group and the repeater fields are the simplest of the grouping field types. They are very straightforward:

```php
$group = new Field\Group( 'Field name' );

$group->set_layout( 'table' )
      ->add_field( $some_field )
      ->add_field( $another_field );

$field_group->add_field( $group );
```

##### Flexible content

Flexible content fields consist of layouts which contain the fields.

```php
$flexible_content = new Field\FlexibleContent( 'Flexible field' );

$layout = new Field\Flexible\Layout( 'Layout label' );

$layout->set_display_mode( 'row' )
       ->add_field( $some_field )
       ->add_field( $another_field );

$flexible_content->add_layout( $layout );
```

Like fields, layouts can also take key and name as their second and third parameters.

##### Clone

Clone field is a special case in that its class name is not the same than the field slug. `Clone` is a reserved word in PHP so the class name of the field is `CloneField`.

You can clone both fields and field groups, so the field's `add_clone()` method can take both as a parameter. It can also be given just the key of the desired field or field group as a string.

```php
$clone = new Field\CloneField( 'Clone' );

$clone->set_label_prefix()        // Set label prefix setting as true
      ->add_clone( $some_field )  // Add a field object
      ->add_clone( $some_group )  // Add a field group object.
      ->add_clone( 'field-key' ); // Add a field by its key

$field_group->add_field( $clone );
```

##### Tab and Accordion

With ACF Codifier the tab and accordion field types are treated like they had subfields. Otherwise they works just the same as native ACF fields would.

```php
$tab = new Field\Tab( 'My Very First Tab' );

$tab->set_placement( 'left' )
    ->set_endpoint()
    ->add_field( $some_field )
    ->add_field( $another_field );

$field_group->add_field( $tab );
```

##### Pseudo group

Pseudo group is like a group field, but it doesn't affect the data tree or the admin view. It only acts as a container for multiple fields, which then appear as independents fields when viewing the edit page or looking at the data tree.

```php
$pseudo = new Field\Pseudo( 'pseudo-group' );

$pseudo->add_field( $some_field )
       ->add_field( $another_field );
```

## Gutenberg

Codifier has a feature to register Gutenberg blocks using ACF's register block feature internally. It works in a very similar fashion than the basic field creation in Codifier as well.

Block's constructor takes two mandatory parameters: the title and the name (or key) of the block. The properties are then set for the block with appropriate methods.

```php
$block = new \Geniem\ACF\Block( 'Some block', 'some_block' );
$block->set_category( 'common' );
$block->add_post_type( 'post' );
$block->set_mode( 'edit' );
```

The rendering of the block happens with a Renderer class. Codifier includes three renderers by default: CallableRenderer that uses a simple method for rendering; PHP that renders a normal PHP file with the given data and Dust that uses [DustPHP](http://cretz.github.io/dust-php/) templates for rendering.

The following uses the `print_r()` method to output a list of the data from the fields.

```php
$renderer = new \Geniem\ACF\Renderer\CallableRenderer( function( $data ) {
  return print_r( $data, true );
});

$block->set_renderer( $renderer );
```

The ACF fields themselves are added to the block as they would to any other _groupable_ type object with methods like `add_field()` and `set_fields()`.

To register the block for Gutenberg, just use the `register()` method.

```php
$block->register();
```

If you need, the abovementioned method returns the output of ACF's `register_block()` function.

## Additional features

### Prevent Flexible Content layouts from showing in some post types or page templates

If you want to prevent some Flexible Content layouts from showing in some post types or page templates, you can do so with `exclude_post_type` or `exclude_template` methods:

```php
$layout->exclude_post_type( 'post' );
```

```php
$layout->exclude_template( 'page-frontpage.php' );
```

There are also `set_exclude_post_types` and `set_exclude_templates` methods with which you can set multiple excludes at once with an array.

### Hide field label

With the Codifier you can hide a field's label on the admin side. It might be useful for example with flexible content fields or a group field.

You achieve this simply by calling `hide_label()` for your field.

```php
$field->hide_label();
```

There are also `show_label()` and `get_label_visibility()` methods.

## Additional field types

### PHP field

The PHP field is an ACF field type that can only be used with the Codifier. It allows the developer to run his own code within the field area in the admin side and print anything between the ordinary fields.

The field type shows up in the ACF admin as well, but there are no functionality that can be used from there.

Usage of the field type is very straightforward. You can just run your own code like this:

```php
$php = new Field\PHP( __( 'My PHP field' ) );
$php->run( function() {
    global $post;

    echo '<pre>';
    print_r( $post );
    echo '</pre>';
});
```

### Multisite Relationship

The Multisite Relationship is an ACF field type that can only be used with the Codifier. It is a clone of the original Relationship field but with the ability to define the blog from which the posts can be picked.

The usage is otherwise exactly the same as with the Relationship field, but there is a new `set_blog_id()` method.

```php
$ms_relationship = new Field\MultisiteRelationship( __('My Multisite Relationship field' ) );
$ms_relationship->set_blog_id( 2 );
```

### Support for external field types

There are also some field types that are created in the ACF Codifier that are not built-in in the ACF itself. These fields require a plugin to work. The plugins should be linked in the docblock comment of the field type class.

If you use some ACF field type plugin, you can either request it to be included in the Codifier by creating an issue on GitHub or creating the field type class yourself and filing a pull request for it.

#### List of included additional field types
- [MediumEditor](https://github.com/Hube2/acf-medium-editor)
- [Gravity Forms](https://wordpress.org/plugins/acf-gravityforms-add-on/)

## Tips & Tricks

### Translations

If translated strings are used as field labels, instructions etc., the Codifier declarations should be run inside an approriate hook - for example `init` is fine.