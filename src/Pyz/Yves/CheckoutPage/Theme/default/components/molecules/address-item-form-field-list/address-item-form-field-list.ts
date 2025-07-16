import Component from 'ShopUi/models/component';

interface ControlState {
    valid: boolean;
    main: {
        checked?: boolean;
        value?: string;
    };
    items: {
        item: HTMLElement;
        value: string;
    }[];
}

export default class AddressItemFormFieldList extends Component {
    protected excludeValidation: boolean = null;
    protected controls: Record<string, ControlState> = {};
    protected DEFAULT_VALUE = '0';

    protected sameAddressForAllItemsControl: HTMLElement[];
    protected elementsToToggle: HTMLElement[];

    protected observer = new MutationObserver(this.onInputChangeCallback.bind(this));

    protected readyCallback(): void {}
    protected init(): void {
        if (document.querySelector(`[address-item-form-drop-validation]`)) {
            this.excludeValidation = true;
        }

        this.sameAddressForAllItemsControl = Array.from(
            this.querySelectorAll<HTMLElement>(`.${this.getAttribute('same-address-for-all-items-control')} input`),
        );
        this.elementsToToggle = Array.from(
            document.querySelectorAll<HTMLElement>(`.${this.getAttribute('elements-to-toggle-class')}`),
        );

        for (const element of Array.from(this.querySelectorAll<HTMLElement>(`.${this.getAttribute('product-item')}`))) {
            const excludedTypes: string[] = JSON.parse(this.getAttribute('excluded-types') || '[]');
            const currentShipmentType = element.getAttribute('shipment-type');

            if (excludedTypes.includes(currentShipmentType)) {
                this.excludeValidation = true;
                break;
            }
        }

        this.mapEvents();
    }

    disconnectedCallback() {
        this.observer.disconnect();
    }

    protected mapEvents(): void {
        this.sameAddressForAllItemsControl.forEach((control: HTMLInputElement) => {
            const wrapper = control.closest<HTMLElement>(`.${this.getAttribute('product-item')}`);
            const groupIndex = wrapper.getAttribute('group-index');
            const controlClass = wrapper.getAttribute('address-control');
            const main = {
                checked: control.checked,
                value: this.DEFAULT_VALUE,
            };

            this.controls[groupIndex] = {
                valid: false,
                main: {},
                items: Array.from(
                    this.querySelectorAll<HTMLElement>(
                        `.${this.getAttribute('product-item')}[group-index="${groupIndex}"]`,
                    ),
                ).map((item) => {
                    const value = item.querySelector<HTMLInputElement>(`.${controlClass}`).value;

                    if (item.querySelector(`.${this.getAttribute('same-address-for-all-items-control')}`)) {
                        main.value = value;
                    }

                    return {
                        item,
                        value,
                    };
                }),
            };
            this.controls[groupIndex].main = main;

            control?.addEventListener('change', (event) => {
                this.controls[groupIndex].main.checked = (event.target as HTMLInputElement).checked;
                this.validation();
            });
        });

        Object.values(this.controls).forEach((data) => {
            data.items.forEach(({ item }) => {
                const input = item.querySelector<HTMLInputElement>(`.${item.getAttribute('address-control')}`);
                this.observer.observe(input, { attributes: true, attributeFilter: ['value'] });
            });
        });

        this.validation();
    }

    protected onInputChangeCallback(event: MutationRecord[]): void {
        const target = event[0].target as HTMLInputElement;
        const element = target.closest<HTMLElement>(`.${this.getAttribute('product-item')}`);
        const groupIndex = element.getAttribute('group-index');
        const value = (event[0].target as HTMLInputElement).value;

        this.controls[groupIndex].items.find((child) => child.item === element).value = value;

        if (element.querySelector(`.${this.getAttribute('same-address-for-all-items-control')}`)) {
            this.controls[groupIndex].main.value = value;
        }

        this.validation();
    }

    protected validation(): void {
        const isValid = this.isValid();

        this.elementsToToggle.forEach((element) => {
            element.classList.toggle('is-hidden', !isValid);

            const input = element.querySelector<HTMLInputElement>('input');

            if (!isValid && input) {
                input.checked = false;
                input.value = null;
            }
        });
    }

    protected isValid(): boolean {
        const valuesToCompare: string[] = [];

        if (this.excludeValidation) {
            return false;
        }

        for (const key in this.controls) {
            const control = this.controls[key];
            let valueToUse: string;

            if (control.main.checked) {
                valueToUse = control.main.value;
            } else {
                const firstItemValue = control.items[0]?.value;

                if (!firstItemValue || control.items.some((i) => i.value !== firstItemValue)) {
                    return false;
                }

                valueToUse = firstItemValue;
            }

            if (valueToUse === this.DEFAULT_VALUE || !valueToUse) {
                return false;
            }

            valuesToCompare.push(valueToUse);
        }

        return valuesToCompare.every((val) => val === valuesToCompare[0]);
    }
}
