import AddressFormToggler from 'CustomerPage/components/molecules/address-form-toggler/address-form-toggler';

export default class AddressFormTogglerExtended extends AddressFormToggler {
    protected readyCallback(): void {
        super.readyCallback();
    }

    toggle(isShown: boolean): void {
        const hasCompanyBusinessUnitAddress = (this.hasCompanyBusinessUnitAddress === 'true');

        if (hasCompanyBusinessUnitAddress || !isShown) {
            this.form.classList.remove(this.classToToggle);

            return;
        }

        this.form.classList.add(this.classToToggle);
    }
}
