import AutocompleteForm from 'src/ShopUi/components/molecules/autocomplete-form/autocomplete-form';

export default class QuoteRequestAutocompleteForm extends AutocompleteForm {
    protected textInput: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        super.init();
        this.textInput = <HTMLInputElement>this.getElementsByClassName(`${this.jsName}__input`)[0];

        if (this.isAutoInitEnabled) {
            this.autoLoadInit();
        }
    }

    protected autoLoadInit(): void {
        this.textInput.focus();
        super.loadSuggestions();
    }

    protected get isAutoInitEnabled(): boolean {
        return this.hasAttribute('auto-init');
    }
}
