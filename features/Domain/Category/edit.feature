Feature: Category
  In order to manage categories
  As a user
  I need to edit existing category

  Background:
    Given I create root category "root"

  Scenario: Editing category
    Given I listening categories
    And I should see category "root" on list
    When I edit category "root" with new name "new_root"
    Then I listening categories
    And I should see category "new_root" on list