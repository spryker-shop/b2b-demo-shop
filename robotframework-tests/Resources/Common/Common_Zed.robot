*** Settings ***
Library    BuiltIn
Resource                  Common.robot
Resource                  ../Pages/Zed/Zed_Login_page.robot

*** Variable ***
${zed_log_out_button}   xpath=//ul[@class='nav navbar-top-links navbar-right']//a[contains(@href,'logout')]
${zed_save_button}      xpath=//input[contains(@class,'safe-submit')]
${zed_success_flash_message}    xpath=//div[@class='flash-messages']/div[@class='alert alert-success']
${zed_table_locator}    xpath=//table[contains(@class,'dataTable')]/tbody
${zed_search_field_locator}     xpath=//input[@type='search']
${zed_processing_block_locator}     xpath=//div[contains(@class,'dataTables_processing')][@style='display: none;']
  
*** Keywords ***
Zed: login on Zed with provided credentials:
    [Arguments]    ${email}    ${password}=${default_password}
    delete all cookies
    go to    ${zed_url}
    Wait Until Element Is Visible    ${zed_user_name_field}
    input text    ${zed_user_name_field}    ${email}
    input text    ${zed_password_field}    ${password}
    click element    ${zed_login_button}
    Wait Until Element Is Visible    ${zed_log_out_button}    ${loading_time}    Zed:Dashboard page is not displayed

Zed: go to first navigation item level:
    [Documentation]     example: "Zed: Go to First Navigation Item Level  Customers"
    [Arguments]     ${navigation_item}
    Click element with JavaScript    //span[contains(@class,'nav-label')][contains(text(),'${navigation_item}')]/../../a

Zed: go to second navigation item level:
    [Documentation]     example: "Zed: Go to Second Navigation Item Level    Customers    Customer Access"
    [Arguments]     ${navigation_item_level1}   ${navigation_item_level2}
    ${node_state}=    Get Element Attribute  xpath=(//span[contains(@class,'nav-label')][contains(text(),'${navigation_item_level1}')]/ancestor::li)[1]    class
    log    ${node_state}
    Run Keyword If    'active' in '${node_state}'   run keywords  wait until element is visible  xpath=//ul[contains(@class,'nav-second-level')]//a/span[text()='${navigation_item_level2}']
    ...    AND      click element  xpath=//ul[contains(@class,'nav-second-level')]//a/span[text()='${navigation_item_level2}']
    ...    ELSE     run keywords    Click element with JavaScript    //span[contains(@class,'nav-label')][contains(text(),'${navigation_item_level1}')]/../../a
    ...    AND      wait until element is visible  xpath=//ul[contains(@class,'nav-second-level')]//a/span[text()='${navigation_item_level2}']
    ...    AND      click element  xpath=//ul[contains(@class,'nav-second-level')]//a/span[text()='${navigation_item_level2}']

Zed: click button in Header:
    [Arguments]    ${button_name}
    wait until element is visible    xpath=//div[@class='title-action']/a[contains(.,'${button_name}')]
    click element    xpath=//div[@class='title-action']/a[contains(.,'${button_name}')]

Zed: click Action Button in a table for row that contains:
    [Arguments]    ${row_content}    ${zed_table_action_button_locator}
    Zed: perform search by:    ${row_content}
    wait until element is visible    xpath=//table[contains(@class,'dataTable')]/tbody//td[contains(text(),'${row_content}')]/../td[position()=last()]/*[contains(.,'${zed_table_action_button_locator}')]
    click element    xpath=//table[contains(@class,'dataTable')]/tbody//td[contains(text(),'${row_content}')]/../td[position()=last()]/*[contains(.,'${zed_table_action_button_locator}')]

Zed: select checkbox by Label:
    [Arguments]    ${checkbox_label}
    wait until element is visible    xpath=//input[@type='checkbox']/../../label[contains(text(),'${checkbox_label}')]//input
    select checkbox    xpath=//input[@type='checkbox']/../../label[contains(text(),'${checkbox_label}')]//input

Zed: unselect checkbox by Label:
    [Arguments]    ${checkbox_label}
    wait until element is visible    xpath=//input[@type='checkbox']/../../label[contains(text(),'${checkbox_label}')]//input
    unselect checkbox    xpath=//input[@type='checkbox']/../../label[contains(text(),'${checkbox_label}')]//input

Zed: submit the form
    wait until element is visible    ${zed_save_button}
    click element   ${zed_save_button}

Zed: perform search by:
    [Arguments]    ${search_key}
    input text    ${zed_search_field_locator}    ${search_key}
    sleep    2s
    wait until page contains element    ${zed_processing_block_locator}

Zed: table should contain:
    [Arguments]    ${search_key}
    Zed: perform search by:    ${search_key}
    table should contain    ${zed_table_locator}  ${search_key}
