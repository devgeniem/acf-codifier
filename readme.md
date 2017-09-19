![geniem-github-banner](https://cloud.githubusercontent.com/assets/5691777/14319886/9ae46166-fc1b-11e5-9630-d60aa3dc4f9e.png)

# Geniem ACF Codifier

- Contributors: [devgeniem](https://github.com/devgeniem) / [Nomafin](https://github.com/Nomafin)
- Tags: wordpress, acf
- Requires at least: 4.8.0
- Tested up to: 4.8.1
- License: GPLv2 or later
- License URI: http://www.gnu.org/licenses/gpl-2.0.html

## Description

A helper class to make defining ACF field groups and fields easier in the code.

## Installation

Install with composer:

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

## Usage

All classes of the Codifier are under the namespace `Geniem\ACF`. For easiness, it's better to put your declarations in separate file(s) and declare `use Geniem\ACF;` on top of them. Rest of this ReadMe supposes you have done that.

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

Field group is registered to use with `register` method:

```php
$field_group->register();
```

Obviously your new field group wouldn't have any fields at this point, but don't worry, we get to them later.

### Available methods

**clone**
- parameters: string $key, string name = _null_
- returns:    Group object

You can clone a field group with this method. It requires that you give it a new field group key, because they are supposed to be unique.

**export**
- parameters: none
- return:     array

This function exports the field group object in ACF's native array format. Usually needed only for Codifier's internal purposes.

**set_title**
- parameters: string $title
- return:     _self_

Sets a new title for the field group.

**get_title**
- parameters: none
- return:     string

Returns the current title of the field group.

**set_key**
- parameters: string $key
- return      _self_

Sets a new key for the field group.

**get_key**
- parameters: none
- return:     string

Returns the current key of the field group.

**set\_menu\_order**
- parameters: int $order = 0
- return:     _self_

Sets the menu order property for the field group.

**get\_menu\_order**
- parameters: none
- return:     int

Returns the current menu order of the field group.

**set_position**
- parameters: string $position = 'normal'
- return:     _self_

Sets the field group's position within the edit screen.

**get_position**
- parameters: none
- return:     string

Returns the current value of the position property of the field group.

**set_style**
- parameters: string $style = 'default'
- return:     _self_

Sets the display style parameter of the field group.

**get_style**
- parameters: none
- return:     string

Returns the display style parameter of the field group.

**set\_label\_placement**
- parameters: string $placement = 'top'
- return:     _self_