import Component from 'ShopUi/models/component';

export default class TogglerClick extends Component {
    readonly triggers: HTMLElement[]
    readonly targets: HTMLElement[]
    readonly bodyFlagVar: boolean

    constructor() {
        super();
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.targets = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetSelector));
        this.bodyFlagVar = JSON.parse(this.bodyFlag);
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener('click', (event: Event) => this.onTriggerClick(event)));
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();
        this.toggle();
    }

    protected fixBody(isClassAddedFlag: boolean): void {
        const body = document.querySelector("body");

        if (!isClassAddedFlag) {
            const offset = window.pageYOffset;

            body.style.cssText = "top:"+`${-offset}px`;
            body.classList.add("is-locked");
            body.dataset.scrollTo = offset.toString();
        } else {
            const scrollToVal = +body.dataset.scrollTo;

            body.style.cssText = "top: '';";
            body.classList.remove("is-locked");
            window.scrollTo( 0, scrollToVal );
        }
    }

    toggle(): void {
        this.targets.forEach((target: HTMLElement) => {
            const addClass = !target.classList.contains(this.classToToggle);
            target.classList.toggle(this.classToToggle, addClass);
            if (this.bodyFlagVar) {
                this.fixBody(addClass);
            }
        });
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

    get bodyFlag(): string {
        return this.getAttribute('fix-body');
    }
}
