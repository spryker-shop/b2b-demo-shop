*** Variable ***
${shopping_lists_main_content_locator}    xpath=//div[@data-qa='component shopping-list-overview-table']
${shopping_list_name_input_field}    id=shopping_list_form_name
${create_shopping_list_button}    xpath=//form[@name='shopping_list_form']//button[@data-qa='submit-button']
${share_shopping_list_customers_section}    xpath=//div[@data-qa="component company-dashbord-item"]//*[text()='Customer']/../../div[@data-qa='component share-list']
${share_shopping_list_business_unit_section}    xpath=//div[@data-qa="component company-dashbord-item"]//*[text()='Business Unit']/../../div[@data-qa='component share-list']
${share_shopping_list_confirm_button}    xpath=//form[@name='share_shopping_list_form']//button[@data-qa='submit-button']

*** Keywords ***
Select access level to share shopping list with:
    [Arguments]    ${customerToShareWith}    ${accessLevel}
    Select From List By Label    xpath=//div[@data-qa="component company-dashbord-item"]//*[text()='Customer']/../../div[@data-qa='component share-list']//li[contains(.,'${customerToShareWith}')]//select    ${accessLevel}  

Edit shopping list with name:
    [Arguments]    ${shoppingListName}       
    Click Element    xpath=xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Name'][contains(.,'${shoppingListName}')]/..//div[@data-qa='component table-action-list']//a[contains(.,'Edit')]

Share shopping list with name:
    [Arguments]    ${shoppingListName}       
    Click Element    xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Name'][contains(.,'${shoppingListName}')]/..//div[@data-qa='component table-action-list']//a[contains(.,'Share')]

Print shopping list with name:
    [Arguments]    ${shoppingListName}       
    Click Element    xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Name'][contains(.,'${shoppingListName}')]/..//div[@data-qa='component table-action-list']//a[contains(.,'Print')]

Delete shopping list with name:
    [Arguments]    ${shoppingListName}       
    Click Element    xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Name'][contains(.,'${shoppingListName}')]/..//div[@data-qa='component table-action-list']//a[contains(.,'Delete')]

Dismiss shopping list with name:
    [Arguments]    ${shoppingListName}       
    Click Element    xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Name'][contains(.,'${shoppingListName}')]/..//div[@data-qa='component table-action-list']//a[contains(.,'Dismiss')]
