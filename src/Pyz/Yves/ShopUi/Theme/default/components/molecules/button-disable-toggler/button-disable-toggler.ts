import Component from 'ShopUi/models/component';

type triggerType = HTMLTextAreaElement|HTMLInputElement;

export default class ButtonDisableToggler extends Component {
    protected triggers: (triggerType[]);

    protected readyCallback(): void {
        this.triggers = <triggerType[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: triggerType) => {
            trigger.addEventListener('input', (event: Event) => this.toggleButtonVisibility(event));
        });
    }

    protected toggleButtonVisibility(event:Event): void {
        const trigger = <triggerType>event.currentTarget;
        const targetClass = trigger.getAttribute('target-button-class-name');
        const target = <HTMLButtonElement>document.getElementsByClassName(targetClass)[0];

        this.toggleStatus(trigger, target, this.hasEnoughSymbols(trigger));
    }

    protected toggleStatus(textarea: triggerType, button: HTMLButtonElement, force: boolean): void {
        textarea.classList.toggle('valid-message', force);
        button.toggleAttribute('disabled', !force);
    }

    protected hasEnoughSymbols(textarea: triggerType): boolean {
        const filteredValueLength = textarea.value.trim().length;
        return filteredValueLength >= this.minSymbols;
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-form-class-name');
    }

    protected get minSymbols(): number {
        return Number(this.getAttribute('max-symbols'));
    }
}
