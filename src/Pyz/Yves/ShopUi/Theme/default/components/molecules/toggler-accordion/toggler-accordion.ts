import Component from 'ShopUi/models/component';

export default class TogglerAccordion extends Component {
    readonly wrap: HTMLElement
    readonly triggers: HTMLElement[]
    readonly touchRulesFlag: boolean
    readonly isTouch: boolean

    constructor() {
        super();
        this.wrap = <HTMLElement>document.querySelector(this.wrapSelector);
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.touchRulesFlag = this.touchRules === 'true' ? true : false;
        this.isTouch = "ontouchstart" in window;
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.wrap.addEventListener('click', (event: Event) => this.onTriggerClick(event));
    }

    protected onTriggerClick(event: Event): void {
        if (this.touchRulesFlag) {
            if (this.isTouch) {
                this.initializeClick(event);
            }
        } else {
            this.initializeClick(event);
        }
    }

    protected initializeClick(event: Event): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            let target = <any> event.target;
            while (target != this.wrap) {
                if (target === trigger) {
                    event.preventDefault();
                    this.toggle(trigger);
                    return;
                }
                target = target.parentNode;
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
        targets.forEach((target: HTMLElement) => {
            const isTargetActive = !target.classList.contains(this.classToToggle);
            target.classList.toggle(this.classToToggle, isTargetActive);
        })
    }

    get wrapSelector(): string {
        return this.getAttribute('wrap-selector');
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get classToToggle(): string {
        return this.getAttribute('class-to-toggle');
    }

    get triggerActiveClass(): string {
        return this.getAttribute('active-class');
    }

    get touchRules(): string {
        return this.getAttribute('active-on-touch');
    }
}
