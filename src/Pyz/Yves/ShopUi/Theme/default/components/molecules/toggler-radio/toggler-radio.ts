import TogglerCheckbox from '../toggler-checkbox/toggler-checkbox';

export default class TogglerRadio extends TogglerCheckbox {
    togglers: TogglerRadio[]

    protected readyCallback(): void {
        this.togglers = <TogglerRadio[]>Array.from(document.querySelectorAll(`${this.name}[group-name="${this.groupName}"]`));
        super.readyCallback();
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

    get groupName(): string {
        return this.getAttribute('group-name');
    }
}
