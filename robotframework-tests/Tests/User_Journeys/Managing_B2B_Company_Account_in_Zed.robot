*** Settings ***
Suite Setup       SuiteSetup
Suite Teardown    SuiteTeardown
Test Setup        TestSetup
Test Teardown     TestTeardown
Library           SeleniumLibrary



*** Test Cases ***
UJ:Managing_B2B_Copmany_Account_in_Zed_Part_1
    [Documentation]    This user journey is to check possibility to Create Company, Business unit and initial Admin user with Permissions for Managing User in Zed
    Zed: Login on Zed with Provided Credentials:    ${admin_email}  ${default_password}
    Zed: create new Company with provided name:    Robot+${random}
    Zed: click Action Button in a table for row that contains:    Robot+${random}    Approve
    Zed: click Action Button in a table for row that contains:    Robot+${random}    Activate
    Zed: create new Company Role with provided permissions:    Robot+${random}    Test Robot Role+${random}    false    Add company users    Invite users    Enable / Disable company users    See Company Menu    Add item to cart    Change item in cart    Remove item from cart    Place Order    Alter Cart Up To Amount
    Zed: create new Company Role with provided permissions:    Trial    Existing Role+${random}    false    Add company users    Invite users    Enable / Disable company users    See Company Menu    Add item to cart    Change item in cart    Remove item from cart    Place Order    Alter Cart Up To Amount
    Zed: create new Company Business Unit with provided name and company:    Test Robot BU+${random}    Robot+${random}
    Zed: Create new Company User with provided email/company/business unit and role(s):    ${test_customer_email}    Robot+${random}    Test Robot BU+${random}    (id: ${newly_created_business_unit_id})    Test Robot Role+${random}
    # Yves: Login on Yves with Provided Credentials:     ${test_customer_email}
    # Yves: company menu 'should' be available for logged in user   
    # Zed: click button in Header:  button_name

UJ:Managing_B2B_Copmany_Account_in_Zed_Part_1
    [Documentation]    This user journey is to check possibility to Create Company, Business unit and initial Admin user with Permissions for Managing User in Zed
    Given user with <email> and <password> is logged into Zed

