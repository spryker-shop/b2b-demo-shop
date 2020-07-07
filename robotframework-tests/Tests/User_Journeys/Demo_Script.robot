*** Settings ***
Suite Setup       SuiteSetup
Suite Teardown    SuiteTeardown
Test Setup        TestSetup
Test Teardown     TestTeardown
Resource    ../../Resources/Common/Common.robot
Resource    ../../Resources/Steps/Header_steps.robot
Resource    ../../Resources/Common/Common_Yves.robot
Resource    ../../Resources/Common/Common_Zed.robot
Resource    ../../Resources/Steps/PDP_steps.robot
Resource    ../../Resources/Steps/Shopping_Lists_steps.robot
Resource    ../../Resources/Steps/Checkout_steps.robot
Resource    ../../Resources/Steps/Order_History_steps.robot
Resource    ../../Resources/Steps/Product_Set_steps.robot
Resource    ../../Resources/Steps/Catalog_steps.robot
Resource    ../../Resources/Steps/Agent_Assist_steps.robot
Resource    ../../Resources/Steps/Company_steps.robot

*** Test Cases ***
# Guest_User_Restrictions
#     [Documentation]    Checks that guest users are not able to see: Prices, Availability, Quick Order, "My Account" features
#     Yves: header contains/doesn't contain:    false    ${priceModeSwitcher}    ${currencySwitcher}    ${quickOrderIcon}    ${accountIcon}    ${shoppingListIcon}    ${shoppingCartIcon}
#     Yves: go to PDP of the product with sku:    M70208 
#     Yves: PDP contains/doesn't contain:     false    ${price}    ${addToCartButton}
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: header contains/doesn't contain:    true    ${priceModeSwitcher}    ${currencySwitcher}    ${quickOrderIcon}    ${accountIcon}    ${shoppingListIcon}    ${shoppingCartIcon}
#     Yves: company menu 'should' be available for logged in user   
#     Yves: go to PDP of the product with sku:    M70208 
#     Yves: PDP contains/doesn't contain:     true    ${price}    ${addToCartButton}
#     Yves: go to company menu item:    Users
#     Yves: 'Company Users' page is displayed

# Share_Shopping_Lists
    # Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: 'Shopping List' widget contains:    Newcomers    Full access
#     Yves: go to 'Shopping Lists' page through the header
#     Yves: 'Shopping Lists' page is displayed
#     Yves: create new 'Shopping List' with name:    shoppingListName+${random}
#     Yves: the following shopping list is shown:    shoppingListName+${random}    Sonia Wagner    Full access
#     Yves: share shopping list with user:    shoppingListName+${random}    Karl Schmid    Full access
#     Yves: login on Yves with provided credentials:    karl@spryker.com
#     Yves: 'Shopping List' widget contains:    shoppingListName+${random}    Full access
#     Yves: go to 'Shopping Lists' page through the header
#     Yves: 'Shopping Lists' page is displayed 
#     Yves: the following shopping list is shown:    shoppingListName+${random}    Sonia Wagner    Full access

# Share_Shopping_Carts
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     # Yves: 'Shopping Carts' widget contains:    Dmexco event    Owner access
#     Yves: go to 'Shopping Carts' page through the header
#     Yves: 'Shopping Carts' page is displayed
#     Yves: create new 'Shopping Cart' with name:    shoppingCartName+${random}
#     Yves: 'Shopping Carts' widget contains:    shoppingCartName+${random}    Owner access
#     Yves: go to 'Shopping Carts' page through the header
#     Yves: 'Shopping Carts' page is displayed
#     Yves: the following shopping cart is shown:    shoppingCartName+${random}    Owner access
#     Yves: share shopping cart with user:    shoppingCartName+${random}    Meier Trever    Full access
#     Yves: go to PDP of the product with sku:    M10569
#     Yves: add product to the shopping cart
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: 'Shopping Carts' widget contains:    shoppingCartName+${random}    Full access
#     Yves: go to 'Shopping Carts' page through the header
#     Yves: 'Shopping Carts' page is displayed
#     Yves: the following shopping cart is shown:    shoppingCartName+${random}    Full access
#     Yves: go to the shopping cart through the header with name:    shoppingCartName+${random}
#     Yves: 'Shopping Cart' page is displayed
#     Yves: shopping cart contains the following products:    100414
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:    Mr Trever Meier, Kirncher Str. 7, 10247 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed
#     Yves: go to the 'Home' page
#     Yves: go to user menu item in header:    Order History
#     Yves: 'Order History' page is displayed
    # Yves: get the last placed order ID by current customer
#     Yves: 'View Order/ Reorder' on the order history page:     View Order    ${lastPlacedOrder}
#     Yves: 'View Order' page is displayed


# Quick_Order
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: create new 'Shopping Cart' with name:    quickOrderCart+${random}
#     Yves: create new 'Shopping List' with name:    quickOrderList+${random}
#     Yves: go to 'Quick Order' page through the header
#     Yves: 'Quick Order' page is displayed
#     Yves: add the following articles into the form through quick order text area:    401627,1\n520561,21\n101509,21\n419871,51\n419869,11\n425073,71\n425084,2 
#     Yves: add products to the shopping cart from quick order page
#     Yves: go to the shopping cart through the header with name:    quickOrderCart+${random}
#     Yves: 'Shopping Cart' page is displayed
#     Yves: shopping cart contains the following products:    401627    520561    101509    419871    419869    425073    425084
#     Yves: go to 'Quick Order' page through the header
#     Yves: add the following articles into the form through quick order text area:    401627,11\n520561,21\n101509,21\n419871,51\n419869,11\n425073,71\n425084,2 
#     Yves: add products to the shopping list from quick order page with name:    quickOrderList+${random}
#     Yves: 'Shopping List' page is displayed
#     Yves: shopping list contains the following products:    401627    520561    101509    419871    419869    425073    425084
#     Yves: go to the shopping cart through the header with name:    quickOrderCart+${random}
#     ### Order placement ###
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:    Ms Sonia Wagner, Kirncher Str. 7, 10247 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed
#     ### Order History ###
#     Yves: go to the 'Home' page
#     Yves: go to user menu item in header:    Order History
#     Yves: 'Order History' page is displayed
#     Yves: get the last placed order ID by current customer
#     Yves: 'View Order/ Reorder' on the order history page:     View Order    ${lastPlacedOrder}
#     Yves: 'View Order' page is displayed
#     ### Reorder ###
#     Yves: reorder all items from 'View Order' page
#     Yves: go to the shopping cart through the header with name:    Cart from order ${lastPlacedOrder}
#     Yves: 'Shopping Cart' page is displayed
#     Yves: shopping cart contains the following products:    401627    520561    101509    419871    419869    425073    425084

# Volume_Prices
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: create new 'Shopping Cart' with name:    VolumePriceCart+${random}
#     Yves: go to PDP of the product with sku:    M21189  
#     Yves: change quantity on PDP:    5
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    VolumePriceCart+${random}
#     Yves: shopping cart contains product with unit price:    420685    €4.20

# Alternative_Products
#     Yves: go to PDP of the product with sku:  M21100
#     Yves: PDP contains/doesn't contain:    true    ${alternativeProducts}

# Measurement_Units
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: create new 'Shopping Cart' with name:    measurementUnitsCart+${random}
#     Yves: go to PDP of the product with sku:    M23723 
#     Yves: select the following 'Sales Unit' on PDP:    Meter
#     Yves: change quantity using '+' or '-' button № times:    +    1
#     Yves: PDP contains/doesn't contain:    true    ${measurementUnitSuggestion}
#     Yves: change quantity using '+' or '-' button № times:    -    1
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:  measurementUnitsCart+${random}
#     Yves: 'Shopping Cart' page is displayed
#     Yves: shopping cart contains the following products:    425079

# Packaging_Units
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: create new 'Shopping Cart' with name:    packagingUnitsCart+${random}
#     Yves: go to PDP of the product with sku:    M21766 
#     Yves: change variant of the product on PDP on:    Box
#     Yves: change amount on PDP:    51
#     Yves: PDP contains/doesn't contain:    true    ${packagingUnitSuggestion}
#     Yves: change amount on PDP:    10
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    packagingUnitsCart+${random}
#     Yves: shopping cart contains the following products:    421519_3

# Product_Sets
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: create new 'Shopping Cart' with name:    productSetsCart+${random}
#     Yves: go to URL:    en/product-sets
#     Yves: 'Product Sets' page contains the following sets:    The Presenter's Set    Basic office supplies    The ultimate data disposal set
#     Yves: view the following Product Set:    Basic office supplies
#     Yves: 'Product Set' page contains the following products:    Clairefontaine Collegeblock 8272C DIN A5, 90 sheets
#     Yves: change variant of the product on CMS page on:    Clairefontaine Collegeblock 8272C DIN A5, 90 sheets    lined
#     Yves: add all products to the shopping cart from Product Set
#     Yves: shopping cart contains the following products:    421344    420687    421511    423452

# Product_Bundles
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: create new 'Shopping Cart' with name:    productBundleCart+${random}
#     Yves: go to PDP of the product with sku:    000201
#     Yves: PDP contains/doesn't contain:    true    ${bundleItemsSmall}    ${bundleItemsLarge}
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    productBundleCart+${random}
#     Yves: shopping cart contains the following products:    000201

# Product_Relations
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: create new 'Shopping Cart' with name:    productRelationCart+${random}
#     Yves: go to PDP of the product with sku:    M29529
#     Yves: PDP contains/doesn't contain:    true    ${relatedProducts}
#     Yves: go to PDP of the product with sku:    M29524
#     Yves: PDP contains/doesn't contain:    false    ${relatedProducts}
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    productRelationCart+${random}
#     Yves: shopping cart contains/doesn't contain the following elements:    true    ${upSellProducts}

# Default_Merchants
#     Zed: login on Zed with provided credentials:    admin@spryker.com
#     Zed: go to second navigation item level:    Merchants    Merchants
#     Zed: table should contain:    Restrictions Merchant
#     Zed: table should contain:    Prices Merchant
#     Zed: table should contain:    Products Restrictions Merchant

# Product_Restrictions
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: perform search by:    Soennecken
#     Yves: 'Catalog' page should show products:    18
#     Yves: go to URL:    en/office-furniture/storage/lockers
#     Yves: 'Catalog' page should show products:    34
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    frida@ottom.de
#     Yves: perform search by:    Soennecken
#     Yves: 'Catalog' page should show products:    0
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    alexa@ottom.de
#     Yves: go to URL:    en/office-furniture/storage/lockers
#     Yves: 'Catalog' page should show products:    0
#     Yves: go to URL:    en/transport/lift-carts
#     Yves: 'Catalog' page should show products:    16
#     Yves: go to URL:    en/transport/sack-trucks
#    Yves: 'Catalog' page should show products:    10

# Customer_Specific_Prices
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: perform search by:    EUROKRAFT trolley - with open shovel
#     Yves: product with name in the catalog should have price:    EUROKRAFT trolley - with open shovel    €235.43
#     Yves: go to PDP of the product with sku:    M70208
#     Yves: product price on the PDP should be:    €235.43
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    karl@spryker.com
#     Yves: perform search by:    EUROKRAFT trolley - with open shovel
#     Yves: product with name in the catalog should have price:    EUROKRAFT trolley - with open shovel    €188.34
#     Yves: go to PDP of the product with sku:    M70208
#     Yves: product price on the PDP should be:    €188.34

# Agent_Assist
#     Zed: login on Zed with provided credentials:    admin@spryker.com
#     Zed: create new Zed user with the following data:    agent@spryker.com+${random}    change123    Agent    Assist    Root group    This user is an agent    en_US
#     Yves: go to the 'Home' page   
#     Yves: go to URL:    agent/login
#     Yves: login on Yves with provided credentials:    agent@spryker.com+${random}
#     Yves: header contains/doesn't contain:    true    ${customerSearchWidget}
#     Yves: perform search by customer:    Karl
#     Yves: agent widget contains:    karl@spryker.com
#     Yves: login under the customer:    karl@spryker.com
#     Yves: perform search by:    EUROKRAFT trolley - with open shovel
#     Yves: product with name in the catalog should have price:    EUROKRAFT trolley - with open shovel    €188.34
#     Yves: go to PDP of the product with sku:    M70208
#     Yves: product price on the PDP should be:    €188.34

# Business_on_Behalf
#     Zed: login on Zed with provided credentials:    admin@spryker.com
#     Zed: go to second navigation item level:    Company Account    Company Users
#     Zed: click Action Button in a table for row that contains:    Trever    Attach to BU
#     Zed: attach company user to the following BU with role:    Spryker Systems Berlin (id: 28)    Admin
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: go to URL:    en/company/user/select
#     Yves: 'Select Business Unit' page is displayed
#     Yves: 'Business Unit' dropdown contains:    Spryker Systems GmbH / Spryker Systems HR department    Spryker Systems GmbH / Spryker Systems Berlin

# Business_Unit_Address_on_Checkout
#     Yves: login on Yves with provided credentials:    Trever.m@spryker.com
#     Yves: create new 'Shopping Cart' with name:    businessAddressCart+${random}
#     Yves: go to PDP of the product with sku:    M64933
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    businessAddressCart+${random}
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:    Mr Trever Meier, Kirncher Str. 7, 10247 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed
#     Yves: go to user menu item in header:    Order History
#     Yves: 'Order History' page is displayed
#     Yves: get the last placed order ID by current customer
#     Yves: 'View Order/ Reorder' on the order history page:    View Order    ${lastPlacedOrder} 
#     Yves: 'Order Details' page is displayed
#     Yves: shipping address on the order details page is:    Mr. Trever Meier Spryker Systems GmbH Kirncher Str. 7 10247 Berlin, Germany 4902890031

# Approval_Process
#     Yves: login on Yves with provided credentials:    kevin@spryker.com
#     Yves: create new 'Shopping Cart' with name:    approvalCart
#     Yves: go to PDP of the product with sku:    M49320
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    approvalCart
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:            Mr Kevin Sidorov, Oderberger Str. 57, 10115 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: select approver on the 'Summary' page:    Emma Schmidt (€1,000.00)
#     Yves: 'send the request' on the summary page
#     Yves: 'Summary' page is displayed
#     Yves: 'Summary' page contains:    cancelRequest    listAlert    statusWaiting
#     Yves: go to the shopping cart through the header with name:    approvalCart
#     Yves: shopping cart contains/doesn't contain the following elements:    lockedCart
#     Yves: create new shopping cart with name:    newApprovalCart
#     Yves: go to PDP of the product with sku:    M58314
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    newApprovalCart
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:            Mr Kevin Sidorov, Oderberger Str. 57, 10115 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed
#     Yves: create new shopping cart with name:    anotherApprovalCart
#     Yves: go to PDP of the product with sku:    M58314
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    anotherApprovalCart
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:            Mr Kevin Sidorov, Oderberger Str. 57, 10115 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: select approver on the 'Summary' page:    Emma Schmidt (€1,000.00)
#     Yves: 'send the request' on the summary page
#     Yves: 'Summary' page is displayed
#     Yves: 'Summary' page contains:    cancelRequest    listAlert    statusWaiting
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    emma@spryker.com
#     Yves: go to user menu item in header:    Overview
#     Yves: 'Overview' page is displayed
#     Yves: go to user menu item in the left bar:    Shopping Carts
#     Yves: 'Shopping Carts' page is displayed
#     Yves: the following shopping carts are shown:    approvalCart    anotherApprovalCart
#     Yves: shopping cart with name xxx has the following status:    approvalCart    status
#     Yves: go to the shopping cart through the header with name:    approvalCart
#     Yves: click on the 'Checkout' button
#     Yves: 'Summary' page is displayed
#     Yves: 'approve the cart' on the summary page
#     Yves: 'Summary' page is displayed
#     Yves: 'Summary' page contains:    cancelRequest    listAlert    statusApproved
#     Yves: go to user menu item in header:    Overview
#     Yves: 'Overview' page is displayed
#     Yves: go to user menu item in the left bar:    Shopping Carts
#     Yves: 'Shopping Carts' page is displayed
#     Yves: the following shopping carts are shown:    approvalCart    anotherApprovalCart
#     Yves: shopping cart with name xxx has the following status:    approvalCart    status
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    kevin@spryker.com
#     Yves: go to the shopping cart through the header with name:    approvalCart
#     Yves: 'Summary' page is displayed
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed

# Request_for_Quote
#     Yves: go to URL:    /agent/login
#     Yves: login on Yves with provided credentials:    agent@spryker.com
#     Yves: header 'should' contain:    quoteRequestsWidget
#     Yves: go to 'Quote Requests' page through the header
#     Yves: 'Quote Requests' page is displayed
#     Yves: quote request with reference xxx should have status:    DE--21-5    Waiting
#     Yves: view quote request with reference:    DE--21-5
#     Yves: 'Quote Request Details' page is displayed
#     Yves: click 'Revise' button on the 'Quote Request Details' page 
#     Yves: change price for the product in the quote request with sku xxx on:    424605    5
#     Yves: click 'Send to Customer' button on the 'Quote Request Details' page 
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: go to user menu item in header:    Quote Requests
#     Yves: quote request with reference xxx should have status:    DE--21-5    Ready
#     Yves: view quote request with reference:    DE--21-5
#     Yves: click 'Revise' button on the 'Quote Request Details' page
#     Yves: click 'Edit Items' button on the 'Quote Request Details' page
#     Yves: delete product from the shopping cart with sku:    212427
#     Yves: click 'Save and Back to Edit' button on the 'Quote Request Details' page
#     Yves: add the following note to the quote request:    Spryker rocks
#     Yves: click 'Save' button on the 'Quote Request Details' page
#     Yves: click 'Send to Agent' button on the 'Quote Request Details' page
#     Yves: move mouse over header menu item:     quoteRequestsWidget
#     Yves: 'Quote Requests' widget is shown
#     Yves: go to the quote request through the header with reference:    DE--21-5
#     Yves: 'Quote Request Details' page contains the following note:   Spryker rocks
#     Yves: set 'Valid Till' date for the quote request, today:    +1
#     Yves: change price for the product in the quote request with sku xxx on:    424605    5
#     Yves: click 'Send to Customer' button on the 'Quote Request Details' page
#     Yves: logout on Yves as a customer
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: go to user menu item in header:    Quote Requests
#     Yves: quote request with reference xxx should have status:    DE--21-5    Ready
#     Yves: view quote request with reference:    DE--21-5
#     Yves: click 'Convert to Cart' button on the 'Quote Request Details' page
#     Yves: 'Shopping Carts' page is displayed
#     Yves: shopping cart contains product with unit price:    424605    5
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:    Ms Sonia Wagner, Kirncher Str. 7, 10247 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: shopping cart contains product with unit price:    424605    5
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed

# Unique_URL
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: create new 'Shopping Cart' with name:    externalCart
#     Yves: go to PDP of the product with sku:    M90806
#     Yves: add product to the shopping cart
#     Yves: go to the shopping cart through the header with name:    externalCart
#     Yves: 'Shopping Cart' page is displayed
#     Yves: copy link for external cart sharing
#     Yves: logout on Yves as a customer
#     Yves: go to URL:    externalCartLink
#     Yves: 'Preview Shopping Cart' page is displayed 
#     Yves: shopping cart contains the following products:    108302

# Configurable_Bundle
#     Yves: login on Yves with provided credentials:    sonia@spryker.com
#     Yves: create new 'Shopping Cart' with name:    confBundle
#     Yves: go to level 1 in the 'Main Navigation':    More    Configurable Bundle
#     Yves: 'Choose Bundle to configure' page is displayed
#     Yves: choose bundle to configure:    Presentation bundle
#     Yves: select product in the bundle slot:    Slot 5    408104
#     Yves: select product in the bundle slot:    Slot 6    423172
#     Yves: go to 'Summary' step in the bundle configurator
#     Yves: app products to the shopping cart in the bundle configurator
#     Yves: go to the shopping cart through the header with name:    confBundle
#     Yves: change quantity of the configurable bundle in the shopping cart on:    Presentation bundle    2
#     Yves: click on the 'Checkout' button
#     Yves: billing address same as shipping address:    true
#     Yves: select the following existing address on the checkout as 'shipping' address and go next:    Ms Sonia Wagner, Kirncher Str. 7, 10247 Berlin
#     Yves: select the following shipping method on the checkout and go next:    Express
#     Yves: select the following payment method on the checkout and go next:    Invoice
#     Yves: 'submit the order' on the summary page
#     Yves: 'Thank you' page is displayed
#     Yves: go to user menu item in header:    Order History
#     Yves: 'Order History' page is displayed
#     Yves: 'view order' on the order history with ID:    orderID
#     Yves: 'View Order' page is displayed
#     Yves: 'Order Details' page contains the following configurable bundle N times:    Presentation bundle    2


    

    















    






    



