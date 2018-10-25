import Component from 'ShopUi/models/component';

export default class QuantityCounter extends Component {

    incrementButton: HTMLButtonElement;
    decrementButton: HTMLButtonElement;
    input: HTMLInputElement;
    value: number;
    readonly duration: number;
    timeout: number;
    inputChange: Event;

    constructor() {
        super();
        this.duration = 1000;
        this.timeout = 0;
        this.inputChange = new Event('change');
    }

    protected readyCallback(): void {
        this.incrementButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__button-increment`);
        this.decrementButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__button-decrement`);
        this.input = <HTMLInputElement>this.querySelector(`.${this.jsName}__input`);
        this.value = this.getValue;
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.incrementButton.addEventListener('click', (event: Event) => this.incrementValue(event));
        this.decrementButton.addEventListener('click', (event: Event) => this.decrementValue(event));
        if(this.autoUpdate) {
            this.input.addEventListener('change', () => this.delayToSubmit());
        }
    }

    protected incrementValue(event): void {
        event.preventDefault();
        if(this.isAvailable) {
            const value = +this.input.value;
            const potentialValue = value + this.step;
            if(value < this.maxQuantity) {
                this.input.value = potentialValue.toString();
                this.triggerInputEvent();
            }
        }
    }

    protected decrementValue(event): void {
        event.preventDefault();
        if(this.isAvailable) {
            const value = +this.input.value;
            const potentialValue = value - this.step;
            if(potentialValue >= this.minQuantity) {
                this.input.value = potentialValue.toString();
                this.triggerInputEvent();
            }
        }
    }

    protected triggerInputEvent(): void {
        this.input.dispatchEvent(this.inputChange);
    }

    protected delayToSubmit(): void {
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => this.onSubmit(), this.duration);
    }

    protected onSubmit(): void {
        if(this.value !== this.getValue) {
            this.input.form.submit();
        }
    }

    get minQuantity(): number {
        return +this.input.getAttribute('min');
    }

    get maxQuantity(): number {
        const max = +this.input.getAttribute('max');
        return max > 0 && max > this.minQuantity ? max : Infinity;
    }

    get step(): number {
        const step = +this.input.getAttribute('step');
        return step > 0 ? step : 1;
    }

    get getValue(): number {
        return +this.input.value;
    }

    get autoUpdate(): boolean {
        return !!this.input.dataset.autoUpdate;
    }

    get isAvailable(): boolean {
        if(!this.input.disabled && !this.input.readOnly) {
            return true;
        }
        return false;
    }
}
