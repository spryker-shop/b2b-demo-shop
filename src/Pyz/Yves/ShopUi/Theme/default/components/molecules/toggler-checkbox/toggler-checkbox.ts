import Component from 'ShopUi/models/component';

export default class TogglerCheckbox extends Component {
    readonly trigger: HTMLInputElement
    readonly targets: HTMLElement[]

    constructor() {
        super();
        this.trigger = <HTMLInputElement>this.querySelector(`.${this.jsName}__trigger`);
        this.targets = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetSelector));
    }

    protected readyCallback(): void {
        this.toggle();
        this.fireToggleEvent();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.trigger.addEventListener('change', (event: Event) => this.onTriggerClick(event));
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();
        this.toggle();
        this.fireToggleEvent();
    }

    toggle(addClass: boolean = this.addClass): void {
        this.targets.forEach((element: HTMLElement) => element.classList.toggle(this.classToToggle, addClass));
    }

    fireToggleEvent(): void {
        const event = new CustomEvent('toggle');
        this.dispatchEvent(event);
    }

    get addClass(): boolean {
        return this.addClassWhenChecked ? this.trigger.checked : !this.trigger.checked;
    }

    get targetSelector(): string {
        return this.trigger.getAttribute('target-selector');
    }

    get classToToggle(): string {
        return this.trigger.getAttribute('class-to-toggle');
    }

    get addClassWhenChecked(): boolean {
        return this.trigger.hasAttribute('add-class-when-checked');
    }
}
