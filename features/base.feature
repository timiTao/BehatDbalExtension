Feature: base connections

  Scenario: Test connections
    Given Dbal load data to table "test" :
      | name  |
      | test3 |
      | test4 |
    Then Dbal set current connection alias as "alias1"
    And Dbal expect to have in table "test" at least:
      | name  |
      | test3 |
      | test4 |
    Then Dbal truncate table "test"
    Then Dbal set current connection alias as "default"
    And Dbal run sql "SELECT * FROM test"
