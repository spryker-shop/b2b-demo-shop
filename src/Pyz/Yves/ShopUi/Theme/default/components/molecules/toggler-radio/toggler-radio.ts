import TogglerCheckbox from 'ShopUi/components/molecules/toggler-checkbox/toggler-checkbox';

export default class TogglerRadio extends TogglerCheckbox {
    // eslint-disable-next-line no-use-before-define
    protected togglers: TogglerRadio[];

    protected init(): void {
        this.togglers = <TogglerRadio[]>(
            Array.from(document.querySelectorAll(`${this.name}[group-name="${this.groupName}"]`))
        );
        super.init();
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();
        this.toggleAll();
    }

    toggleAll(): void {
        this.togglers.forEach((toggler: TogglerRadio) => {
            toggler.toggle(toggler.addClass);
        });
    }

    protected get groupName(): string {
        return this.getAttribute('group-name');
    }
}
