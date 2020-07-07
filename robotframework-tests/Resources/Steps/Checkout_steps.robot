*** Settings ***
Resource    ../Pages/Yves/Yves_Checkout_Address_Page.robot
Resource    ../Pages/Yves/Yves_Checkout_Summary_page.robot
Resource    ../Common/Common_Yves.robot

*** Variables ***
${submit_checkout_form_button}    xpath=//div[contains(@class,'form--checkout-form')]//button[@data-qa='submit-button']

*** Keywords ***
Yves: billing address same as shipping address:
    [Arguments]    ${state}
    Run Keyword If    '${state}' == 'true'    Select Checkbox    ${checkout_address_billing_same_as_shipping_checkbox}
    
Yves: select the following existing address on the checkout as 'shipping' address and go next:
    [Arguments]    ${addressToUse}
    Select From List By Label    ${checkout_address_delivery_dropdown}    ${addressToUse}
    Click Element    ${submit_checkout_form_button}
    Wait For Document Ready    

Yves: select the following shipping method on the checkout and go next:
    [Arguments]    ${shippingMethod}
    Click Element    xpath=//div[@data-qa='component shipment-sidebar']//*[contains(.,'Shipping Method')]/../ul//label[contains(.,'${shippingMethod}')]/span[contains(@class,'radio__box')]
    Click Element    ${submit_checkout_form_button}
    Wait For Document Ready    

Yves: select the following payment method on the checkout and go next:
    [Arguments]    ${paymentMethod}
    Click Element    //form[@id='payment-form']//li[@class='checkout-list__item'][contains(.,'${paymentMethod}')]//span[contains(@class,'toggler-radio__box')]
    Click Element    ${submit_checkout_form_button}
    Wait For Document Ready    

Yves: '${checkoutAction}' on the summary page
    Run Keyword If    '${checkoutAction}' == 'submit the order'    Click Element    ${checkout_summary_submit_order_button}
    # ...    ELSE IF    '${pageName}' == 'Shopping Lists'    Page Should Contain Element    ${shopping_lists_main_content_locator}
    Wait For Document Ready      
    Yves: 'Thank you' page is displayed
