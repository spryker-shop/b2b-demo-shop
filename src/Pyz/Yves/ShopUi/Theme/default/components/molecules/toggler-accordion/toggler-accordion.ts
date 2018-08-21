import Component from 'ShopUi/models/component';

export default class TogglerAccordion extends Component {
    readonly wrap: HTMLElement
    readonly triggers: HTMLElement[]

    constructor() {
        super();
        this.wrap = <HTMLElement>document.querySelector(this.wrapSelector);
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.wrap.addEventListener('click', (event: Event) => this.onTriggerClick(event));
    }

    protected onTriggerClick(event: Event): void {
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

    toggle(activeTrigger: HTMLElement): void {
        if (activeTrigger.classList.contains(this.triggerActiveClass)) {
            activeTrigger.classList.remove(this.triggerActiveClass);
            this.targetToggle(activeTrigger, false);
        } else {
            activeTrigger.classList.add(this.triggerActiveClass);
            this.targetToggle(activeTrigger, true);
        }
    }

    targetToggle(target: HTMLElement, active: Boolean): void {
        active ?
            document.querySelector(target.dataset.toggleTarget).classList.remove(this.classToToggle)
            :
            document.querySelector(target.dataset.toggleTarget).classList.add(this.classToToggle);
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
}