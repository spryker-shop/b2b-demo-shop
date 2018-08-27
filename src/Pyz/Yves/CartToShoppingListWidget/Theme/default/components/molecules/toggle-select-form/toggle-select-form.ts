import Component from 'ShopUi/models/component';

export default class ToggleSelectForm extends Component {
    readonly trigger: HTMLSelectElement
    readonly targets: HTMLElement[]

    constructor() { 
        super();
        this.trigger = <HTMLSelectElement>this.querySelector('[data-select-trigger]');
        this.targets = <HTMLElement[]>Array.from(document.getElementsByClassName(this.target));
    }

    readyCallback(): void {
        this.toggle();
        this.mapEvents();
    }

    mapEvents(): void {
        this.trigger.addEventListener('change', (event: Event) => this.onTriggerClick(event));
    }

    onTriggerClick(event: Event): void { 
        event.preventDefault();
        this.toggle();
    }

    toggle(addClass: boolean = this.addClass): void {
        this.targets.forEach((element: HTMLElement) => element.classList.toggle(this.classToToggle, addClass));
    }

    get addClass(): boolean {
        return this.trigger.value !== '';
    }

    get target(): string {
        return this.trigger.getAttribute('target');
    }

    get classToToggle(): string {
        return this.trigger.getAttribute('class-to-toggle');
    }
}
