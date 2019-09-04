import Component from 'ShopUi/models/component';

export default class TogglerCheckbox extends Component {
    protected trigger: HTMLInputElement;
    protected targets: HTMLElement[];
    protected event: CustomEvent;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = <HTMLInputElement>this.getElementsByClassName(`${this.jsName}__trigger`)[0];
        this.targets = <HTMLElement[]>Array.from(document.getElementsByClassName(this.targetClassName));

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
        this.event = new CustomEvent('toggle');
        this.dispatchEvent(this.event);
    }

    protected get addClass(): boolean {
        return this.addClassWhenChecked ? this.trigger.checked : !this.trigger.checked;
    }

    protected get targetClassName(): string {
        return this.trigger.getAttribute('target-class-name');
    }

    protected get classToToggle(): string {
        return this.trigger.getAttribute('class-to-toggle');
    }

    protected get addClassWhenChecked(): boolean {
        return this.trigger.hasAttribute('add-class-when-checked');
    }
}
