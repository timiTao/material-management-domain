Feature: Category
  In order to manage categories
  As a user
  I need to list categories

  Background:
    Given I create root category "root"
    And there are such categories:
      | name    | parent |
      | child a | root   |
      | child b | root   |

  Scenario: See view with list of categories
    Given I listening categories
    Then I should see given categories:
      | name    |
      | child a |
      | child b |
