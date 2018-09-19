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
        this.closestPolyfill();
        this.mapEvents();
    }

    protected closestPolyfill(): void {
        if (!Element.prototype.matches)
            Element.prototype.matches = Element.prototype.msMatchesSelector ||
                Element.prototype.webkitMatchesSelector;

        if (!Element.prototype.closest) {
            Element.prototype.closest = function(s) {
                var el = this;
                if (!document.documentElement.contains(el)) return null;
                do {
                    if (el.matches(s)) return el;
                    el = el.parentElement || el.parentNode;
                } while (el !== null && el.nodeType === 1);
                return null;
            };
        }
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener(this.event, (event: Event) => this.onTriggerEvent(event)));
    }

    protected onTriggerEvent(event: Event): void {
        event.preventDefault();
        const trigger = <HTMLElement>event.target;
        const form = <HTMLFormElement>trigger.closest('form');
        const eventSubmit = new Event('submit');
        // console.log(eventSubmit);
        // form.submit();
        form.dispatchEvent(eventSubmit);
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }
}
