import Component from 'ShopUi/models/component';

export default class TogglerAccordion extends Component {
    readonly wrap: HTMLElement;
    readonly triggers: HTMLElement[];
    readonly isTouch: boolean;

    constructor() {
        super();
        this.wrap = <HTMLElement>document.querySelector(this.wrapSelector);
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.isTouch = 'ontouchstart' in window;
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.wrap.addEventListener('click', (event: Event) => this.onTriggerClick(event));
    }

    protected onTriggerClick(event: Event): void {
        if (this.isTouchScreen) {
            if (this.isTouch) {
                this.initializeClick(event);
            }
        } else {
            this.initializeClick(event);
        }
    }

    protected initializeClick(event: Event): void {
        this.triggers.some((trigger: HTMLElement) => {
            let target = <HTMLElement>event.target;

            while (target !== this.wrap) {
                if (target === trigger) {
                    event.preventDefault();
                    this.toggle(trigger);

                    return true;
                }
                target = <HTMLElement>target.parentNode;
            }
        });
    }

    protected toggle(activeTrigger: HTMLElement): void {
        const isTriggerActive = activeTrigger.classList.contains(this.triggerActiveClass);
        activeTrigger.classList.toggle(this.triggerActiveClass, !isTriggerActive);
        this.targetToggle(activeTrigger);
    }

    protected targetToggle(target: HTMLElement): void {
        const targets = <HTMLElement[]>Array.from(document.querySelectorAll(target.dataset.toggleTarget));
        targets.forEach((element: HTMLElement) => {
            const isTargetActive = !element.classList.contains(this.classToToggle);
            element.classList.toggle(this.classToToggle, isTargetActive);
        });
    }

    protected get wrapSelector(): string {
        return this.getAttribute('wrap-selector');
    }

    protected get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    protected get classToToggle(): string {
        return this.getAttribute('class-to-toggle');
    }

    protected get triggerActiveClass(): string {
        return this.getAttribute('active-class');
    }

    protected get isTouchScreen(): boolean {
        return this.touchRules === 'true';
    }

    protected get touchRules(): string {
        return this.getAttribute('active-on-touch');
    }
}
