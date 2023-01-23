# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [1.38.1]

### Fixed
- Parameter order for PHP 8.1

## [1.38.0]

### Changed
- Google Maps field to be queryable to RediPress.
- All mainline versions from now on require RediPress 2.0 if the integration is used.

## [1.37.2] - 2022-11-04

### Added

- Show in rest option to Group.

## [1.37.1] - 2022-04-07

### Fixed
- Fix Polylang incompatibility with multisite fields.

## [1.37.0] - 2021-11-30

### Changed
- `Readonly` trait to `ReadonlyTrait` to avoid PHP 8.1 reserved word `readonly`.

## [1.36.1] - 2021-09-24

### Added
- RediPress field type `Numeric` for the Number field.
- Added min-max trait to Flexible Content Layout

## [1.36.0] - 2021-02-24

### Added
- Added set_return_format and get_return_format methods to Checkbox.

### Fixed
- A bug where RediPress queryable fields with array values may not have worked properly.

## [1.35.1] - 2021-01-27

### Changed
- `redipress_get_fields()` has_blocks check to use $item->post_content for custom posts to work.

### Fixed
- The `redipress_include_search_filter()` to pass integer values.
- A typo in the code that prevented the plugin from working with PHP 8.0.

## [1.35.0] - 2020-11-16

### Added
- The ability to use fields from ACF Blocks as queryable fields or search fields in RediPress.

### Fixed
- A bug with RediPress queryable filter functionality.

## [1.34.0] - 2020-11-09

### Changed
- RediPress search include to be suitable also for field types returning other types of values than string.

### Fixed
- The use of `redipress_queryable_callback` changed the return value of a field in some cases.

## [1.33.0] - 2020-10-13

### Changed
- `\Geniem\ACF\Field\GoogleMap` latitude and longitude types from `int` to `float`.

## [1.32.0] - 2020-07-09

### Fixed
- Compatibility with WordPress 5.5 regarding the block rendering function.

### Changed
- RediPress integration changed to match the one in version 1.7.0.

## [1.31.0] - 2020-06-15

### Added
- Ability to define TinyMCE toolbars individually by Wysiwyg fields instance.
- Extended Wysiwyg field with ability to set textarea heights individually by field instance.

## [1.30.2] - 2020-05-27

### Fixed
- Groupable's get_field.

## [1.30.1] - 2020-05-25

### Fixed
- A bug in the Advanced Forms compatibility fix preventing form submissions in certain situations.

## [1.30.0] - 2020-05-22

### Added
- A compatibility fix for Advanced Forms plugin to be able to handle Codifier-registered fields in submissions.

## [1.29.2] - 2020-04-02

### Fixed
- A bug where field content would appear in the search index duplicated.

## [1.29.1] - 2020-04-01

### Fixed
- A bug where RediPress indexing wouldn't take all search index bound content into account.

## [1.29.0] - 2020-03-02

### Added
- MultisitePostObject field for selecting post objects from other sites.

### Changed
- Cleaned up code quite a bit and changed duplicate code to traits for DRY.

## [1.28.1] - 2020-02-17

### Fixed
- Polylang incompatibility with MultisiteRelationship.

## [1.28.0] - 2020-02-07

### Added
- MultisiteTaxonomy field for choosing taxonomy terms from other multisite blogs.
- Ability to set Multitaxonomy and MultisiteTaxonomy fields as "disabled".

## [1.27.0] - 2020-01-31

### Added
- RediPress support for `update_field()` function.

## [1.26.0] - 2020-01-31

### Added
- Support for Gutenberg block styles.
- A possibility to create Gutenberg blocks with ACF's register block feature using Codifier's object-oriented model.

## [1.25.1] - 2019-12-18

### Fixed
- A bug regarding RediPress custom schema fields.

## [1.25.0] - 2019-12-11

### Added
- User query filter.
- Wysiwyg field delay attribute.

### Fixed
- A bug in RediPress queryable field functionality.

## [1.24.0] - 2019-11-21

### Added

- A new custom field: Multitaxonomy. This field enables selecting terms from multiple taxonomies.

## [1.23.0] - 2019-11-19

### Added
- Support for Select field's return format that was introduced in ACF version 5.4.0.

### Fixed
- A bug in Flexible Content's export function.

## [1.22.0] - 2019-11-08

### Added
- Support for RediPress user indexing and custom fields there.
- Multisite Relationship field that allows the user to pick posts from other sites of a multisite.

## [1.21.0] - 2019-10-25

### Added
- Added the ability to use Allow null setting with the Radio field.

## [1.20.0] - 2019-10-10

### Changed
- Removed the dependency for the external plugin for the Gravity Forms field. *NOTE!* If you have used the field previously with the return format set as "object", this will change the behaviour.

## [1.19.0] - 2019-09-13

### Added
- The ability to disable all or some of the options in the Checkbox field.

### Fixed
- `acf/render_field` function wrapped to work only with the specific field the method is used on.

## [1.18.0] - 2019-08-05

### Added
- Support for `acf/fields/taxonomy/result` filter.

## [1.17.0] - 2019-07-08

### Added
- Ability to define the priority for field filter functions as a second parameter.

### Changed
- Groupable export function's filter registration to resemble the one of normal fields.

## [1.16.0] - 2019-04-17

### Added
- Support for [RediPress](https://github.com/devgeniem/redipress) plugin.

### Fixed
- A problem that would cause notices when wrapper classes were defined for a clone field.

## [1.15.1] - 2019-02-19

### Changed
- Moved the field registration from `acf/init` back to `wp_loaded` as it apparently causes problems in some cases.

## [1.15.0] - 2019-02-18

### Added
- Wrap file extension methods on top of ACF's misleadingly named mime types.

### Changed
- Moved redundant functionalities to traits

### Fixed
- A bug that caused tabs to appear twice in situations where field group was already registered before adding the tab.

## [1.14.4] - 2018-10-25

### Fixed
- A bug that threw a notice when a Flexible Layout where used.

## [1.14.3] - 2018-10-18

### Fixed
- Allow hide label functionality for Groupables if they are an instance of Field.
- A bug that prevented User field's `remove_role()` function from working if there were no previously set roles for the field.

## [1.14.2] - 2018-10-16

### Fixed
- A bug regarding the last minor update

## [1.14.1] - 2018-10-10

### Added
- Possibility to make a Select field disabled.

## [1.14.0] - 2018-09-20

### Changed
- Changed Groupable functionality to be a trait instead of multi-inherited class.

## [1.13.0] - 2018-09-19

### Added
- TimePicker field
- PostContent and PostExcerpt fields.

## [1.12.2] - 2018-09-14

### Added
- A possibility to give a callable function instead of an array for the Select's `set_choices()` method.

## [1.12.1] - 2018-08-22

### Changed
- Separated load_save_terms in Taxonomy field to load_terms and save_terms which were introduced in ACF version 5.2.7.

## [1.12.0] - 2018-08-08

### Added
- The `load_field` filter function that was missing from the Field object for some reason.
- Possibility to set a title field for a collapsed repeater item.

### Changed
- The `PHP` field callback now gets the field object as a parameter.

## [1.11.0] - 2018-05-31

### Added
- The `PHP` field that allows the developer to run their own code within the field area.

### Changed
- Datetime functions' default formats to mimic those of the ACF's core.

## [1.10.4] - 2018-05-18

### Fixed
- A minor bug caused by the previous fix.

## [1.10.3] - 2018-05-18

### Fixed
- A bug with the filter functions that didn't run on Repeaters or Group fields.

## [1.10.2] - 2018-04-18

### Fixed
- A bug that prevented using `add_field( $field, 'first' )` when there were no previously added fields in a GroupableField.

## [1.10.1] - 2018-04-17

### Fixed
- A minor bug fix.

## [1.10.0] - 2018-04-17

### Added
- A possibility to define priorities and accepted arguments on the filter functions.

### Fixed
- Set `Field->$conditional_logic` to be an empty array by default as otherwise it causes a warning in GroupableField.php:81.

## [1.9.2] - 2018-04-12

### Fixed
- A pair of minor bugs that could cause PHP warnings.

## [1.9.1] - 2018-04-12

### Fixed
- A bug on Image field that would cause an error on JavaScript.

## [1.9.0] - 2018-04-12

### Added
- `add_fields()` method for Groupable.

### Fixed
- A bug where `hide_label()` would not work inside Flexible Content layouts.

## [1.8.0] - 2018-04-04

### Added
- Support for ACF Gravity Forms plugin.

### Fixed
- Two minor bugs that caused some PHP warnings.

## [1.7.3] - 2018-03-29

### Fixed
- A bug that caused cloned pseudo groups to not clone their subfields properly.

## [1.7.2] - 2018-03-27

### Fixed
- A bug that occurred when checking key uniqueness without WP_DEBUG.

## [1.7.1] - 2018-03-27

### Changed
- Updated class documentation.

## [1.7.0] - 2018-03-27

### Added
- PseudoGroup field type with which you can treat multiple fields like a group but they appear in the admin as independent.

### Fixed
- A bug that caused cloned fields lose their hidden label status.
- A bug that caused Link field to be unusable.

## [1.6.0] - 2018-03-19

### Added
- Support for Button group field type.
- Support for Accordion field type.
- Support for `Return format` setting for User field type.

### Changed
- Enhanced documentation and corrected a few typos.

## [1.5.5] - 2018-03-16

### Fixed
- A bug that caused fields to occur multiple times in a tab inside an options page.

## [1.5.4] - 2018-03-06

### Fixed
- A bug that prevented removing fields from tab afterwards

## [1.5.3] - 2018-02-26

### Fixed
- A bug in post type filtering within the PostObject field.
- A bug in cloning a groupable field with conditional logic in it.
- A bug with the key uniqueness check that would throw a warning if `WP_DEBUG` was not set `true`.

## [1.5.2] - 2018-02-23

### Fixed
- A bug with remove_field() function.

## [1.5.1] - 2018-02-22

### Fixed
- A bug where cloning a Flexible Content layout would not update the references to it in all places.

## [1.5.0] - 2018-02-21

### Added
- A possibility to filter Flexible Content layouts by field name.

### Fixed
- A few minor bug fixes on various things.

### Changed
- Removed array_unique check from FlexibleContent class because it doesn't work.

## [1.4.0] - 2018-02-13

### Added
- A possibility to filter Flexible Content layouts by post types and page templates.
- Key prefixing for tabs to eliminate the possibility of collisions.

## [1.3.3] - 2018-02-09

### Changed
- Updated the class documentation.

## [1.3.2] - 2018-02-07

### Changed
- Fixed a bug in a function `add_field_location()` which is used by the functions `add_field_before()` and `add_field_after()`.

## [1.3.1] - 2018-02-07

### Changed
- Enhanced the checking of non-unique field keys.

## [1.3.0] - 2018-02-06

### Added
- A support for installing the Codifier as an ordinary plugin instead of autoloaded mu-plugin.
- A check that non-unique field keys throw a notice, and debug information if WP_DEBUG is set.

### Changed
- Enhanced the documentation to reflect the above-mentioned changes.

## [1.2.4] - 2018-01-31

### Fixed
- Fixed a bug that occured after the change made in 1.2.3.

## [1.2.3] - 2018-01-30

### Changed
- Clone field now throws an exception if a conditional logic is tried to be applied to it.

## [1.2.2] - 2018-01-29

### Fixed
- A bug in Groupable class' `remove_field()` method.

## [1.2.1] - 2018-01-23

### Fixed
- A bug that threw a warning if a File field was used without setting allowed MIME types.

## [1.2.0] - 2018-01-18

### Added
- Support for ACF Medium Editor plugin.

### Changed
- Remove_field now uses key instead of the index number.

### Fixed
- A bug where setting allowed mime types for a file field would cause the field not to work.

## [1.1.4] - 2018-01-16

### Fixed
- Fixed the CSS on the `hide_label()` method to prevent affecting child elements.

## [1.1.3] - 2017-11-27

### Changed
- Another small bug fix regarding Group field

## [1.1.2] - 2017-11-27

### Changed
- Fixed a bug regarding Group field type that prevented them from working properly

## [1.1.1] - 2017-11-27

### Changed
- Enhanced documentation with more comprehensive namespace examples

## [1.1.0] - 2017-11-22

### Added
- Lots of ACF filter functionality to be used easily when defining the fields.

## [1.0.0] - 2017-11-22

### Changed
- Fixed a bug that Repeater and Flexible Content fields wouldn't accept key and name as their constructor parameters
- Updated version number to 1.0.0 for compatibility purposes

## [0.2.1] - 2017-11-21

### Changed
- Fixed a bug with the fields' clone method

## [0.2.0] - 2017-11-20

### Added
- Added a possibility to hide a field label easily on the admin side

## [0.1.0] - 2017-11-17

### Changed
- Published a stable release

## [0.0.3-beta] - 2017-11-16

### Changed
- Fixed a bug where field instructions were not shown if instructions placement property wasn't set

## [0.0.2-beta] - 2017-11-07

### Changed
- Enhanced documentation

## [0.0.1-alpha] - 2017-10-31

### Added
- Message, link & color fields
- Datepicker, timepicker & google map fields
- Changelog file
- Added an extra value choice to select, checkbox & radio add_choice function
- Docs generator

### Changed
- Renamed various files to match the psr-4 autoload standard so the autoloading can actually work
- Changed some namespaces & extends paths so they work as well
- Made ConditionalLogicGroup add_rule $value accept others than booleans as this can be used on select fields as well
