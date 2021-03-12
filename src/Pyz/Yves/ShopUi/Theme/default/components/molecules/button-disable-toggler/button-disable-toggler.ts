import Component from 'ShopUi/models/component';

type TTriggerElement = HTMLTextAreaElement | HTMLInputElement;

export default class ButtonDisableToggler extends Component {
    protected triggers: TTriggerElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <TTriggerElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: TTriggerElement) => {
            trigger.addEventListener('input', (event: Event) => this.toggleButtonVisibility(event));
        });
    }

    protected toggleButtonVisibility(event: Event): void {
        const trigger = <TTriggerElement>event.currentTarget;
        const targetClass = trigger.getAttribute('target-button-class-name');
        const target = <HTMLButtonElement>document.getElementsByClassName(targetClass)[0];

        this.toggleStatus(trigger, target, this.hasEnoughSymbols(trigger));
    }

    protected toggleStatus(textarea: TTriggerElement, button: HTMLButtonElement, force: boolean): void {
        textarea.classList.toggle(this.activeClass, force);
        button.disabled = !force;
    }

    protected hasEnoughSymbols(textarea: TTriggerElement): boolean {
        const filteredValueLength = textarea.value.trim().length;

        return filteredValueLength >= this.minSymbols;
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-form-class-name');
    }

    protected get minSymbols(): number {
        return Number(this.getAttribute('max-symbols'));
    }

    protected get activeClass(): string {
        return this.getAttribute('active-trigger-class-name');
    }
}
