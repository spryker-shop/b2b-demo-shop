import Component from 'ShopUi/models/component';

export default class FormHandler extends Component {
    protected event: string;
    protected triggers: HTMLElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.event = this.getAttribute('event');
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener(this.event, (event: Event) => this.onTriggerEvent(event));
        });
    }

    protected onTriggerEvent(event: Event): void {
        const trigger = <HTMLElement>event.currentTarget;
        const form = <HTMLFormElement>trigger.closest('form');
        if (this.shouldChangeAction) {
            const newActionName = this.getDataAttribute(trigger, 'data-change-action-to');
            form.action = newActionName;
        }
        if (this.shouldSubmitForm) {
            event.preventDefault();
            form.submit();
        }
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get shouldSubmitForm(): boolean {
        return this.submitForm === 'true';
    }

    protected get submitForm(): string  {
        return this.getAttribute('submit-form');
    }

    protected get shouldChangeAction(): boolean {
        return this.changeAction === 'true';
    }

    protected get changeAction(): string {
        return this.getAttribute('change-action');
    }

    protected getDataAttribute(block: HTMLElement, attr: string): string {
        return block.getAttribute(attr);
    }
}
