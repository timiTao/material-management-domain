Material management
=======

Proof of concept - hexagonal architecture.

Sources:
- https://www.youtube.com/watch?v=o7RuWf0mniQ
- http://fideloper.com/hexagonal-architecture

Code sources as examples:
- https://github.com/cocoders/FileArchive
- https://github.com/cocoders/FileArchiveSymfony

## Test's command

To run behat Domain tests

- ``php bin/behat --suite="DomainCategory"``
- ``php bin/behat --suite="DomainUnit"``
- ``php bin/behat --suite="DomainMaterial"``

Scenarios are at folder ``features/Domain``
