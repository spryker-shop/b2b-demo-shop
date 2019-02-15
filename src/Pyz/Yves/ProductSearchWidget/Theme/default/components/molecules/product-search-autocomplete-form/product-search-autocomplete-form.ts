import AutocompleteForm from 'src/ShopUi/components/molecules/autocomplete-form/autocomplete-form';

export enum Events {
    FETCHING = 'fetching',
    FETCHED = 'fetched',
    CHANGE = 'change',
    SET = 'set',
    UNSET = 'unset'
}

export default class ProductSearchAutocompleteForm extends AutocompleteForm {
    widgetSuggestionsContainer: HTMLElement;
    quantityInput: HTMLInputElement;

    protected readyCallback(): void {
        this.widgetSuggestionsContainer = <HTMLElement>this.querySelector(`.${this.jsName}__suggestions`);
        this.quantityInput = <HTMLInputElement>document.querySelector(`.${this.jsName}__quantity-field`);
        super.readyCallback();
    }

    protected onInput(): void {
        if (this.inputText.length >= this.minLetters) {
            this.loadSuggestions();
            return;
        }
        this.hideSuggestions();
    }

    protected showSuggestions(): void {
        this.widgetSuggestionsContainer.classList.remove('is-hidden');
    }

    protected hideSuggestions(): void {
        this.widgetSuggestionsContainer.classList.add('is-hidden');
    }

    async loadSuggestions(): Promise<void> {
        this.showSuggestions();
        this.ajaxProvider.queryParams.set(this.queryParamName, this.inputText);
        await this.ajaxProvider.fetch();
        this.mapItemEvents();
    }

    protected mapItemEvents(): void {
        const self = this;
        const items = Array.from(this.widgetSuggestionsContainer.querySelectorAll(this.itemSelector));
        items.forEach((item: HTMLElement) => item.addEventListener('click', (e: Event) => self.onItemClick(e)));
    }

    setInputs(data: string, text: string): void {
        this.inputText = text;
        this.inputValue = data;

        this.dispatchCustomEvent(Events.SET, {
            text: this.inputText,
            value: this.inputValue
        });

        if (this.quantityInput) {
            this.quantityInput.focus();
        }
    }

    protected onBlur(): void {
        this.hideSuggestions();
    }

    protected onFocus(): void {
        if (this.inputText.length >= this.minLetters) {
            this.showSuggestions();
            return;
        }
    }

    get inputText(): string {
        return this.inputElement.value.trim();
    }

    set inputText(value: string) {
        this.inputElement.value = value;
    }

    get inputValue(): string {
        return this.hiddenInputElement.value;
    }

    set inputValue(value: string) {
        this.hiddenInputElement.value = value;
    }
}
