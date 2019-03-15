import Component from 'ShopUi/models/component';
import AutocompleteForm, {Events as AutocompleteEvents} from 'ShopUi/components/molecules/autocomplete-form/autocomplete-form';
import AjaxProvider from 'ShopUi/components/molecules/ajax-provider/ajax-provider';
import debounce from 'lodash-es/debounce';

const ERROR_MESSAGE_CLASS = 'quick-order-row__error--show';
const ERROR_PARTIAL_MESSAGE_CLASS = 'quick-order-row-partial__error--show';

export default class QuickOrderRow extends Component {
    ajaxProvider: AjaxProvider;
    autocompleteInput: AutocompleteForm;
    quantityInput: HTMLInputElement;
    errorMessage: HTMLElement;
    timer: number;
    timeout: number = 3000;
    incrementButton: HTMLButtonElement;
    decrementButton: HTMLButtonElement;

    protected readyCallback(): void {
        this.ajaxProvider = <AjaxProvider>this.querySelector(`.${this.jsName}__provider`);
        this.autocompleteInput = <AutocompleteForm>this.querySelector(this.autocompleteFormSelector);
        this.registerQuantityInput();
        this.mapEvents();
    }

    protected registerQuantityInput(): void {
        this.incrementButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__button-increment, .${this.jsName}-partial__button-increment`);
        this.decrementButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__button-decrement, .${this.jsName}-partial__button-decrement`);
        this.quantityInput = <HTMLInputElement>this.querySelector(`.${this.jsName}__quantity, .${this.jsName}-partial__quantity`);
        this.errorMessage = <HTMLElement>this.querySelector(`.${this.name}__error, .${this.name}-partial__error`);
    }

    protected mapEvents(): void {
        this.autocompleteInput.addEventListener(AutocompleteEvents.SET, () => this.onAutocompleteSet());
        this.autocompleteInput.addEventListener(AutocompleteEvents.UNSET, () => this.onAutocompleteUnset());
        this.mapQuantityInputChange();
    }

    protected mapQuantityInputChange(): void {
        this.incrementButton.addEventListener('click', (event: Event) => this.incrementValue(event));
        this.decrementButton.addEventListener('click', (event: Event) => this.decrementValue(event));
        this.quantityInput.addEventListener('input', debounce(() => this.onQuantityChange(), this.autocompleteInput.debounceDelay));
    }

    protected onAutocompleteSet(): void {
        this.reloadField(this.autocompleteInput.inputValue);
    }

    protected onAutocompleteUnset(): void {
        this.reloadField();
    }

    protected onQuantityChange(): void {
        this.reloadField(this.autocompleteInput.inputValue);
    }

    protected hideErrorMessage(): void {
        if (!this.errorMessage) {
            return;
        }

        this.errorMessage.classList.remove(ERROR_MESSAGE_CLASS, ERROR_PARTIAL_MESSAGE_CLASS);
    }

    protected incrementValue(event): void {
        event.preventDefault();
        const value = +this.quantityInput.value;
        const potentialValue = value + this.step;
        if(value < this.maxQuantity) {
            this.quantityInput.value = potentialValue.toString();
            this.onQuantityChange();
        }
    }

    protected decrementValue(event): void {
        event.preventDefault();
        const value = +this.quantityInput.value;
        const potentialValue = value - this.step;
        if(potentialValue >= this.minQuantity) {
            this.quantityInput.value = potentialValue.toString();
            this.onQuantityChange();
        }
    }

    async reloadField(sku: string = '') {
        clearTimeout(this.timer);
        const quantityInputValue = parseInt(this.quantityValue);

        this.ajaxProvider.queryParams.set('sku', sku);
        this.ajaxProvider.queryParams.set('index', this.ajaxProvider.getAttribute('class').split('-').pop().trim());

        if (!!quantityInputValue) {
            this.ajaxProvider.queryParams.set('quantity', `${quantityInputValue}`);
        }

        await this.ajaxProvider.fetch();
        this.registerQuantityInput();
        this.mapQuantityInputChange();

        this.timer = <any>setTimeout(() => this.hideErrorMessage(), this.timeout);

        if (!!sku) {
            this.quantityInput.focus();
        }
    }

    get quantityValue(): string {
        return this.quantityInput.value;
    }

    get autocompleteFormSelector(): string {
        return this.getAttribute('autocomplete-form');
    }

    get minQuantity(): number {
        return +this.quantityInput.getAttribute('min');
    }

    get maxQuantity(): number {
        const max = +this.quantityInput.getAttribute('max');
        return max > 0 && max > this.minQuantity ? max : Infinity;
    }

    get step(): number {
        const step = +this.quantityInput.getAttribute('step');
        return step > 0 ? step : 1;
    }
}
