Feature: Category
  In order to manage categories
  As a user
  I need to move categories

  Background:
    Given I create root category "root"
    And I listening categories
    And there are such categories:
      | name       | parent    |
      | child a    | root      |
      | child b    | root      |
      | child aa   | child a   |
      | child ab   | child a   |
      | child ac   | child a   |
      | child ba   | child b   |
      | child bb   | child b   |
      | child bba  | child bb  |
      | child bbb  | child bb  |
      | child bbba | child bbb |

  Scenario: Move node without children to other parent
    Given I listening categories
    When I change parent of "child bbba" to new "child bba"
    Then I listening categories
    And Categories should have relation to parent:
      | name       | parent    |
      | child bb   | child b   |
      | child bba  | child bb  |
      | child bbb  | child bb  |
      | child bbba | child bba |
    And Categories should have own to child:
      | name      | child      |
      | child b   | child bb   |
      | child bb  | child bba  |
      | child bb  | child bbb  |
      | child bba | child bbba |