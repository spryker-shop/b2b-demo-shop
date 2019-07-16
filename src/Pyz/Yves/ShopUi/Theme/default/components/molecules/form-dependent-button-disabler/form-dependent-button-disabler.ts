import Component from 'ShopUi/models/component';

export default class FormDependentButtonDisabler extends Component {
    protected triggers: (HTMLTextAreaElement[]);

    protected readyCallback(): void {
        this.triggers = <HTMLTextAreaElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLTextAreaElement) => {
            trigger.addEventListener('input', (event) => this.toggleButtonVisibility(event));
        });
    }

    protected toggleButtonVisibility(event:Event): void {
        const trigger = <HTMLTextAreaElement>event.currentTarget;
        const targetClass = trigger.getAttribute('target-button-class-name');
        const target = <HTMLButtonElement>document.getElementsByClassName(targetClass)[0];
        const isTargetDisabled = target.hasAttribute('disabled');

        if (this.hasEnoughSymbols(trigger) && isTargetDisabled) {
            trigger.classList.add('valid-message');
            target.removeAttribute('disabled');
        }
        if (!this.hasEnoughSymbols(trigger) && !isTargetDisabled) {
            trigger.classList.remove('valid-message');
            target.setAttribute('disabled', '');
        }
        console.log(trigger.value);
    }
    protected hasEnoughSymbols(trigger): boolean {
        const filteredValue = trigger.value.trim();
        return filteredValue.length >= this.maxSymbols;
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-form-class-name');
    }

    protected get maxSymbols(): number {
        return Number(this.getAttribute('max-symbols'));
    }
}
