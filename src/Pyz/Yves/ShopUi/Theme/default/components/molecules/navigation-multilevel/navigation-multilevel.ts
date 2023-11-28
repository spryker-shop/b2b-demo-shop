import Component from 'ShopUi/models/component';
import {
    EVENT_HIDE_OVERLAY,
    EVENT_SHOW_OVERLAY,
    OverlayEventDetail,
} from 'ShopUi/components/molecules/main-overlay/main-overlay';

export default class NavigationMultilevel extends Component {
    protected overlay: HTMLElement;
    protected triggers: HTMLElement[];
    protected touchTriggers: HTMLElement[];
    protected eventShowOverlay: CustomEvent<OverlayEventDetail>;
    protected eventHideOverlay: CustomEvent<OverlayEventDetail>;

    protected readyCallback(): void {}

    protected init(): void {
        this.overlay = <HTMLElement>document.getElementsByClassName(this.overlayBlockClassName)[0];
        this.triggers = <HTMLElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__trigger`));
        this.touchTriggers = <HTMLElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__touch-trigger`));

        this.mapEvents();
        this.addReverseClassToDropDownMenu();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('mouseover', (event: Event) => this.onTriggerOver(event));
        });
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('mouseout', (event: Event) => this.onTriggerOut(event));
        });
        this.touchTriggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', (event: Event) => this.onTriggerClick(event));
        });
        this.mapOverlayEvents();
    }

    protected addReverseClassToDropDownMenu(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            const dropItem = <HTMLElement>trigger.getElementsByClassName(`${this.jsName}__wrapper`)[0];

            if (!dropItem) {
                return;
            }

            if (this.isDropMenuReverse(trigger, dropItem)) {
                dropItem.classList.add(this.reverseClassName);
            }
        });
    }

    protected onTriggerOver(event: Event): void {
        if (this.isWidthMoreThanAvailableBreakpoint()) {
            const trigger = <HTMLElement>event.currentTarget;
            event.preventDefault();
            this.toggleOverlay(true);
            trigger.classList.add(this.classToToggle);
        }
    }

    protected onTriggerOut(event: Event): void {
        if (this.isWidthMoreThanAvailableBreakpoint()) {
            const trigger = <HTMLElement>event.currentTarget;
            event.preventDefault();
            this.toggleOverlay(false);
            trigger.classList.remove(this.classToToggle);
        }
    }

    protected onTriggerClick(event: Event): void {
        if (!this.isWidthMoreThanAvailableBreakpoint()) {
            const trigger = <HTMLElement>event.currentTarget;
            const contentToShowSelector = this.getDataAttribute(trigger, 'data-toggle-target');
            const contentToggleClass = this.getDataAttribute(trigger, 'data-class-to-toggle');
            const closestParentNode = trigger.closest(`.${this.jsName}__item`);
            const contentToShow = closestParentNode.querySelector(contentToShowSelector);

            contentToShow.classList.toggle(contentToggleClass);
            trigger.classList.toggle('is-active');
        }
    }

    protected mapOverlayEvents(): void {
        const overlayConfig: CustomEventInit<OverlayEventDetail> = {
            bubbles: true,
            detail: {
                id: this.name,
                zIndex: Number(getComputedStyle(this).zIndex) - 1,
            },
        };

        this.eventShowOverlay = new CustomEvent(EVENT_SHOW_OVERLAY, overlayConfig);
        this.eventHideOverlay = new CustomEvent(EVENT_HIDE_OVERLAY, overlayConfig);
    }

    protected toggleOverlay(isShown: boolean): void {
        this.dispatchEvent(isShown ? this.eventShowOverlay : this.eventHideOverlay);
    }

    protected isDropMenuReverse(trigger: HTMLElement, dropItem: HTMLElement): boolean {
        const leftPositionToTheMenuItem = trigger.offsetLeft;
        const windowWidth = window.innerWidth;
        const dropItemWidth = dropItem ? dropItem.offsetWidth : 0;

        return windowWidth - leftPositionToTheMenuItem < dropItemWidth;
    }

    protected isWidthMoreThanAvailableBreakpoint(): boolean {
        return window.innerWidth >= this.availableBreakpoint;
    }

    protected getDataAttribute(block: HTMLElement, attr: string): string {
        return block.getAttribute(attr);
    }

    protected get classToToggle(): string {
        return this.getAttribute('class-to-toggle');
    }

    protected get availableBreakpoint(): number {
        return Number(this.getAttribute('available-breakpoint'));
    }

    protected get overlayBlockClassName(): string {
        return this.getAttribute('overlay-block-class-name');
    }

    protected get reverseClassName(): string {
        return this.getAttribute('reverse-class-name');
    }
}
