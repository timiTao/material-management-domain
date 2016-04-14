Feature: Material
  In order to manage materials
  As a user
  I need to create material

  Background:
    Given I create root category "root"
    And there are such categories:
      | name    | parent  |
      | child a | root    |
      | child b | root    |
      | child c | root    |
      | child d | child c |
    And there are such units:
      | name      | shortcut |
      | kilograms | kg       |
      | grams     | g        |

  Scenario: Creating material with unit
    When I create material "wood" and code "www" with unit "grams" in category "child a"
    Then I listening materials
    And I should see material "wood" on list

  Scenario: Creating material without unit
    When I create material "iron" and code "i" in category "child b"
    Then I listening materials
    And I should see material "iron" on list

  Scenario: Creating material and assign not to leaf category
    When I create material "wood" and code "www" with unit "grams" in category "child c"
    Then I should be notice of limitation - only leafs assign
