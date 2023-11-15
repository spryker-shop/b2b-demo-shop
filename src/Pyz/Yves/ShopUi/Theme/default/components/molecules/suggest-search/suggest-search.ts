import SuggestSearchCore from 'ShopUi/components/molecules/suggest-search/suggest-search';
import {
    EVENT_HIDE_OVERLAY,
    EVENT_SHOW_OVERLAY,
    OverlayEventDetail,
} from 'ShopUi/components/molecules/main-overlay/main-overlay';

export default class SuggestSearch extends SuggestSearchCore {
    protected body: HTMLElement;
    protected overlay: HTMLElement;
    protected wrapper: HTMLElement;
    protected openTrigger: HTMLElement;
    protected closeTrigger: HTMLElement;
    protected eventShowOverlay: CustomEvent<OverlayEventDetail>;
    protected eventHideOverlay: CustomEvent<OverlayEventDetail>;

    protected init(): void {
        this.body = <HTMLElement>document.getElementsByTagName('body')[0];
        this.overlay = <HTMLElement>document.getElementsByClassName(this.overlayClassName)[0];
        this.wrapper = <HTMLElement>document.getElementsByClassName(this.wrapperClassName)[0];
        this.openTrigger = <HTMLElement>document.getElementsByClassName(this.openClassName)[0];
        this.closeTrigger = <HTMLElement>document.getElementsByClassName(this.closeClassName)[0];

        super.readyCallback();
    }

    protected mapEvents(): void {
        super.mapEvents();

        this.openTrigger.addEventListener('click', () => this.toggleOverlay(true));
        this.closeTrigger.addEventListener('click', () => {
            this.hideSugestions();
            this.toggleOverlay(false);
        });
        this.mapOverlayEvents();
    }

    showSugestions(): void {
        this.suggestionsContainer.classList.remove('is-hidden');
        this.searchInput.classList.add(`${this.name}__input--active`);
        this.hintInput.classList.add(`${this.name}__hint--active`);
        this.toggleOverlay(true);
    }

    hideSugestions(): void {
        this.suggestionsContainer.classList.add('is-hidden');
        this.searchInput.classList.remove(`${this.name}__input--active`);
        this.hintInput.classList.remove(`${this.name}__hint--active`);
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

        if (this.shouldCloseByOverlayClick) {
            this.mapOverlayClickEvent();
        }
    }

    protected mapOverlayClickEvent(): void {
        this.overlay.addEventListener('click', () => {
            this.hideSugestions();
            this.toggleOverlay(false);
        });
    }

    protected toggleOverlay(isShown: boolean): void {
        this.wrapper.classList.toggle(this.wrapperToggleClassName, isShown);
        this.dispatchEvent(isShown ? this.eventShowOverlay : this.eventHideOverlay);
        this.body.classList.toggle('has-overlay', isShown);
        this.body.classList.toggle('hide-visible-block', isShown);
    }

    protected get overlayClassName(): string {
        return this.getAttribute('overlay-class-name');
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
}
