import Component from 'ShopUi/models/component';

export default class BundleCheckbox extends Component {
    protected triggers: HTMLElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLInputElement) => {
            trigger.getElementsByTagName('input')[0]
                .addEventListener('change', (event: Event) => this.onTriggerChange(event));
        });
    }

    protected onTriggerChange(event: Event): void {
        const target = <HTMLInputElement>event.target;
        this.toggle(target);
    }

    protected toggle(checkbox: HTMLInputElement): void {
        const status = <boolean>checkbox.checked;
        const parent = <HTMLElement>checkbox.closest(`.${this.parentClassName}`);
        const inputs = <HTMLElement[]>Array.from(parent.getElementsByClassName(this.targetClassName));

        inputs.forEach((target: HTMLInputElement) => {
            target.checked = status;
        });
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get targetClassName(): string {
        return this.getAttribute('target-class-name');
    }

    protected get parentClassName(): string {
        return this.getAttribute('parent-class-name');
    }
}
