*** Settings ***
Resource    ../Common/Common.robot
Resource    ../Pages/Yves/Yves_Shopping_Lists_page.robot
Resource    ../Common/Common_Yves.robot

*** Keywords ***
Yves: 'Shopping List' widget contains:
    [Arguments]    ${shoppingListName}    ${accessLevel}
    Wait Until Element Is Visible    ${shopping_list_icon_header_menu_item}
    Mouse Over    ${shopping_list_icon_header_menu_item}
    Wait Until Element Is Visible    ${shopping_list_sub_navigation_widget}
    Page Should Contain Element    xpath=//*[contains(@class,'icon--header-shopping-list')]/ancestor::li//div[contains(@class,'js-user-navigation__sub-nav-shopping-list')]//span[text()[contains(.,'${accessLevel}')]]/..//a/*[text()='${shoppingListName}']

Go to 'Shopping Lists' page
    Mouse Over    ${shopping_list_icon_header_menu_item}
    Wait Until Page Contains Element    ${shopping_list_sub_navigation_widget}
    Click Element    ${shopping_list_sub_navigation_all_lists_button}
    Wait For Document Ready    

Yves: create new 'Shopping List' with name:
    [Arguments]    ${shoppingListName}
    ${currentURL}=    Get Location        
    Run Keyword Unless    '/shopping-list' in '${currentURL}'    Go To    ${host}shopping-list
    Input Text    ${shopping_list_name_input_field}    ${shoppingListName}
    Click Element    ${create_shopping_list_button}
    Wait For Document Ready 

Yves: the following shopping list is shown:
    [Arguments]    ${shoppingListName}    ${shoppingListOwner}    ${shoppingListAccess}
    Page Should Contain Element    xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Access'][contains(.,'${shoppingListAccess}')]/../td[@data-content='Owner'][contains(.,'${shoppingListOwner}')]/../td[@data-content='Name'][contains(.,'${shoppingListName}')]

Yves: share shopping list with user:
    [Arguments]    ${shoppingListName}    ${customer}    ${accessLevel}
    Share shopping list with name:    ${shoppingListName} 
    Select access level to share shopping list with:    ${customer}    ${accessLevel}
    Click Element    ${share_shopping_list_confirm_button}
    Yves: 'Shopping Lists' page is displayed
    Yves: flash message 'should' be shown

# Yves: the following shopping cart is shown:
#     [Arguments]    ${shoppingCartName}    ${shoppingCartAccess}
#     Page Should Contain Element    xpath=//*[@data-qa="component shopping-list-overview-table"]//table//td[@data-content='Access'][contains(.,'${shoppingListAccess}')]/../td[@data-content='Owner'][contains(.,'${shoppingListOwner}')]/../td[@data-content='Name'][contains(.,'${shoppingListName}')]

Yves: shopping list contains the following products:
    [Arguments]    @{sku_list}    ${sku1}=${EMPTY}     ${sku2}=${EMPTY}     ${sku3}=${EMPTY}     ${sku4}=${EMPTY}     ${sku5}=${EMPTY}     ${sku6}=${EMPTY}     ${sku7}=${EMPTY}     ${sku8}=${EMPTY}     ${sku9}=${EMPTY}     ${sku10}=${EMPTY}     ${sku11}=${EMPTY}     ${sku12}=${EMPTY}     ${sku13}=${EMPTY}     ${sku14}=${EMPTY}     ${sku15}=${EMPTY}
    ${sku_list_count}=   get length  ${sku_list}
    FOR    ${index}    IN RANGE    0    ${sku_list_count}
        ${sku_to_check}=    Get From List    ${sku_list}    ${index}
        Page Should Contain Element    xpath=//*[@data-qa='component shopping-list-table']//div[contains(@class,'product-card-item__col--description')]//div[contains(.,'SKU: ${sku_to_check}')]/ancestor::article
    END  