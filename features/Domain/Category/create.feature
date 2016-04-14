Feature: Category
  In order to manage categories
  As a user
  I need to create category

  Rules:
  - then can be only one root
  - child category can have only one parent

  Scenario: Creating root category
    Given I create root category "root"
    Then I listening categories
    And I should see category "root" on list

  Scenario: Creating children category
     Given I create root category "root"
     And I listening categories
     When I create category "child 1" with parent "root"
     Then I listening categories
     And I should see category "child 1" on list