import Component from 'ShopUi/models/component';

export default class QuantityCounter extends Component {

    readonly incrButton: HTMLButtonElement
    readonly decrButton: HTMLButtonElement
    readonly input: HTMLInputElement

    timeout: number

    constructor() {
        super();
        this.incrButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__button-increment`);
        this.decrButton = <HTMLButtonElement>this.querySelector(`.${this.jsName}__button-decrement`);
        this.input = <HTMLInputElement>this.querySelector(`.${this.jsName}__input`);
        this.timeout = 0;
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.incrButton.addEventListener('click', (event: Event) => this.incrementValue(event));
        this.decrButton.addEventListener('click', (event: Event) => this.decrementValue(event));
        if(this.autoUpdate) {
            this.input.addEventListener('change', () => this.timer());
        }
    }

    protected incrementValue(event): void {
        event.preventDefault();
        const VALUE = +this.input.value;

        if(VALUE <= this.maxQuantity) {
            this.input.stepUp();
            this.triggerInputEvent();
        }
    }

    protected decrementValue(event): void {
        event.preventDefault();
        const VALUE = +this.input.value;

        if(VALUE - this.step >= this.minQuantity) {
            this.input.stepDown();
            this.triggerInputEvent();
        }
    }

    protected triggerInputEvent(): void {
        const CHANGE_EVENT = new Event('change');
        this.input.dispatchEvent(CHANGE_EVENT);
    }

    protected timer(): void {
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => this.input.form.submit(), 1000);
    }

    get minQuantity(): number {
        return +this.input.getAttribute('min');
    }

    get maxQuantity(): number {
        const MAX = +this.input.getAttribute('max');
        return MAX > 0 && MAX > this.minQuantity ? MAX : Infinity;
    }

    get step(): number {
        const STEP = +this.input.getAttribute('step');
        return STEP > 0 ? STEP : 1;
    }

    get autoUpdate(): boolean {
        return !!this.input.dataset.autoUpdate;
    }
}
