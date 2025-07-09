import AddressFormTogglerCore from 'CustomerPage/components/molecules/address-form-toggler/address-form-toggler';

export default class AddressFormToggler extends AddressFormTogglerCore {
    protected elementsToToggle: HTMLElement[];

    protected init(): void {
        if (this.elementsToToggleSelector) {
            this.elementsToToggle = document.querySelectorAll<HTMLElement[]>(this.elementsToToggleSelector);
        }

        super.init();
    }

    protected toggleSubForm(): void {
        super.toggleSubForm();

        if (this.subForm) {
            this.elementsToToggle?.forEach((element) => element.classList.add(this.classToToggle));
        }
    }

    protected toggleForm(isShown: boolean): void {
        super.toggleForm(isShown);

        if (this.subForm) {
            this.elementsToToggle?.forEach((element) => element.classList.remove(this.classToToggle));
        }
    }

    protected get elementsToToggleSelector(): string {
        return this.getAttribute('elements-to-toggle');
    }
}
