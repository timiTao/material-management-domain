Feature: Unit
  In order to manage units
  As a user
  I need to edit existing unit

  Background:
    Given I create unit "kilogram" with shortcut "kg"

  Scenario: Editing unit
    Given I listening units
    And I should see unit "kilogram" on list
    When I edit unit "kilogram" with new name "grams" and "g" shortcut
    Then I listening units
    And I should see unit "grams" on list