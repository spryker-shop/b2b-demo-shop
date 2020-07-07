*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True
Library    String
Library    BuiltIn
Library    Collections
Resource    ../Pages/Yves/Yves_Product_Details_Page.robot
Resource    ../Common/Common_Yves.robot

*** Variable ***
${price}    ${pdp_price_element_locator}
${addToCartButton}    ${pdp_add_to_cart_button}
${alternativeProducts}    ${pdp_alternative_products_slider}
${measurementUnitSuggestion}    ${pdp_measurement_unit_notification}
${packagingUnitSuggestion}    ${pdp_packaging_unit_notification}
${bundleItemsSmall}    ${pdp_product_bundle_include_small}
${bundleItemsLarge}    ${pdp_product_bundle_include_large}
${relatedProducts}    ${pdp_related_products}

*** Keywords ***
Yves: PDP contains/doesn't contain: 
    [Arguments]    ${condition}    @{pdp_elements_list}    ${element1}=${EMPTY}     ${element2}=${EMPTY}     ${element3}=${EMPTY}     ${element4}=${EMPTY}     ${element5}=${EMPTY}     ${element6}=${EMPTY}     ${element7}=${EMPTY}     ${element8}=${EMPTY}     ${element9}=${EMPTY}     ${element10}=${EMPTY}     ${element11}=${EMPTY}     ${element12}=${EMPTY}     ${element13}=${EMPTY}     ${element14}=${EMPTY}     ${element15}=${EMPTY}
    ${pdp_elements_list_count}=   get length  ${pdp_elements_list}
    FOR    ${index}    IN RANGE    0    ${pdp_elements_list_count}
        ${pdp_element_to_check}=    Get From List    ${pdp_elements_list}    ${index}
        Run Keyword If    '${condition}' == 'true'    
        ...    Run Keywords
        ...    Log    ${pdp_element_to_check}    #Left as an example of multiple actions in Condition
        ...    AND    Page Should Contain Element    ${pdp_element_to_check}    message=${pdp_element_to_check} is not displayed
        Run Keyword If    '${condition}' == 'false'    
        ...    Run Keywords
        ...    Log    ${pdp_element_to_check}    #Left as an example of multiple actions in Condition
        ...    AND    Page Should Not Contain Element    ${pdp_element_to_check}    message=${pdp_element_to_check} should not be displayed
    END

Yves: add product to the shopping cart
    Wait Until Page Contains Element    ${pdp_add_to_cart_button}
    Click Element    ${pdp_add_to_cart_button}
    Wait For Document Ready    
    Yves: remove flash messages

Yves: change quantity on PDP:
    [Arguments]    ${qtyToSet}
    Input Text    ${pdp_quantity_input_filed}    ${qtyToSet}

Yves: select the following 'Sales Unit' on PDP:
    [Arguments]    ${salesUnit}
    Wait Until Element Is Visible    ${pdp_measurement_sales_unit_selector}
    Select From List By Label    ${pdp_measurement_sales_unit_selector}    ${salesUnit}
    Wait For Document Ready    

Yves: change quantity using '+' or '-' button № times:
    [Arguments]    ${action}    ${clicksCount}
    FOR    ${index}    IN RANGE    0    ${clicksCount}
        Run Keyword If    '${action}' == '+'    Click Element    ${pdp_increase_quantity_button}
        ...    ELSE IF    '${action}' == '-'    Click Element    ${pdp_decrease_quantity_button} 
    END

Yves: change variant of the product on PDP on:
    [Arguments]    ${variantToChoose}
    Select From List By Label    ${pdp_variant_selector}    ${variantToChoose}
    Wait For Document Ready    

Yves: change amount on PDP:
    [Arguments]    ${amountToSet}
    Input Text    ${pdp_amount_input_filed}    ${amountToSet}

Yves: product price on the PDP should be:
    [Arguments]    ${expectedProductPrice}
    ${actualProductPrice}=    Get Text    ${pdp_price_element_locator}
    Should Be Equal    ${expectedProductPrice}    ${actualProductPrice}

Yves: add product to the shopping list
    Wait Until Element Is Visible    ${pdp_add_to_shopping_list_button}
    Click Element    ${pdp_add_to_shopping_list_button}
    Wait For Document Ready    
    Wait For Testability Ready    
    Yves: remove flash messages