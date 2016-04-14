Feature: Unit
  In order to manage units
  As a user
  I need to create units

  Scenario: Creating unit
    Given I create unit "kilogram" with shortcut "kg"
    Then I listening units
    And I should see unit "kilogram" on list