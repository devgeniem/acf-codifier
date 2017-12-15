# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [1.2.0-beta] - 2017-12-01

### Added
- Added a more effective version of ACF's get_fields() method to use with the Codifier
    - Cache ttl is set to 15 minutes by default and it can be changed 
      with the `ACF_CODIFIER_CACHE_TTL` constant or through the `acf_codifier_cache_ttl` filter.
    - Meta value caches are flushed after any meta value is updated.
- Codifier settings which are overridable with constants.

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
