Feature: Material
  In order to manage materials
  As a user
  I need to edit material

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
    And there are such materials:
      | name | code | unit      | category |
      | wood | www  | grams     | child a  |
      | iron | ir   | kilograms | child b  |

  Scenario: Edit material
    When I edit material "wood" and change:
      | name     | code | unit      | category |
      | wet wood | ww   | kilograms | child b  |
    Then I listening materials
    And I should see given materials:
      | name     | code | unit      | category |
      | wet wood | ww   | kilograms | child b  |
      | iron     | ir   | kilograms | child b  |

  Scenario: Edit material and assign not to leaf category
    When I edit material "wood" and change:
      | name     | code | unit      | category |
      | wet wood | ww   | kilograms | child c  |
    Then I should be notice of limitation - only leafs assign
    And I listening materials
    And I should see given materials:
      | name | code | unit      | category |
      | wood | www  | grams     | child a  |
      | iron | ir   | kilograms | child b  |