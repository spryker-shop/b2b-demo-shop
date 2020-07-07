*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True
# Library    String
# Library    BuiltIn
# Library    Collections
Resource    ../Pages/Yves/Yves_Catalog_page.robot

*** Keywords ***
Yves: 'Catalog' page should show products:
    [Arguments]    ${productsCount}
    Wait Until Element Is Visible    ${catalog_products_counter_locator}
    Element Should Contain    ${catalog_products_counter_locator}    ${productsCount}

Yves: product with name in the catalog should have price:
    [Arguments]    ${productName}    ${expectedProductPrice}
    ${actualProductPrice}=    Get Text    xpath=//article[@data-qa='component product-card']//a[text()='${productName}']/..//*[@data-qa='component money-price']/*[contains(@class,'money-price__amount')]
    Should Be Equal    ${actualProductPrice}    ${expectedProductPrice}