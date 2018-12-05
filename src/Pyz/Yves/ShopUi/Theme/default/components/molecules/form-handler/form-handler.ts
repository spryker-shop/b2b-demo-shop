import Component from 'ShopUi/models/component';

export default class FormHandler extends Component {
    readonly event: string
    readonly triggers: HTMLElement[]
    readonly isShouldSubmitFormFlag: boolean
    readonly isShouldChangeActionFlag: boolean

    constructor() {
        super();
        this.event = <string>this.getAttribute('event');
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.isShouldSubmitFormFlag = this.isShouldSubmitForm === 'true' ? true : false;
        this.isShouldChangeActionFlag = this.isShouldChangeAction === 'true' ? true : false;
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener(this.event, (event: Event) => this.onTriggerEvent(event)));
    }

    protected onTriggerEvent(event: Event): void {
        const trigger = <HTMLElement>event.currentTarget;
        const form = <HTMLFormElement>trigger.closest('form');
        if (this.isShouldChangeActionFlag) {
            const newActionName = this.getDataAttribute(trigger, 'data-change-action-to');
            form.action = newActionName;
        }
        if ( this.isShouldSubmitFormFlag) {
            event.preventDefault();
            form.submit();
        }
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get isShouldSubmitForm(): string {
        return this.getAttribute('submit-form');
    }

    get isShouldChangeAction(): string {
        return this.getAttribute('change-action');
    }

    protected getDataAttribute(block: HTMLElement, attr: string): string {
        return block.getAttribute(attr);
    }
}
