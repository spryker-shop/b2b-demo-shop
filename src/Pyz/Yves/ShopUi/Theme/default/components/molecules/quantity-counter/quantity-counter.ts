import FormattedNumberInput from 'ShopUi/components/molecules/formatted-number-input/formatted-number-input';
import Component from 'ShopUi/models/component';

export default class QuantityCounter extends Component {
    protected incrementButton: HTMLButtonElement;
    protected decrementButton: HTMLButtonElement;
    protected input: HTMLInputElement;
    protected value: number;
    protected duration = 1000;
    protected timeout = 0;
    protected numberOfDecimalPlaces = 10;
    protected formattedNumberInput: FormattedNumberInput;

    protected readyCallback(): void {}

    protected init(): void {
        this.incrementButton = <HTMLButtonElement>this.getElementsByClassName(`${this.jsName}__button-increment`)[0];
        this.decrementButton = <HTMLButtonElement>this.getElementsByClassName(`${this.jsName}__button-decrement`)[0];
        this.input = <HTMLInputElement>this.getElementsByClassName(`${this.jsName}__input`)[0];
        this.formattedNumberInput = <FormattedNumberInput>(
            this.getElementsByClassName(`${this.jsName}__formatted-input`)[0]
        );
        this.value = this.getValue;
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.decrementButton.addEventListener('click', (event) => this.onChangeQuantity(event, 'decrease'));
        this.incrementButton.addEventListener('click', (event) => this.onChangeQuantity(event, 'increase'));
        this.input?.addEventListener('keydown', (event: KeyboardEvent) => this.onKeyDown(event));

        if (this.autoUpdate) {
            this.input.addEventListener('change', () => this.delayToSubmit());
        }
    }

    protected onChangeQuantity(event: Event, type: 'decrease' | 'increase'): void {
        event.preventDefault();

        if (!this.isAvailable) {
            return;
        }

        const value = this.formattedNumberInput.unformattedValue;
        const step = this.step * this.precision;
        const calculatedValue = type === 'increase' ? value * this.precision + step : value * this.precision - step;
        const potentialValue = Number((calculatedValue / this.precision).toFixed(this.numberOfDecimalPlaces));
        const shouldUpdate = value < this.maxQuantity || potentialValue >= this.minQuantity;

        if (!shouldUpdate) {
            return;
        }

        this.input.value = potentialValue.toString();

        if (this.isAjaxMode) {
            this.delayToSubmit(true);

            return;
        }

        this.input.dispatchEvent(new Event('change'));
        this.input.dispatchEvent(new Event('input'));
    }

    protected delayToSubmit(triggerInput = false): void {
        clearTimeout(this.timeout);
        this.timeout = window.setTimeout(() => {
            if (this.value === this.getValue) {
                return;
            }

            if (this.isAjaxMode && triggerInput) {
                this.input.dispatchEvent(new Event('input', { bubbles: true }));
                this.input.dispatchEvent(new Event('change', { bubbles: true }));
                return;
            }

            if (!this.isAjaxMode) {
                this.input.form.submit();
            }
        }, this.duration);
    }

    protected onKeyDown(event: KeyboardEvent): void {
        if (event.key === 'Enter') {
            event.preventDefault();
        }
    }

    protected get minQuantity(): number {
        return Number(this.input.getAttribute('min'));
    }

    protected get maxQuantity(): number {
        const max = Number(this.input.getAttribute('max'));

        return max > 0 && max > this.minQuantity ? max : Infinity;
    }

    protected get step(): number {
        const step = Number(this.input.getAttribute('step'));

        return step > 0 ? step : 1;
    }

    protected get getValue(): number {
        return this.formattedNumberInput.unformattedValue;
    }

    protected get autoUpdate(): boolean {
        return this.input.hasAttribute('data-auto-update');
    }

    protected get isAvailable(): boolean {
        return !this.input.disabled && !this.input.readOnly;
    }

    protected get precision(): number {
        return Number(`1${'0'.repeat(this.numberOfDecimalPlaces)}`);
    }

    protected get isAjaxMode(): boolean {
        return !!this.input.getAttribute('data-ajax-mode');
    }
}
