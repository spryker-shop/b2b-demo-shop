*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True
Library    BuiltIn
Resource    ../Common/Common_Yves.robot
Resource    ../Common/Common_Zed.robot
Resource    ../Pages/Zed/Zed_Attach_to_Business_Unit_page.robot
Resource    ../Pages/Yves/Yves_MA_Your_Business_Unit_page.robot


*** Keywords ***
Zed: create new Company Business Unit with provided name and company:
    [Documentation]     Creates new company BU with provided BU Name and for provided company.
    [Arguments]    ${bu_name_to_set}    ${company_business_unit}
    Zed: go to second navigation item level:    Company Account    Company Units
    Zed: click button in Header:    Create Company Business Unit
    select from list by label    ${zed_bu_company_dropdown_locator}    ${company_business_unit}
    input text    ${zed_bu_name_field}    ${bu_name_to_set}
    input text    ${zed_bu_iban_field}    testiban+${random}
    input text    ${zed_bu_bic_field}    testbic+${random}
    Zed: submit the form
    wait until element is visible    ${zed_success_flash_message}
    wait until element is visible    ${zed_table_locator}
    Zed: perform search by:    ${bu_name_to_set}
    table should contain    ${zed_table_locator}    ${bu_name_to_set}
    ${newly_created_business_unit_id}=      get text    xpath=//table[contains(@class,'dataTable')]/tbody//td[contains(text(),'${bu_name_to_set}')]/../td[1]
    log    ${newly_created_business_unit_id}
    set suite variable    ${newly_created_business_unit_id}

Zed: create new Company with provided name:
    [Arguments]    ${company_name}
    Zed: go to second navigation item level:    Company Account    Companies
    Zed: click button in Header:    Create Company
    wait until element is visible    id=company_name
    input text    ${zed_company_name_input_field}    ${company_name}
    Zed: submit the form
    wait until element is visible    ${zed_success_flash_message}
    wait until element is visible    ${zed_table_locator}
    table should contain    ${zed_table_locator}    ${company_name}

Zed: create new Company Role with provided permissions:
    [Documentation]     Creates new company role with provided permission. Permissions are optional
    [Arguments]     ${select_company_for_role}     ${new_role_name}    ${is_default}      @{permissions_list}    ${permission1}=${EMPTY}     ${permission2}=${EMPTY}     ${permission3}=${EMPTY}     ${permission4}=${EMPTY}     ${permission5}=${EMPTY}     ${permission6}=${EMPTY}     ${permission7}=${EMPTY}     ${permission8}=${EMPTY}     ${permission9}=${EMPTY}     ${permission10}=${EMPTY}     ${permission11}=${EMPTY}     ${permission12}=${EMPTY}     ${permission13}=${EMPTY}     ${permission14}=${EMPTY}     ${permission15}=${EMPTY}
    Zed: go to second navigation item level:     Company Account    Company Roles
    Zed: click button in Header:    Add company user role
    ${new_list_of_permissions}=    get length    ${permissions_list}
    log    ${new_list_of_permissions}
    run keyword if  '${is_default}'=='true'     Zed: select checkbox by Label:  Is Default
    FOR    ${index}    IN RANGE    0    ${new_list_of_permissions}
        ${permission_to_set}=    Get From List    ${permissions_list}    ${index}
        Log    ${permission_to_set}
        Zed: select checkbox by Label:   ${permission_to_set}
    END
    select from list by label    ${zed_role_company_dropdown_locator}    ${select_company_for_role}
    input text    ${zed_role_name_field}    ${new_role_name}
    Zed: submit the form
    Zed: perform search by:    ${new_role_name}
    table should contain    ${zed_table_locator}    ${new_role_name}

Zed: Create new Company User with provided email/company/business unit and role(s):
    [Arguments]    ${email}    ${company}    ${business_unit}    ${role}
    Zed: go to second navigation item level:    Company Account    Company Users
    wait until element is visible    ${zed_table_locator}
    Zed: click button in Header:    Add User
    input text    ${zed_create_company_user_email_field}  ${email}
    select from list by label    ${zed_create__company_user_salutation_dropdown}    Mr
    Zed: select checkbox by Label:    Send password token through email
    input text    ${zed_create_company_user_first_name_field}    Robot First+${random}
    input text    ${zed_create_company_user_last_name_field}    robot Last+${random}
    select from list by label    ${zed_create_company_user_gender_dropdow}    Male
    input text    ${zed_create_company_user_dob_picker}    25.10.1989
    input text    ${zed_create_company_user_phone_field}    495-123-45-67
    select from list by label    ${zed_create_company_company_name_dropdown}    ${company}
    sleep    2s
    select from list by label    ${zed_create_company_business_unit_dropdown}    ${business_unit}
    Zed: select checkbox by Label:    ${role}
    Zed: submit the form
    wait until element is visible    ${zed_success_flash_message}
    wait until element is visible    ${zed_table_locator}
    Zed: perform search by:    Robot First+${random}
    table should contain    ${zed_table_locator}    Robot First+${random}

Zed: attach company user to the following BU with role:
    [Arguments]    ${business_unit}    ${role_checkbox}
    Wait Until Element Is Visible    ${zed_business_unit_selector}
    Select From List By Label    ${zed_business_unit_selector}    ${business_unit}
    Zed: select checkbox by Label:    ${role_checkbox}
    Zed: submit the form
    Wait For Document Ready

Yves: 'Business Unit' dropdown contains:
    [Arguments]    @{business_units_list}    ${element1}=${EMPTY}     ${element2}=${EMPTY}     ${element3}=${EMPTY}     ${element4}=${EMPTY}     ${element5}=${EMPTY}     ${element6}=${EMPTY}     ${element7}=${EMPTY}     ${element8}=${EMPTY}     ${element9}=${EMPTY}     ${element10}=${EMPTY}     ${element11}=${EMPTY}     ${element12}=${EMPTY}     ${element13}=${EMPTY}     ${element14}=${EMPTY}     ${element15}=${EMPTY}
    ${business_units_list_count}=   get length  ${business_units_list}
    FOR    ${index}    IN RANGE    0    ${business_units_list_count}
        ${business_unit_to_check}=    Get From List    ${business_units_list}    ${index}
        Page Should Contain Element    //select[@id='company_user_account_selector_form_companyUserAccount']/option[contains(.,'${business_unit_to_check}')]
    END