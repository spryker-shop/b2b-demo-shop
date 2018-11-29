import Component from 'ShopUi/models/component';

export default class FormSubmitter extends Component {
    readonly event: string
    readonly triggers: HTMLElement[]

    constructor() {
        super();
        this.event = <string>this.getAttribute('event');
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener(this.event, (event: Event) => this.onTriggerEvent(event)));
    }

    protected onTriggerEvent(event: Event): void {
        event.preventDefault();
        const trigger = <HTMLElement>event.currentTarget;
        const newActionName = this.getDataAttribute(trigger, 'data-change-action-to');
        const form = <HTMLFormElement>trigger.closest('form');
        if (newActionName !== null) {
            form.action = newActionName;
        }
        form.submit();
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    protected getDataAttribute(block: HTMLElement, attr: string): string {
        return block.getAttribute(attr);
    }
}
