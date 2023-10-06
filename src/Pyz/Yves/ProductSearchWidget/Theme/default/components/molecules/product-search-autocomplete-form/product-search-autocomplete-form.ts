import AutocompleteForm from 'src/ShopUi/components/molecules/autocomplete-form/autocomplete-form';

export enum Events {
    FETCHING = 'fetching',
    FETCHED = 'fetched',
    CHANGE = 'change',
    SET = 'set',
    UNSET = 'unset',
}

export default class ProductSearchAutocompleteForm extends AutocompleteForm {
    protected widgetSuggestionsContainer: HTMLElement;
    protected suggestionItems: HTMLElement[];
    protected lastSelectedItem: HTMLElement;
    protected quantityInput: HTMLInputElement;

    protected init(): void {
        this.widgetSuggestionsContainer = <HTMLElement>this.getElementsByClassName(`${this.jsName}__suggestions`)[0];
        this.quantityInput = <HTMLInputElement>document.getElementsByClassName(`${this.jsName}__quantity-field`)[0];
        super.init();
        this.plugKeydownEvent();
    }

    protected plugKeydownEvent(): void {
        this.inputElement.addEventListener('keydown', (event: KeyboardEvent) => this.onKeyDown(event));
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
        const items = <HTMLElement[]>(
            Array.from(this.widgetSuggestionsContainer.getElementsByClassName(this.itemClassName))
        );
        items.forEach((item: HTMLElement) => {
            item.addEventListener('click', (event: Event) => this.onItemClick(event));
        });
    }

    protected onKeyDown(event: KeyboardEvent): void {
        if (!this.suggestionItems && this.inputText.length < this.minLetters) {
            return;
        }

        switch (event.key) {
            case 'ArrowUp':
                this.onKeyDownArrowUp();
                break;
            case 'ArrowDown':
                this.onKeyDownArrowDown();
                break;
            case 'Enter':
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
        this.suggestionItems = <HTMLElement[]>(
            Array.from(this.widgetSuggestionsContainer.getElementsByClassName(this.itemClassName))
        );
        this.lastSelectedItem = this.suggestionItems[0];
        this.mapItemEvents();
    }

    setInputs(data: string, text: string): void {
        this.inputText = text;
        this.inputValue = data;

        this.dispatchCustomEvent(Events.SET, { text: this.inputText, value: this.inputValue });

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
        }
    }

    protected get inputText(): string {
        return this.inputElement.value.trim();
    }

    protected set inputText(value: string) {
        this.inputElement.value = value;
    }

    protected get selectedInputClass(): string {
        return `${this.itemClassName}--selected`.substring(1);
    }

    protected get inputValue(): string {
        return this.hiddenInputElement.value;
    }

    protected set inputValue(value: string) {
        this.hiddenInputElement.value = value;
    }
}
