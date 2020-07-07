*** Settings ***
Resource    ../Pages/Yves/Yves_Quick_Order_page.robot

*** Keywords ***
Go to 'Quick Order' page
    Click Element    ${quick_order_icon_header_menu_item}
    Wait For Document Ready    

Yves: add the following articles into the form through quick order text area:
    [Arguments]    ${contentToUse}
    Input Text    ${quick_order_add_articles_text_area}    ${contentToUse}    clear=True
    Click Element    ${quick_order_verify_button}
    Wait For Document Ready    

Yves: add products to the shopping cart from quick order page
    Click Element    ${quick_order_add_to_cart_button}
    Wait For Document Ready   
    Yves: remove flash messages 
    
Yves: add products to the shopping list from quick order page with name:
    [Arguments]    ${shoppingListName}
    Select shopping list on 'Quick Order' page    ${shoppingListName}
    Click Element    ${quick_order_add_to_shopping_list_button}
    Wait For Document Ready   
    Yves: remove flash messages 
 