Feature: Material
  In order to manage materials
  As a user
  I need to list materials

  Background:
    Given I create root category "root"
    And there are such categories:
      | name    | parent |
      | child a | root   |
      | child b | root   |
    And there are such units:
      | name      | shortcut |
      | kilograms | kg       |
      | grams     | g        |
    And there are such materials:
      | name | code | unit      | category |
      | wood | www  | grams     | child a  |
      | iron | ir   | kilograms | child b  |

  Scenario: See view with list of units
    Given I listening materials
    Then I should see given materials:
      | name | code | unit      | category |
      | wood | www  | grams     | child a  |
      | iron | ir   | kilograms | child b  |