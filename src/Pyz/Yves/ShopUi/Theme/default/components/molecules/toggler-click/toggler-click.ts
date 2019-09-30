import Component from 'ShopUi/models/component';

export default class TogglerClick extends Component {
    readonly triggers: HTMLElement[];
    readonly targets: HTMLElement[];
    protected disablers: HTMLElement[] = [];

    constructor() {
        super();
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.targets = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetSelector));

        if (this.disablerClassName) {
            const disablerClassNamesList = this.disablerClassName.split(',');

            disablerClassNamesList.forEach(disablerClassName => {
                this.disablers = <HTMLElement[]>
                    [...this.disablers, ...Array.from(document.getElementsByClassName(disablerClassName))];
            });
        }
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', (event: Event) => this.onTriggerClick(event));
        });

        this.disablers.forEach((disabler: HTMLElement) => {
            disabler.addEventListener('click', (event: Event) => this.removeClassToToggle());
        });
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();

        this.toggle(event);
    }

    protected removeClassToToggle(): void {
        this.targets.forEach((target: HTMLElement) => {
            target.classList.remove(this.classToToggle);
        });
    }

    toggle(event: Event): void {
        this.onTriggerToggleClass(event);

        this.targets.forEach((target: HTMLElement) => {
            const addClass = !target.classList.contains(this.classToToggle);
            target.classList.toggle(this.classToToggle, addClass);
        });
    }

    protected onTriggerToggleClass(event: Event): void {
        if (this.triggerClassToToggle.length !== 0) {
            const triggerTarget = <HTMLElement>event.currentTarget;

            triggerTarget.classList.toggle(this.triggerClassToToggle);
        }
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get targetSelector(): string {
        return this.getAttribute('target-selector');
    }

    get classToToggle(): string {
        return this.getAttribute('class-to-toggle');
    }

    get triggerClassToToggle(): string {
        return this.getAttribute('trigger-class-to-toggle');
    }

    protected get disablerClassName(): string {
        return this.getAttribute('disabler-class-name');
    }
}
