import Component from 'ShopUi/models/component';
import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class NavigationMultilevel extends Component {
    readonly overlay: OverlayBlock
    readonly triggers: HTMLElement[]
    readonly targets: HTMLElement[]

    constructor() {
        super();
        this.overlay = <OverlayBlock>document.querySelector(this.overlaySelector);
        this.triggers = <HTMLElement[]>Array.from(this.querySelectorAll(this.trigerSelector));
        this.targets = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetSelector));
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener('mouseover', (event: Event) => this.onTriggerOver(event)));
        this.triggers.forEach((trigger: HTMLElement) => trigger.addEventListener('mouseout', (event: Event) => this.onTriggerOut(event)));
    }

    protected onTriggerOver(event: Event): void {
        const trigger = <HTMLElement>event.currentTarget;
        event.preventDefault();
        this.overlay.showOverlay();
        this.addClass(trigger);
    }

    protected addClass(trigger: HTMLElement): void {
        trigger.classList.add(this.classToToggle);
    }

    protected onTriggerOut(event: Event): void {
        const trigger = <HTMLElement>event.currentTarget;
        event.preventDefault();
        this.overlay.hideOverlay();
        this.removeClass(trigger);
    }

    protected removeClass(trigger: HTMLElement): void {
        trigger.classList.remove(this.classToToggle);
    }

    get targetSelector(): string {
        return this.getAttribute('target-selector');
    }

    get classToToggle(): string {
        return this.getAttribute('class-to-toggle');
    }

    get overlaySelector(): string {
        return '.js-overlay-block';
    }

    get trigerSelector(): string {
        return '.js-menu-trigger';
    }

}
