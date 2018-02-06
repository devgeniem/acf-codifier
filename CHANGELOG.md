# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [1.3.0] - 2018-02-06

### Added
- A support for installing the Codifier as an ordinary plugin instead of autoloaded mu-plugin.

### Changed
- Enhanced the documentation to reflect the above-mentioned change.

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

## Changed
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
