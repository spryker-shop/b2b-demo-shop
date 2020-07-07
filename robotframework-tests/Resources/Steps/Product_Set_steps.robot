*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True
Resource    ../Pages/Yves/Yves_Product_Sets.robot
Resource    ../Common/Common_Yves.robot

*** Keywords ***
Yves: 'Product Sets' page contains the following sets:
    [Arguments]    @{product_set_list}    ${productSet1}=${EMPTY}     ${productSet2}=${EMPTY}     ${productSet3}=${EMPTY}     ${productSet4}=${EMPTY}     ${productSet5}=${EMPTY}     ${productSet6}=${EMPTY}     ${productSet7}=${EMPTY}     ${productSet8}=${EMPTY}     ${productSet9}=${EMPTY}     ${productSet10}=${EMPTY}     ${productSet11}=${EMPTY}     ${productSet12}=${EMPTY}     ${productSet13}=${EMPTY}     ${productSet14}=${EMPTY}     ${productSet15}=${EMPTY}
    ${product_set_list_count}=   get length  ${product_set_list}
    FOR    ${index}    IN RANGE    0    ${product_set_list_count}
        ${product_set_to_check}=    Get From List    ${product_set_list}    ${index}
        Page Should Contain Element    xpath=//*[contains(@class,'product-set-card__name')][text()="${product_set_to_check}"]/ancestor::article
    END

Yves: view the following Product Set:
    [Arguments]    ${productSetName}
    Click Element    xpath=//*[contains(@class,'product-set-card__name')][text()="${productSetName}"]/ancestor::article

Yves: 'Product Set' page contains the following products:
    [Arguments]    @{product_name_list}    ${productName1}=${EMPTY}     ${productName2}=${EMPTY}     ${productName3}=${EMPTY}     ${productName4}=${EMPTY}     ${productName5}=${EMPTY}     ${productName6}=${EMPTY}     ${productName7}=${EMPTY}     ${productName8}=${EMPTY}     ${productName9}=${EMPTY}     ${productName10}=${EMPTY}     ${productName11}=${EMPTY}     ${productName12}=${EMPTY}     ${productName13}=${EMPTY}     ${productName14}=${EMPTY}     ${productName15}=${EMPTY}
    ${product_name_list_count}=   get length  ${product_name_list}
    FOR    ${index}    IN RANGE    0    ${product_name_list_count}
        ${product_name_to_check}=    Get From List    ${product_name_list}    ${index}
        Page Should Contain Element    xpath=//*[contains(@class,'product-card--sets')]//a[contains(.,'${product_name_to_check}')]/ancestor::article
    END

Yves: change variant of the product on CMS page on:
    [Arguments]    ${productName}    ${variantToSet}
    Mouse Over    xpath=//*[contains(@class,'product-card--sets')]//a[contains(.,'${productName}')]/ancestor::article//select
    Select From List By Label    xpath=//*[contains(@class,'product-card--sets')]//a[contains(.,'${productName}')]/ancestor::article//select    ${variantToSet}
    Wait For Document Ready    

Yves: add all products to the shopping cart from Product Set
    Click Element    ${add_all_product_to_the_shopping_cart}
    Yves: remove flash messages