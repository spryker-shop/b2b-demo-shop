*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True

*** Variable ***
${catalog_product_card_locator}    xpath=(//article[@data-qa='component product-card'])[1]
${catalog_products_counter_locator}    xpath=//*[contains(@class,'col--counter')]

