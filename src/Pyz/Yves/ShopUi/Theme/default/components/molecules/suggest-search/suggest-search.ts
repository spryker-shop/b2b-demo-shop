import SuggestSearchCore from 'ShopUi/components/molecules/suggest-search/suggest-search';
import {
    EVENT_HIDE_OVERLAY,
    EVENT_SHOW_OVERLAY,
    OverlayEventDetail,
} from 'ShopUi/components/molecules/main-overlay/main-overlay';

export default class SuggestSearch extends SuggestSearchCore {
    protected overlay: HTMLElement;
    protected wrapper: HTMLElement;
    protected openTrigger: HTMLElement;
    protected closeTrigger: HTMLElement;
    protected eventShowOverlay: CustomEvent<OverlayEventDetail>;
    protected eventHideOverlay: CustomEvent<OverlayEventDetail>;
    protected isOverlayShown: boolean;

    protected init(): void {
        this.overlay = <HTMLElement>document.getElementsByClassName(this.overlayClassName)[0];
        this.wrapper = <HTMLElement>document.getElementsByClassName(this.wrapperClassName)[0];
        this.openTrigger = <HTMLElement>document.getElementsByClassName(this.openClassName)[0];
        this.closeTrigger = <HTMLElement>document.getElementsByClassName(this.closeClassName)[0];

        super.readyCallback();
    }

    protected mapEvents(): void {
        super.mapEvents();

        this.openTrigger.addEventListener('click', () => this.toggleSearch(true));
        this.closeTrigger.addEventListener('click', () => {
            this.hideSugestions();
            this.toggleSearch(false);
        });

        if (this.shouldCloseByOverlayClick) {
            this.mapOverlayClickEvent();
        }

        this.mapWindowResizeEvent();
    }

    protected mapOverlayClickEvent(): void {
        this.overlay.addEventListener('click', () => {
            this.hideSugestions();
            this.toggleSearch(false);
        });
    }

    protected mapWindowResizeEvent(): void {
        window.addEventListener('resize', () => {
            if (!this.wrapper.classList.contains(this.wrapperToggleClassName)) {
                return;
            }

            if (window.innerWidth >= this.overlayBreakpoint && this.isOverlayShown) {
                this.toggleSearch(false);
            }
        });
    }

    showSugestions(): void {
        super.showSugestions();

        this.searchInput.classList.add(`${this.name}__input--active`);
        this.hintInput.classList.add(`${this.name}__hint--active`);

        if (window.innerWidth >= this.overlayBreakpoint && !this.isOverlayShown) {
            this.toggleSearch(true);
        }
    }

    hideSugestions(): void {
        super.hideSugestions();

        this.searchInput.classList.remove(`${this.name}__input--active`);
        this.hintInput.classList.remove(`${this.name}__hint--active`);

        if (window.innerWidth >= this.overlayBreakpoint && this.isOverlayShown) {
            this.toggleSearch(false);
        }
    }

    protected setupOverlayConfig(): void {
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

    protected toggleSearch(isShown: boolean): void {
        this.wrapper.classList.toggle(this.wrapperToggleClassName, isShown);
        this.classList.toggle(`${this.name}--with-overlay`, isShown);
        document.body.classList.toggle(this.bodyOverlayClassName, isShown);
        this.toggleOverlay(isShown);
    }

    protected toggleOverlay(isShown: boolean): void {
        this.setupOverlayConfig();
        this.dispatchEvent(isShown ? this.eventShowOverlay : this.eventHideOverlay);
        this.isOverlayShown = isShown;
    }

    protected get overlayClassName(): string {
        return this.getAttribute('overlay-class-name');
    }

    protected get bodyOverlayClassName(): string {
        return this.getAttribute('body-overlay-class-name');
    }

    protected get wrapperClassName(): string {
        return this.getAttribute('wrapper-class-name');
    }

    protected get wrapperToggleClassName(): string {
        return this.getAttribute('wrapper-toggle-class-name');
    }

    protected get openClassName(): string {
        return this.getAttribute('open-class-name');
    }

    protected get closeClassName(): string {
        return this.getAttribute('close-class-name');
    }

    protected get shouldCloseByOverlayClick(): boolean {
        return this.hasAttribute('should-close-by-overlay-click');
    }

    protected get overlayBreakpoint(): number {
        return Number(this.getAttribute('overlay-breakpoint'));
    }
}
