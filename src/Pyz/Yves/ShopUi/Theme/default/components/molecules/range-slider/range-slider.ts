import Component from 'ShopUi/models/component';
import noUiSlider from 'nouislider';

export default class RangeSlider extends Component {
    protected sliderContainer: HTMLElement;
    protected rangeInputs: HTMLInputElement[];
    protected numberDigitsAfterDecimalPoint = 2;

    protected readyCallback(): void {}

    protected init(): void {
        this.sliderContainer = <HTMLElement>document.getElementsByClassName(this.wrapClassName)[0];
        this.rangeInputs = <HTMLInputElement[]>Array.from(document.getElementsByClassName(this.inputsClassName));

        this.initUiSlider();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.rangeInputs.forEach((input, index) => {
            input.addEventListener('change', (event: Event) => {
                this.setInputValueToSlider(index, (<HTMLInputElement>event.currentTarget).value);
            });
        });

        this.valueUpdate();
    }

    protected initUiSlider(): void {
        noUiSlider.create(this.sliderContainer, this.sliderConfig);
    }

    protected setInputValueToSlider(index: number, value: string) {
        const inputsValue = [];
        inputsValue[index] = value;
        (<noUiSlider>this.sliderContainer).noUiSlider.set(inputsValue);
    }

    protected valueUpdate(): void {
        (<noUiSlider>this.sliderContainer).noUiSlider.on('update', (values, handle) => {
            this.rangeInputs[handle].value = String(values[handle]);
        });
    }

    protected get wrapClassName(): string {
        return this.getAttribute('wrap-class-name');
    }

    protected get inputsClassName(): string {
        return this.getAttribute('inputs-class-name');
    }

    protected get sliderConfig(): object {
        return Object.assign(JSON.parse(this.getAttribute('slider-config')), {
            format: {
                from: (value) => value,
                to: (value) => {
                    value =
                        value.toFixed(this.numberDigitsAfterDecimalPoint) % 1 === 0
                            ? Math.floor(value)
                            : value.toFixed(this.numberDigitsAfterDecimalPoint);

                    return value;
                },
            },
        });
    }
}
