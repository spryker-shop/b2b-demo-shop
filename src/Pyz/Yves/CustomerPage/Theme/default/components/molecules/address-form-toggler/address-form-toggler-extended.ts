import AddressFormToggler from 'CustomerPage/components/molecules/address-form-toggler/address-form-toggler';

export default class AddressFormTogglerExtended extends AddressFormToggler {
    toggle(isShown: boolean): void {
        const hasCompanyBusinessUnitAddress = <boolean>(this.hasCompanyBusinessUnitAddress === 'true');

        if (hasCompanyBusinessUnitAddress || !isShown) {
            this.form.classList.remove(this.classToToggle);

            return;
        }

        this.form.classList.add(this.classToToggle);
    }
}
