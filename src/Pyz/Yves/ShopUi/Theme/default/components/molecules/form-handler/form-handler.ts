import Component from 'ShopUi/models/component';

export default class FormHandler extends Component {
    readonly event: string;
    readonly triggers: HTMLElement[];

    constructor() {
        super();
        this.event = <string>this.getAttribute('event');
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
    }

    protected readyCallback(): void {
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

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get shouldSubmitForm(): boolean {
        return this.submitForm === 'true';
    }

    get submitForm(): string  {
        return this.getAttribute('submit-form');
    }

    get shouldChangeAction(): boolean {
        return this.changeAction === 'true';
    }

    get changeAction(): string {
        return this.getAttribute('change-action');
    }

    protected getDataAttribute(block: HTMLElement, attr: string): string {
        return block.getAttribute(attr);
    }
}
