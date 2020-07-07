*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True

*** Variable ***
${pdp_main_container_locator}    xpath=//main[contains(@class,'page-layout-main--pdp')]//div[@class='container']
${pdp_price_element_locator}    xpath=//span[contains(@class,'volume-price__price')]
${pdp_add_to_cart_button}    xpath=//button[@data-qa='add-to-cart-button']
${pdp_quantity_input_filed}    xpath=//form[@class='js-product-configurator__form']//input[@name='quantity']
${pdp_alternative_products_slider}    xpath=//*[@data-qa='component product-alternative-slider']
${pdp_measurement_sales_unit_selector}    name=id-product-measurement-sales-unit
${pdp_measurement_unit_notification}    id=measurement-unit-choices
${pdp_increase_quantity_button}    xpath=//form[@class='js-product-configurator__form']//button[contains(@class,'quantity-counter__button--increment')]
${pdp_decrease_quantity_button}    xpath= //form[@class='js-product-configurator__form']//button[contains(@class,'quantity-counter__button--decrement')]
${pdp_variant_selector}    xpath=//*[@data-qa='component variant']//select
${pdp_amount_input_filed}    id=user-amount
${pdp_packaging_unit_notification}    xpath=//*[@class='packaging-unit-notifications']
${pdp_product_bundle_include_small}    xpath=//div[@class='js-product-options-bundle__target']
${pdp_product_bundle_include_large}    xpath=//div[@data-qa='component product-bundle']
${pdp_related_products}    xpath=//*[contains(@class,'title--product-slider')][contains(.,'Similar products')]/../slick-carousel
${pdp_add_to_shopping_list_button}    xpath=//button[@data-qa='add-to-shopping-list-button']