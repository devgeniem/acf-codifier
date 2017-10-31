# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [0.0.1] - 2017-10-31

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
