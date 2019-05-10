import CustomerPageSaveNewAddress from 'CustomerPage/components/molecules/save-new-address/save-new-address';

export default class SaveNewAddress extends CustomerPageSaveNewAddress {
    protected readyCallback(): void {
        super.readyCallback()
    }

    protected initSaveNewAddressState(): void {
        document.addEventListener('addresses-fields-filled', () => {
            this.newShippingAddressChecked = this.isSaveNewAddressOptionSelected(this.customerShippingAddresses);
            this.newBillingAddressChecked = this.isSaveNewAddressOptionSelected(this.customerBillingAddresses);
            this.toggleSaveNewAddress();
        })
    }
}
