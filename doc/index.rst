Objects
=======

Material
-------

- can have unit
- have code and name as string
- need to be assigned to category

Unit
-------

- have name and shortcut as string

Category
-------

- have name as string

Rules
=======

- ``Material`` can only be assigned to leaf ``Category``
- ``Category`` is organized as tree
- ``Category`` is independent from tree structure
- ``Category`` need to have only one parent, exception is tree's root category
