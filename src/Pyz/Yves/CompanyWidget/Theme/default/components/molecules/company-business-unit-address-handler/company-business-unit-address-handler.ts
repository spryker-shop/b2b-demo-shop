import Component from 'ShopUi/models/component';
import FormClear from 'ShopUi/components/molecules/form-clear/form-clear';

const EVENT_ADD_NEW_ADDRESS = 'add-new-address';

export default class CompanyBusinessUnitAddressHandler extends Component {
    triggers: HTMLElement[];
    form: HTMLFormElement;
    targets: HTMLElement[];
    ignoreElements: HTMLElement[];
    filterElements: HTMLElement[];
    formClear: FormClear;
    addressesDataObject: any;
    addressesSelects: HTMLSelectElement[];
    currentAddress: String;
    hiddenDefaultAddressInput: HTMLInputElement;
    customAddressTriggerInput: HTMLFormElement;
    resetSelectEvent: CustomEvent;
    addNewAddressEvent: CustomEvent;

    readonly resetSelectEventName: string = 'reset-select';

    protected readyCallback(): void {
        const formElements = 'select, input[type="text"], input[type="radio"], input[type="checkbox"]';

        this.form = <HTMLFormElement>document.querySelector(this.formSelector);
        this.triggers = <HTMLElement[]>Array.from(this.form.querySelectorAll(this.triggerSelector));
        this.addressesSelects = <HTMLSelectElement[]>Array.from(this.form.querySelectorAll(this.dataSelector));
        this.targets = <HTMLElement[]>Array.from(this.form.querySelectorAll(formElements));
        this.ignoreElements = <HTMLElement[]>Array.from(this.form.querySelectorAll(this.ignoreSelector));
        this.filterElements = this.targets.filter((element) => !this.ignoreElements.includes(element));
        this.formClear = <FormClear>this.form.querySelector('.js-form-clear');
        this.hiddenDefaultAddressInput = <HTMLInputElement>this.form.querySelector(this.defaultAddressSelector);
        this.customAddressTriggerInput = <HTMLFormElement>this.form.querySelector(this.customAddressTrigger);

        this.initAddressesData();
        this.mapEvents();
        this.fillDefaultAddress();
        this.initResetSelectEvent();
        this.initAddNewAddressSelector();
    }

    protected mapEvents(): void {
        this.formClear.addEventListener('form-fields-clear-after', () => {
            this.toggleFormFieldsReadonly(false);
            this.toggleReadonlyForCustomAddressTrigger();
            this.resetAddressesSelect();
        });

        this.triggers.forEach((triggerElement) => {
            triggerElement.addEventListener('click', () => {
                this.addressesSelects.forEach((selectElement) => {
                    this.setCurrentAddress(selectElement);
                });
                this.onClick(triggerElement);
                triggerElement.dispatchEvent(this.addNewAddressEvent);
            });
        });
    }

    protected initResetSelectEvent(): void {
        this.resetSelectEvent = new CustomEvent(this.resetSelectEventName);
        this.resetSelectEvent.initEvent('change', true, true);
    }

    protected initAddNewAddressSelector(): void {
        this.addNewAddressEvent = <CustomEvent>new CustomEvent(EVENT_ADD_NEW_ADDRESS);
    }

    protected onClick(triggerElement: HTMLElement): void {
        if (this.currentAddress) {
            this.fillFormWithNewAddress();
            this.toggleFormFieldsReadonly();
            this.toggleReadonlyForCustomAddressTrigger();
        }
    }

    toggleFormFieldsReadonly(isEnabled: boolean = true): void {
        this.filterElements.forEach((formElement: HTMLFormElement) => {
            this.toggleFormFieldReadOnly(formElement, isEnabled);
        });
    }

    toggleFormFieldReadOnly(formElement: HTMLFormElement, isEnabled: boolean = true): void {
        const isSelect = this.formClear.getTagName(formElement) == 'SELECT';

        if (isSelect) {
            const options = Array.from(formElement.querySelectorAll('option'));

            options.forEach((element) => {
                if (!element.selected) {
                    element.disabled = isEnabled;
                }
            });

            return;
        }

        formElement.readOnly = isEnabled;
    }

    protected setCurrentAddress(selectElement: HTMLSelectElement): void {
        this.currentAddress = selectElement.options[selectElement.selectedIndex].getAttribute('value');
    }

    protected fillFormWithNewAddress(): void {
        const currentAddressList = this.addressesDataObject[this.currentAddress.toString()];
        this.hiddenDefaultAddressInput.value = this.currentAddress.toString();

        this.clearFormFields();
        this.fillFormFields(currentAddressList);
        this.clearFormField(this.customAddressTriggerInput);
    }

    protected fillDefaultAddress(): void {
        const hiddenDefaultAddressInputName = this.hiddenDefaultAddressInput.getAttribute('value');
        if (hiddenDefaultAddressInputName) {
            this.currentAddress = hiddenDefaultAddressInputName;
            this.fillFormWithNewAddress();
            this.toggleFormFieldsReadonly();
        }
        this.toggleReadonlyForCustomAddressTrigger();
    }

    clearFormFields(): void {
        this.filterElements.forEach((element) => {
            this.clearFormField(<HTMLFormElement>element);
        });
    }

    clearFormField(element: HTMLFormElement): void {
        this.formClear.clearFormField(element);
    }

    fillFormFields(address: object): void {
        for (let key in address) {
            const formElement = this.form.querySelector(`[data-key="${key}"]`);

            if (formElement !== null) {
                (<HTMLFormElement>formElement).value = address[key];
            }
        }
    }

    protected resetAddressesSelect(): void {
        const event = new Event('change');
        const addressSelect = <HTMLSelectElement>this.form.querySelector(this.dataSelector);
        const addressSelectOptions = <HTMLOptionElement[]>Array.from(addressSelect.options);
        const addressHiddenInput = <HTMLInputElement>this.form.querySelector(`[name="${this.addressHiddenInputSelector}"]`);

        addressSelectOptions.some((item, index) => {
            if(!item.value.length) {
                addressSelect.selectedIndex = index;
                addressHiddenInput.dispatchEvent(this.resetSelectEvent);
                return true;
            }
        });
        addressSelect.dispatchEvent(event);
    }

    protected toggleReadonlyForCustomAddressTrigger() {
        if (this.customAddressTriggerInput.checked) {
            this.customAddressTriggerInput.disabled = true;
        } else {
            this.customAddressTriggerInput.disabled = false;
        }
    }

    protected initAddressesData(): void {
        const data = this.getAttribute('addresses');
        this.addressesDataObject = JSON.parse(data);
    }

    get formSelector(): string {
        return this.getAttribute('form-selector');
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get dataSelector(): string {
        return this.getAttribute('data-selector');
    }

    get ignoreSelector(): string {
        return this.getAttribute('ignore-selector');
    }

    get defaultAddressSelector(): string {
        return this.getAttribute('default-address-selector');
    }

    get addressHiddenInputSelector(): string {
        return this.getAttribute('address-hidden-input-selector');
    }

    get customAddressTrigger(): string {
        return this.getAttribute('custom-address-trigger');
    }
}
