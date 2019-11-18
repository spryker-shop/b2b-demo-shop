import SuggestSearch from 'ShopUi/components/molecules/suggest-search/suggest-search';
import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class SuggestSearchExtended extends SuggestSearch {
    protected overlay: OverlayBlock;

    protected readyCallback(): void {
        this.overlay = <OverlayBlock>document.getElementsByClassName(this.overlayClassName)[0];
        super.readyCallback();
    }

    showSugestions(): void {
        this.suggestionsContainer.classList.remove('is-hidden');
        this.searchInput.classList.add(`${this.name}__input--active`);
        this.hintInput.classList.add(`${this.name}__hint--active`);

        if (window.innerWidth >= this.overlayBreakpoint) {
            this.overlay.showOverlay('no-search', 'no-search');
        }
    }

    hideSugestions(): void {
        this.suggestionsContainer.classList.add('is-hidden');
        this.searchInput.classList.remove(`${this.name}__input--active`);
        this.hintInput.classList.remove(`${this.name}__hint--active`);

        if (window.innerWidth >= this.overlayBreakpoint) {
            this.overlay.hideOverlay('no-search', 'no-search');
        }
    }

    protected get overlayClassName(): string {
        return this.getAttribute('overlay-class-name');
    }

    protected get overlayBreakpoint(): number {
        return Number(this.getAttribute('overlay-breakpoint'));
    }
}
