*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True

*** Variables ***
${quick_order_main_content_locator}    name=quick_order_form
${quick_order_add_articles_text_area}    id=text_order_form_textOrder
${quick_order_verify_button}    name=textOrder
${quick_order_add_to_cart_button}    name=addToCart
${quick_order_create_order_button}    name=createOrder
${quick_order_add_to_shopping_list_button}    name=addToShoppingList
${quick_order_shopping_list_selector}    name=idShoppingList

*** Keywords ***
Select shopping list on 'Quick Order' page
    [Arguments]    ${shoppingListName}
    Select From List By Label    ${quick_order_shopping_list_selector}    ${shoppingListName}