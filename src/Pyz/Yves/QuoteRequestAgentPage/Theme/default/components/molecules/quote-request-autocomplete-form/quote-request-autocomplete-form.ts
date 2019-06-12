import AutocompleteForm from "src/ShopUi/components/molecules/autocomplete-form/autocomplete-form";

export default class QuoteRequestAutocompleteForm extends AutocompleteForm {
    protected textInput: HTMLInputElement;

    protected readyCallback(): void {}

    mountCallback(): void {
        super.readyCallback();
        this.textInput = <HTMLInputElement>this.querySelector(`.${this.jsName}__input`);

        if (this.isAutoInitEnabled) {
            this.autoLoadInit();
        }
    }

    protected autoLoadInit(): void {
        this.textInput.focus();
        super.loadSuggestions();
    }

    get isAutoInitEnabled(): boolean {
        return this.hasAttribute('auto-init');
    }
}
