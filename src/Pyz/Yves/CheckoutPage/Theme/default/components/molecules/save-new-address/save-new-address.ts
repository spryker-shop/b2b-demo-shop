import Component from 'ShopUi/models/component';

const EVENT_ADD_NEW_ADDRESS = 'add-new-address';

export default class SaveNewAddress extends Component {
    customerShippingAddresses: HTMLFormElement;
    customerBillingAddresses: HTMLFormElement;
    saveNewAddressToggler: HTMLInputElement;
    sameAsShippingTogglerContainer: HTMLInputElement;
    sameAsShippingToggler: HTMLInputElement;
    addNewShippingAddress: HTMLButtonElement;
    addNewBillingAddress: HTMLButtonElement;

    newShippingAddressChecked: boolean = false;
    newBillingAddressChecked: boolean = false;
    readonly hideClass: string = 'is-hidden';

    protected readyCallback(): void {
        if (this.shippingAddressTogglerSelector && this.billingAddressTogglerSelector) {
            this.customerShippingAddresses = <HTMLFormElement>document.querySelector(this.shippingAddressTogglerSelector);
            this.customerBillingAddresses = <HTMLFormElement>document.querySelector(this.billingAddressTogglerSelector);
        }

        if (this.addNewShippingAddressSelector && this.addNewBillingAddressSelector) {
            this.addNewShippingAddress = <HTMLButtonElement>document.querySelector(this.addNewShippingAddressSelector);
            this.addNewBillingAddress = <HTMLButtonElement>document.querySelector(this.addNewBillingAddressSelector);
        }

        this.saveNewAddressToggler = <HTMLInputElement>document.querySelector(this.saveAddressTogglerSelector);
        this.sameAsShippingTogglerContainer = <HTMLInputElement>document.querySelector(this.billingSameAsShippingAddressTogglerSelector);
        this.sameAsShippingToggler = <HTMLInputElement>this.sameAsShippingTogglerContainer.querySelector(this.billingSameAsShippingAddressTogglerSelector);

        this.customerAddressesExists();
    }

    protected customerAddressesExists(): void {
        if (!this.customerShippingAddresses) {
            this.showSaveNewAddress();
            return;
        }

        this.mapEvents();
        this.initSaveNewAddressState();
    }

    protected mapEvents(): void {
        if (this.addNewShippingAddress && this.addNewBillingAddress) {
            this.addNewShippingAddress.addEventListener(EVENT_ADD_NEW_ADDRESS, () => this.shippingTogglerOnChange());
            this.addNewBillingAddress.addEventListener(EVENT_ADD_NEW_ADDRESS, () => this.billingTogglerOnChange());
        }

        this.customerShippingAddresses.addEventListener('change', () => this.shippingTogglerOnChange());
        this.customerBillingAddresses.addEventListener('change', () => this.billingTogglerOnChange());
        this.sameAsShippingToggler.addEventListener('change', () => this.toggleSaveNewAddress());
    }

    protected shippingTogglerOnChange(): void {
        this.newShippingAddressChecked = this.addressTogglerChange(this.customerShippingAddresses);
        this.toggleSaveNewAddress();
    }

    protected billingTogglerOnChange(): void {
        this.newBillingAddressChecked = this.addressTogglerChange(this.customerBillingAddresses);
        this.toggleSaveNewAddress();
    }

    protected initSaveNewAddressState(): void {
        this.newShippingAddressChecked = this.isSaveNewAddressOptionSelected(this.customerShippingAddresses);
        this.newBillingAddressChecked = this.isSaveNewAddressOptionSelected(this.customerBillingAddresses);
        this.toggleSaveNewAddress();
    }

    protected addressTogglerChange(toggler): boolean {
        return this.isSaveNewAddressOptionSelected(toggler);
    }

    protected isSaveNewAddressOptionSelected(toggler: HTMLFormElement): boolean {
        return !toggler.value;
    }

    toggleSaveNewAddress(): void {
        if (this.newShippingAddressChecked || (this.newBillingAddressChecked && !this.sameAsShippingChecked)) {
            this.showSaveNewAddress();
            return;
        }

        this.hideSaveNewAddress();
    }

    hideSaveNewAddress(): void {
        this.classList.add(this.hideClass);
        this.saveNewAddressToggler.disabled = true;
    }

    showSaveNewAddress(): void {
        this.classList.remove(this.hideClass);
        this.saveNewAddressToggler.disabled = false;
    }

    get sameAsShippingChecked(): boolean {
        return this.sameAsShippingToggler.checked;
    }

    get shippingAddressTogglerSelector(): string {
        return this.getAttribute('shipping-address-toggler-selector');
    }

    get billingAddressTogglerSelector(): string {
        return this.getAttribute('billing-address-toggler-selector');
    }

    get addNewShippingAddressSelector(): string {
        return this.getAttribute('add-new-shipping-address-selector');
    }

    get addNewBillingAddressSelector(): string {
        return this.getAttribute('add-new-billing-address-selector');
    }

    get billingSameAsShippingAddressTogglerSelector(): string {
        return this.getAttribute('billing-same-as-shipping-toggler-selector');
    }

    get saveAddressTogglerSelector(): string {
        return this.getAttribute('save-address-toggler-selector');
    }
}
