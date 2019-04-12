import Component from 'ShopUi/models/component';
import AjaxProvider from 'ShopUi/components/molecules/ajax-provider/ajax-provider';
import debounce from 'lodash-es/debounce';
import OverlayBlock from '../../atoms/overlay-block/overlay-block';

export default class AutocompleteForm extends Component {
    ajaxProvider: AjaxProvider;
    inputElement: HTMLInputElement;
    hiddenInputElement: HTMLInputElement;
    suggestionsContainer: HTMLElement;
    cleanButton: HTMLButtonElement;
    overlay: OverlayBlock;

    protected readyCallback(): void {
        this.ajaxProvider = <AjaxProvider>this.querySelector(`.${this.jsName}__provider`);
        this.suggestionsContainer = <HTMLElement>this.querySelector(`.${this.jsName}__container`);
        this.inputElement = <HTMLInputElement>this.querySelector(`.${this.jsName}__input`);
        this.hiddenInputElement = <HTMLInputElement>this.querySelector(`.${this.jsName}__input-hidden`);
        this.cleanButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__clean-button`);
        this.overlay = <OverlayBlock>document.querySelector(this.overlaySelector);
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.inputElement.addEventListener('input', debounce(() => this.onInput(), this.debounceDelay));
        this.inputElement.addEventListener('blur', debounce(() => this.onBlur(), this.debounceDelay));
        this.inputElement.addEventListener('focus', () => this.onFocus());
        if (this.showCleanButton) {
            this.cleanButton.addEventListener('click', () => this.onCleanButtonClick());
        }
    }

    protected onCleanButtonClick(): void {
        this.cleanFields();
    }

    protected onBlur(): void {
        this.overlay.hideOverlay('no-agent-user', 'no-agent-user');
        this.hideSuggestions();
    }

    protected onFocus(): void {
        this.overlay.showOverlay('no-agent-user', 'no-agent-user');
        if (this.inputValue.length >= this.minLetters) {
            this.showSuggestions();

            return;
        }
    }

    protected onInput(): void {
        if (this.inputValue.length >= this.minLetters) {
            this.loadSuggestions();

            return;
        }
        this.hideSuggestions();
    }

    protected showSuggestions(): void {
        this.suggestionsContainer.classList.remove('is-hidden');
    }

    protected hideSuggestions(): void {
        this.suggestionsContainer.classList.add('is-hidden');
    }

    async loadSuggestions(): Promise<void> {
        this.showSuggestions();
        this.ajaxProvider.queryParams.set(this.queryParamName, this.inputValue);

        await this.ajaxProvider.fetch();
        this.mapItemEvents();
    }

    protected mapItemEvents(): void {
        const self = this;
        const items = Array.from(this.suggestionsContainer.querySelectorAll(this.itemSelector));
        items.forEach((item: HTMLElement) => {
            item.addEventListener('click', (event: Event) => self.onItemClick(event));
        });
    }

    protected onItemClick(event: Event): void {
        const dataTarget = <HTMLElement>event.target;
        const data = dataTarget.getAttribute(this.valueDataAttribute);
        const text = dataTarget.textContent.trim();

        this.setInputs(data, text);
    }

    setInputs(data: string, text: string): void {
        this.hiddenInputElement.value = data;
        this.inputElement.value = text;
    }

    cleanFields(): void {
        this.setInputs('', '');
    }

    get minLetters(): number {
        return Number(this.getAttribute('min-letters'));
    }

    get inputValue(): string {
        return this.inputElement.value.trim();
    }

    get queryParamName(): string {
        return this.getAttribute('query-param-name');
    }

    get valueDataAttribute(): string {
        return this.getAttribute('value-data-attribute');
    }

    get itemSelector(): string {
        return this.getAttribute('item-selector');
    }

    get debounceDelay(): number {
        return Number(this.getAttribute('debounce-delay'));
    }
    get showCleanButton(): boolean {
        return this.hasAttribute('show-clean-button');
    }
    get overlaySelector(): string {
        return '.js-overlay-block';
    }
}
