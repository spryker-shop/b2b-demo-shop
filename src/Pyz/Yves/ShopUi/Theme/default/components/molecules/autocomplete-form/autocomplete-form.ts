import Component from 'ShopUi/models/component';
import AjaxProvider from 'ShopUi/components/molecules/ajax-provider/ajax-provider';
import {
    EVENT_HIDE_OVERLAY,
    EVENT_SHOW_OVERLAY,
    OverlayEventDetail,
} from 'ShopUi/components/molecules/main-overlay/main-overlay';
import debounce from 'lodash-es/debounce';

export default class AutocompleteForm extends Component {
    protected ajaxProvider: AjaxProvider;
    protected inputElement: HTMLInputElement;
    protected hiddenInputElement: HTMLInputElement;
    protected suggestionsContainer: HTMLElement;
    protected cleanButton: HTMLButtonElement;
    protected eventShowOverlay: CustomEvent<OverlayEventDetail>;
    protected eventHideOverlay: CustomEvent<OverlayEventDetail>;

    protected readyCallback(): void {}

    protected init(): void {
        this.ajaxProvider = <AjaxProvider>this.getElementsByClassName(`${this.jsName}__provider`)[0];
        this.suggestionsContainer = <HTMLElement>this.getElementsByClassName(`${this.jsName}__container`)[0];
        this.inputElement = <HTMLInputElement>this.getElementsByClassName(`${this.jsName}__input`)[0];
        this.hiddenInputElement = <HTMLInputElement>this.getElementsByClassName(`${this.jsName}__input-hidden`)[0];
        this.cleanButton = <HTMLButtonElement>this.getElementsByClassName(`${this.jsName}__clean-button`)[0];

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.inputElement.addEventListener(
            'input',
            debounce(() => this.onInput(), this.debounceDelay),
        );
        this.inputElement.addEventListener(
            'blur',
            debounce(() => this.onBlur(), this.debounceDelay),
        );
        this.inputElement.addEventListener('focus', () => this.onFocus());

        if (this.showCleanButton) {
            this.cleanButton.addEventListener('click', () => this.onCleanButtonClick());
        }

        this.mapOverlayEvents();
    }

    protected onCleanButtonClick(): void {
        this.cleanFields();
    }

    protected onBlur(): void {
        this.toggleOverlay(false);
        this.hideSuggestions();
    }

    protected onFocus(): void {
        this.toggleOverlay(true);

        if (this.inputValue.length >= this.minLetters) {
            this.showSuggestions();
        }
    }

    protected onInput(): void {
        if (this.inputValue.length >= this.minLetters) {
            this.loadSuggestions();

            return;
        }
        this.hideSuggestions();
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
        document.body.classList.toggle(this.bodyOverlayClassName, isShown);
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
        const items = Array.from(this.suggestionsContainer.getElementsByClassName(this.itemClassName));
        items.forEach((item: HTMLElement) => {
            item.addEventListener('click', (event: Event) => this.onItemClick(event));
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

    protected get minLetters(): number {
        return Number(this.getAttribute('min-letters'));
    }

    protected get inputValue(): string {
        return this.inputElement.value.trim();
    }

    protected get queryParamName(): string {
        return this.getAttribute('query-param-name');
    }

    protected get valueDataAttribute(): string {
        return this.getAttribute('value-data-attribute');
    }

    protected get itemClassName(): string {
        return this.getAttribute('item-class-name');
    }

    protected get debounceDelay(): number {
        return Number(this.getAttribute('debounce-delay'));
    }

    protected get showCleanButton(): boolean {
        return this.hasAttribute('show-clean-button');
    }

    protected get bodyOverlayClassName(): string {
        return this.getAttribute('body-overlay-class-name');
    }
}
