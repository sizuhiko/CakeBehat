# language: en
Feature: 
  In order to tell the masses what's on my mind
  As a user
  I want to read articles on the site

  Background:
    Given there is a post:
      | Title | Body |
      | The title | This is the post body. |
      | A title once again | And the post body follows. |
      | Title strikes back | This is really exciting! Not. |

  Scenario: Show articles
    When I am on TopPage
    Then I should see "The title"
    And  I should see "A title once again"
    And  I should see "Title strikes back"

  Scenario: Show the article
    Given I am on TopPage
    When  I follow "A title once again"
    Then  I should see "And the post body follows."
