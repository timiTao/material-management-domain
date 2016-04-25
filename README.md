[![License](https://poser.pugx.org/timitao/material-management-domain/license.svg)](https://packagist.org/packages/timitao/material-management-domain)
[![Latest Stable Version](https://poser.pugx.org/timitao/material-management-domain/v/stable.svg)](https://packagist.org/packages/timitao/material-management-domain)
[![Latest Unstable Version](https://poser.pugx.org/timitao/material-management-domain/v/unstable.svg)](https://packagist.org/packages/timitao/material-management-domain)
[![Total Downloads](https://poser.pugx.org/timitao/material-management-domain/downloads.svg)](https://packagist.org/packages/timitao/material-management-domain)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/08061367-1d1a-46af-9b56-6a44280933e9/mini.png)](https://insight.sensiolabs.com/projects/08061367-1d1a-46af-9b56-6a44280933e9)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/timiTao/material-management-domain/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/timiTao/material-management-domain/?branch=master)
[![Build Status](https://travis-ci.org/timiTao/material-management-domain.svg?branch=master)](https://travis-ci.org/timiTao/material-management)


Material management Domain
=======

Proof of concept - hexagonal architecture.

Sources:
- https://www.youtube.com/watch?v=o7RuWf0mniQ
- http://fideloper.com/hexagonal-architecture

Code sources as examples:
- https://github.com/cocoders/FileArchive
- https://github.com/cocoders/FileArchiveSymfony

## Documentation

[Documentation](doc/index.rst).

## Implementation

- As Symfony2 web application: [Material-management](https://github.com/timiTao/material-management)

## Test's command

To run behat Domain tests

- ``php bin/behat --suite="DomainCategory"``
- ``php bin/behat --suite="DomainUnit"``
- ``php bin/behat --suite="DomainMaterial"``

Scenarios are at folder ``features/Domain``

## Versioning

Staring version ``1.0.0``, will follow [Semantic Versioning v2.0.0](http://semver.org/spec/v2.0.0.html).

## Contributors

* Tomasz Kunicki [TimiTao](http://github.com/timiTao) [lead developer]

