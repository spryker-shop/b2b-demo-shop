import Component from 'ShopUi/models/component';
import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class TogglerClick extends Component {
    readonly triggers: HTMLElement[]
    readonly targets: HTMLElement[]
    readonly bodyFlagVar: boolean
    readonly overlay: OverlayBlock
    readonly OverlayModifiers: string[]
    isContentOpened: boolean

    constructor() {
        super();
        this.overlay = <OverlayBlock>document.querySelector(this.overlaySelector);
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.targets = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetSelector));
        this.bodyFlagVar = JSON.parse(this.bodyFlag);
        this.OverlayModifiers = this.overlayModifiers.split(', ');
        this.isContentOpened = false;
    }

    protected readyCallback(): void {
        this.inspectionContentOpened();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener('click', (event: Event) => this.onTriggerClick(event)));
        document.addEventListener('click', (event: Event) => this.clickOutside(event));
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();
        this.toggle(event);
    }

    protected inspectionContentOpened(): void {
        if (this.clickOutsideAction.length !== 0) {
            this.targets.forEach((target: HTMLElement) => {
                const isTargetActive = target.classList.contains(this.classToToggle);

                if (isTargetActive) {
                    this.isContentOpened = true;
                }
            })
        }
    }

    clickOutside(event: Event): void {
        if (this.clickOutsideAction.length !== 0) {
            if (this.isContentOpened) {
                const eventTrigger = <HTMLElement>event.target;
                const closestTarget = !!eventTrigger.closest(this.targetSelector);
                const closestTriggers = !!eventTrigger.closest(this.triggerSelector);

                if (!closestTarget && !closestTriggers) {
                    if (this.clickOutsideAction === 'hide-class') {
                        this.targets.forEach((target: HTMLElement) => {
                            target.classList.remove(this.classToToggle);
                        })

                        if (this.triggerClassToToggle.length !== 0) {
                            this.triggers.forEach((trigger: HTMLElement) => {
                                trigger.classList.remove(this.classToToggle);
                            })
                        }

                        this.removeOverlay();
                    }

                    if (this.clickOutsideAction === 'show-class') {
                        this.targets.forEach((target: HTMLElement) => {
                            target.classList.add(this.classToToggle);
                        })

                        if (this.triggerClassToToggle.length !== 0) {
                            this.triggers.forEach((trigger: HTMLElement) => {
                                trigger.classList.add(this.classToToggle);
                            })
                        }
                    }

                    this.isContentOpened = false;
                }
            }
        }
    }

    toggle(event: Event): void {
        this.onTriggerToggleClass(event);

        this.targets.forEach((target: HTMLElement) => {
            const addClass = !target.classList.contains(this.classToToggle);
            target.classList.toggle(this.classToToggle, addClass);

            this.toggleOverlay(addClass);
            this.isContentOpened = !this.isContentOpened;

            if (this.bodyFlagVar) {
                this.fixBody(addClass);
            }
        });
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

    protected onTriggerToggleClass(event: Event): void {
        if (this.triggerClassToToggle.length !== 0) {
            const triggerTarget = <HTMLElement>event.currentTarget;

            triggerTarget.classList.toggle(this.triggerClassToToggle);
        }
    }

    protected toggleOverlay(flag: boolean): void {
        if (flag) {
            this.addOverlay();
        } else {
            this.removeOverlay();
        }
    }

    protected addOverlay(): void {
        if (this.overlayModifiers.length !== 0) {
            this.overlay.showOverlay(this.OverlayModifiers[0], this.OverlayModifiers[1]);
        }
    }

    protected removeOverlay(): void {
        if (this.overlayModifiers.length !== 0) {
            this.overlay.hideOverlay(this.OverlayModifiers[0], this.OverlayModifiers[1]);
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

    get bodyFlag(): string {
        return this.getAttribute('fix-body');
    }

    get overlaySelector(): string {
        return '.js-overlay-block';
    }

    get overlayModifiers(): string {
        return this.getAttribute('toggle-overlay-modifiers');
    }

    get clickOutsideAction(): string {
        return this.getAttribute('click-outside');
    }

}
