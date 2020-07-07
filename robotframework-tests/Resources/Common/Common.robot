*** Settings ***

Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True
Library    String
Library    OperatingSystem
Resource                  ../Pages/Yves/Yves_Header_Section.robot
Resource                  ../Pages/Yves/Yves_Login_page.robot

*** Variables ***
# *** SUITE VARIABLES ***
${browser}        headlesschrome
#${browser}             chrome
# ${host}                https://shs-ecommerce-st:42vV4snUE9cghAQZq@www.shs-ecommerce-st.demo-spryker.com/
# ${zed_url}             https://shs-ecommerce-st:42vV4snUE9cghAQZq@os.shs-ecommerce-st.demo-spryker.com/
${host}                https://www.de.b2b.demo-spryker.com/
${zed_url}             https://os.de.b2b.demo-spryker.com/
${email_domain}        @spryker.com
${default_password}    change123
${loading_time}        10s
${admin_email}         admin@spryker.com
#${test_customer_email}      test.spryker+${random}@gmail.com
#${zed_log_out_button}   xpath=//ul[@class='nav navbar-top-links navbar-right']//a[contains(@href,'logout')]

*** Keywords ***
SuiteSetup
    [documentation]  Basic steps before each suite
    [tags]  common
    # Empty Directory    Results
    Open Browser    ${host}    ${browser}
    Maximize Browser Window
    ${random}=    Generate Random String    5    [NUMBERS]
    Set Global Variable    ${random}
    ${test_customer_email}=     set variable    test.spryker+${random}@gmail.com
    set global variable  ${test_customer_email}
    [Teardown]
    [Return]    ${random}

SuiteTeardown
    Delete All Cookies
    Close All Browsers

TestSetup
    Delete All Cookies
    Go To    ${host}

TestTeardown
    Delete All Cookies

Select Random Option From List
    [Arguments]    ${dropDownLocator}    ${dropDownOptionsLocator}
    ${getOptionsCount}=    Get Matching Xpath Count    ${dropDownOptionsLocator}
    ${index}=    Evaluate    random.randint(0, ${getOptionsCount}-1)    random
    ${index}=    Convert To String    ${index}
    Select From List By Index    ${dropDownLocator}    ${index}

Click element with JavaScript
    [Arguments]    ${xpath}
    Execute Javascript    document.evaluate("${xpath}", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.click()

Remove element from HTML with JavaScript
    [Arguments]    ${xpath}
    Execute Javascript 
    ...    var element=document.evaluate("${xpath}", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue;
    ...    element.parentNode.removeChild(element);