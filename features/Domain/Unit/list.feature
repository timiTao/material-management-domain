Feature: Unit
  In order to manage units
  As a user
  I need to list units

  Background:
    Given there are such units:
      | name      | shortcut |
      | kilograms | kg       |
      | grams     | g        |

  Scenario: See view with list of units
    Given I listening units
    Then I should see given units:
      | name      | shortcut |
      | kilograms | kg       |
      | grams     | g        |