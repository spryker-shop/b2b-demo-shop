*** Settings ***
Resource    Common.robot
Resource    ../Pages/Yves/Yves_Catalog_page.robot
Resource    ../Pages/Yves/Yves_Product_Details_Page.robot
Resource    ../Pages/Yves/Yves_Company_Users_page.robot
Resource    ../Pages/Yves/Yves_Shopping_Lists_page.robot
Resource    ../Pages/Yves/Yves_Shopping_Carts_page.robot
Resource    ../Pages/Yves/Yves_Shopping_Cart_page.robot
Resource    ../Pages/Yves/Yves_Shopping_List_page.robot
Resource    ../Pages/Yves/Yves_Checkout_Success_page.robot
Resource    ../Pages/Yves/Yves_Order_History_page.robot
Resource    ../Pages/Yves/Yves_Order_Details_page.robot
Resource    ../Pages/Yves/Yves_MA_Your_Business_Unit_page.robot

*** Variable ***
${notification_area}    xpath=//section[@data-qa='component notification-area']


*** Keywords ***
Yves: login on Yves with provided credentials:
    [Arguments]    ${email}    ${password}=${default_password}
    ${currentURL}=    Get Location        
    Run Keyword Unless    '/login' in '${currentURL}'    
    ...    Run Keywords   
    ...    delete all cookies 
    ...    AND    Go To    ${host}
    ...    AND    Wait Until Element Is Visible    ${header_login_button}
    ...    AND    Click Element    ${header_login_button}
    ...    AND    Wait Until Element Is Visible    ${email_field}
    input text    ${email_field}    ${email}
    input text    ${password_field}    ${password}
    click element    ${form_login_button}
    Run Keyword Unless    'fake' in '${email}' or 'agent' in '${email}'  Wait Until Element Is Visible    ${user_navigation_icon_header_menu_item}    ${loading_time}    Dashboard page is not displayed  
    Yves: remove flash messages
    Wait For Document Ready    

Yves: go to PDP of the product with sku:
    [Arguments]    ${sku}
    Yves: perform search by:    ${sku}
    Wait Until Page Contains Element    ${catalog_product_card_locator}
    Wait For Document Ready    
    Click Element    ${catalog_product_card_locator}
    Wait For Document Ready
    Wait Until Page Contains Element    ${pdp_main_container_locator}

Yves: '${pageName}' page is displayed
    Run Keyword If    '${pageName}' == 'Company Users'    Page Should Contain Element    ${company_users_main_content_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Shopping Lists'    Page Should Contain Element    ${shopping_lists_main_content_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Shopping List'    Page Should Contain Element    ${shopping_list_main_content_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Shopping Cart'    Page Should Contain Element    ${shopping_cart_main_content_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Shopping Carts'    Page Should Contain Element    ${shopping_carts_main_content_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Quick Order'    Page Should Contain Element    ${quick_order_main_content_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Thank you'    Page Should Contain Element    ${success_page_main_container_locator}    ${pageName} page is not displayed
    ...    ELSE IF    '${pageName}' == 'Order History'    Page Should Contain Element    ${order_history_main_content_locator}    ${pageName} page is not displayed     
    ...    ELSE IF    '${pageName}' == 'Order Details'    Page Should Contain Element    ${order_details_main_content_locator}    ${pageName} page is not displayed 
    ...    ELSE IF    '${pageName}' == 'Select Business Unit'    Page Should Contain Element    ${business_unit_selector}    ${pageName} page is not displayed 

Yves: remove flash messages    ${flash_massage_state}=    Run Keyword And Ignore Error    Wait Until Page Contains Element        ${notification_area}    3s
    Log    ${flash_massage_state}
    Run Keyword If    'PASS' in ${flash_massage_state}     Remove element from HTML with JavaScript    //section[@data-qa='component notification-area']

Yves: flash message '${condition}' be shown
   Run Keyword If    '${condition}' == 'should'    Wait Until Element Is Visible    ${notification_area}    ${loading_time}
    ...    ELSE    Page Should Not Contain Element    ${notification_area}

Yves: logout on Yves as a customer
    delete all cookies
    Reload Page    

Yves: go to the 'Home' page
    Go To    ${host}

Yves: get the last placed order ID by current customer
    ${currentURL}=    Get Location        
    Run Keyword Unless    '/customer/order' in '${currentURL}'
    ...    Run Keywords   
    ...    Yves: go to the 'Home' page 
    ...    AND    Yves: go to user menu item in header:    Order History
    ...    AND    Yves: 'Order History' page is displayed
    ${lastPlacedOrder}=    Get Text    xpath=//div[contains(@data-qa,'component order-table')]//tr[1]//td[@data-content='Order Id'][1]
    Set Suite Variable    ${lastPlacedOrder}    ${lastPlacedOrder}
    [Return]    ${lastPlacedOrder}

Yves: go to URL:
    [Arguments]    ${url}
    Go To    ${host}${url}