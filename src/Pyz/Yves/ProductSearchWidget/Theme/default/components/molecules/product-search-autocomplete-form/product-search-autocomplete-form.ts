import AutocompleteForm from 'src/ShopUi/components/molecules/autocomplete-form/autocomplete-form';

export enum Events {
    FETCHING = 'fetching',
    FETCHED = 'fetched',
    CHANGE = 'change',
    SET = 'set',
    UNSET = 'unset'
}

interface keyCodes {
    [key: string]: number;
}

const keyCodes = {
    arrowUp: 38,
    arrowDown: 40,
    enter: 13
};

export default class ProductSearchAutocompleteForm extends AutocompleteForm {
    widgetSuggestionsContainer: HTMLElement;
    suggestionItems: HTMLElement[];
    lastSelectedItem: HTMLElement;
    quantityInput: HTMLInputElement;

    protected readyCallback(): void {
        this.widgetSuggestionsContainer = <HTMLElement>this.querySelector(`.${this.jsName}__suggestions`);
        this.quantityInput = <HTMLInputElement>document.querySelector(`.${this.jsName}__quantity-field`);
        super.readyCallback();
        this.plugKeydownEvent();
    }

    protected plugKeydownEvent(): void {
        this.inputElement.addEventListener('keydown', (event) => this.onKeyDown(event));
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

    protected mapItemEvents(): void {
        const self = this;
        const items = Array.from(this.widgetSuggestionsContainer.querySelectorAll(this.itemSelector));
        items.forEach((item: HTMLElement) => item.addEventListener('click', (e: Event) => self.onItemClick(e)));
    }

    protected onKeyDown(event: KeyboardEvent): void {
        if (!this.suggestionItems && this.inputText.length < this.minLetters) {
            return;
        }

        switch (event.keyCode) {
            case keyCodes.arrowUp:
                event.preventDefault();
                this.onKeyDownArrowUp();
                break;
            case keyCodes.arrowDown:
                event.preventDefault();
                this.onKeyDownArrowDown();
                break;
            case keyCodes.enter:
                event.preventDefault();
                this.onKeyDownEnter();
                break;
        }
    }

    protected onKeyDownArrowUp(): void {
        const lastSelectedItemIndex = this.suggestionItems.indexOf(this.lastSelectedItem);
        const elementIndex = lastSelectedItemIndex - 1;
        const lastSuggestionItemIndex = this.suggestionItems.length - 1;
        const item = this.suggestionItems[elementIndex < 0 ? lastSuggestionItemIndex : elementIndex];

        this.changeSelectedItem(item);
    }

    protected onKeyDownArrowDown(): void {
        const lastSelectedItemIndex = this.suggestionItems.indexOf(this.lastSelectedItem);
        const elementIndex = lastSelectedItemIndex + 1;
        const lastSuggestionItemIndex = this.suggestionItems.length - 1;
        const item = this.suggestionItems[elementIndex > lastSuggestionItemIndex ? 0 : elementIndex];

        this.changeSelectedItem(item);
    }

    protected onKeyDownEnter(): void {
        this.lastSelectedItem.click();
    }

    protected changeSelectedItem(item: HTMLElement): void {
        this.lastSelectedItem.classList.remove(this.selectedInputClass);
        item.classList.add(this.selectedInputClass);
        this.lastSelectedItem = item;
    }

    async loadSuggestions(): Promise<void> {
        this.dispatchCustomEvent(Events.FETCHING);
        this.showSuggestions();
        this.ajaxProvider.queryParams.set(this.queryParamName, this.inputText);
        await this.ajaxProvider.fetch();
        this.suggestionItems = Array.from(this.widgetSuggestionsContainer.querySelectorAll(this.itemSelector));
        this.lastSelectedItem = this.suggestionItems[0];
        this.mapItemEvents();
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

    get selectedInputClass(): string {
        return `${this.itemSelector}--selected`.substr(1);
    }

    get inputValue(): string {
        return this.hiddenInputElement.value;
    }

    set inputValue(value: string) {
        this.hiddenInputElement.value = value;
    }
}
