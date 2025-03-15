# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [3.0.0] - 2025-03-15
### Changed
- Updated to Bootstrap 5 support
- Modernized CSS features with CSS Grid and Flexbox utilities
- Improved accessibility with ARIA attributes
- Added comprehensive documentation
- Added unit and functional tests
- Added Twig templates as alternatives to PHP templates
- Added bundle configuration options
- Enhanced responsive features
- Improved multilingual support
- Refactored code for better maintainability

## [2.0.0] - 2025-03-15
### Changed
- Updated PHP requirement to ^8.1
- Updated Contao requirement to ^5.0
- Updated dev dependencies to newer versions
- Replaced annotations with PHP 8 attributes
- Used constructor property promotion
- Added proper type hints
- Improved documentation
- Renamed services.yml to services.yaml
- Improved service configuration
- Updated dependency injection
- Fixed asset path naming convention
- Removed redundant docblocks
- Improved class structure
- Enhanced backend detection in content elements
- Added proper type declarations

## [1.1.6] - 2023-02-28
### Fixed
- Fixed a faulty if statement causing way to many css classes

## [1.1.5] - 2021-09-12
### Added
- Added missing semicolons (thx @w3scout for your support!)

## [1.1.4] - 2021-06-22
### Added
- Added w100 to backend styles

## [1.1.3] - 2021-06-01
### Added
- Add w75 for backend dca fields

## [1.1.2] - 2021-06-01
### Added
- Fix bundle order for custom elements
- fix callback priority

## [1.1.1] - 2021-04-04
### Fixed
- Make service public and fix a string error

## [1.1.0] - 2021-04-03
### Fixed
- Loads of refactoring (thx @rabauss for your work!)

## [1.0.4] - 2021-04-03
### Fixed
- Fix File naming.....

## [1.0.3] - 2020-12-14
### Fixed
- Fix CSS Bug for Bootstrap4

## [1.0.2] - 2019-09-19
### Fixed
- Moved the HexToRgba function to a service

## [1.0.1] - 2019-09-17
### Fixed
- changed github name to lower cases to rename package

## [1.0.0] - 2019-09-17
### Initial Release
This is the initial release of a bundle I have created a couple of years ago and since used internally.
I now modified it to work as regular Contao 4 Bundndle and fixed some errors I noticed on the way.

If you have any recomendations on what to optimize, please don't hesitate to create an issue or PR.
