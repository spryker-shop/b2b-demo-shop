import CompanyBusinessUnitAddressHandler from 'CompanyWidget/components/molecules/company-business-unit-address-handler/company-business-unit-address-handler';

export default class CustomCompanyBusinessUnitAddressHandler extends CompanyBusinessUnitAddressHandler {
    protected readyCallback(): void {
        super.readyCallback();
    }

    protected resetAddressesSelect(): void {
        const event = new Event('change');
        const addressSelect = <HTMLSelectElement>this.form.querySelector(this.dataSelector);
        const addressSelectOptions = <HTMLOptionElement[]>Array.from(addressSelect.options);
        const addressHiddenInput = <HTMLInputElement>this.form.querySelector(
            `[name="${this.addressHiddenInputSelector}"]`
        );

        addressSelectOptions.some((item, index) => {
            if (!item.value.length) {
                addressSelect.selectedIndex = index;
                addressHiddenInput.dispatchEvent(this.resetSelectEvent);

                return true;
            }
        });
        addressSelect.dispatchEvent(event);
    }

    fillFormFields(address: object): void {
        for (const key in address) {
            if (address.hasOwnProperty(key)) {
                const formElement = this.form.querySelector(`[data-key="${key}"]`);

                if (formElement !== null) {
                    (<HTMLFormElement>formElement).value = address[key];
                }

                if (formElement !== null && formElement.nodeName === 'SELECT') {
                    const event = new Event('change');
                    formElement.dispatchEvent(event);
                }
            }
        }
    }
}
