import Component from 'ShopUi/models/component';

export default class OrderedConfiguredBundle extends Component {
    protected triggers: HTMLInputElement[];
    protected targets: HTMLInputElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLInputElement[]>Array.from(this.getElementsByClassName(this.triggerClassName));
        this.targets = <HTMLInputElement[]>Array.from(this.getElementsByClassName(this.targetClassName));

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLInputElement) => {
            trigger.addEventListener('change', (event: Event) => this.onTriggerChange(event));
        });

        this.targets.forEach((trigger: HTMLInputElement) => {
            trigger.addEventListener('change', (event: Event) => this.onTargetChange(event));
        });
    }

    protected onTriggerChange(event: Event): void {
        const trigger = <HTMLInputElement>event.target;
        const isChecked = <boolean>trigger.checked;

        this.targets.forEach((input: HTMLInputElement) => {
            input.checked = isChecked;
        });
    }

    protected onTargetChange(): void {
        const isChecked = this.isChecked();

        this.selectTrigger(isChecked);
    }

    protected isChecked(): boolean {
        return !this.targets.some(input => !input.checked);
    }

    protected selectTrigger(isChecked: boolean): void {
        this.triggers.forEach((trigger: HTMLInputElement) => {
            trigger.checked = isChecked;
        });
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get targetClassName(): string {
        return this.getAttribute('target-class-name');
    }
}
