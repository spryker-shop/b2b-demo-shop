import SaveNewAddress from 'CustomerPage/components/molecules/save-new-address/save-new-address';
import CustomCompanyBusinessUnitAddressHandler from 'src/CompanyWidget/components/molecules/custom-company-business-unit-address-handler/custom-company-business-unit-address-handler';

export default class CustomerPageSaveNewAddress extends SaveNewAddress {
    trigger: CustomCompanyBusinessUnitAddressHandler;

    protected readyCallback(): void {
        this.trigger = <CustomCompanyBusinessUnitAddressHandler>document.querySelector(
            'custom-company-business-unit-address-handler'
        );
        super.readyCallback();
    }

    protected initSaveNewAddressState(): void {
        this.trigger.addEventListener('addresses-fields-filled', () => {
            this.newShippingAddressChecked = this.isSaveNewAddressOptionSelected(this.customerShippingAddresses);
            this.newBillingAddressChecked = this.isSaveNewAddressOptionSelected(this.customerBillingAddresses);
            this.toggleSaveNewAddress();
        });
    }
}
