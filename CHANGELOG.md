# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
