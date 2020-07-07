*** Variables ***
${order_details_main_content_locator}    xpath=//customer-reorder-form[@data-qa='component customer-reorder-form']
${order_details_reorder_all_button}    xpath=//customer-reorder-form[@data-qa='component customer-reorder-form']//a[contains(.,'Reorder all')]
${order_details_reorder_selected_items_button}    xpath=//customer-reorder-form[@data-qa='component customer-reorder-form']//button[contains(.,'Reorder selected items')]
${order_details_shipping_address_locator}    xpath=//div[@class='summary-sidebar__item']//ul[@data-qa='component display-address']