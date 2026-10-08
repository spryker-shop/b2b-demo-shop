import Component from 'ShopUi/models/component';
import noUiSlider, { Options, target } from 'nouislider';

export default class RangeSlider extends Component {
    protected sliderContainer: target;
    protected rangeInputs: HTMLInputElement[];
    protected numberDigitsAfterDecimalPoint = 2;

    protected init(): void {
        this.sliderContainer = <target>document.getElementsByClassName(this.wrapClassName)[0];
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
        this.sliderContainer.noUiSlider.set(inputsValue);
    }

    protected valueUpdate(): void {
        this.sliderContainer.noUiSlider.on('update', (values, handle) => {
            this.rangeInputs[handle].value = String(values[handle]);
        });
    }

    protected get wrapClassName(): string {
        return this.getAttribute('wrap-class-name');
    }

    protected get inputsClassName(): string {
        return this.getAttribute('inputs-class-name');
    }

    protected get sliderConfig(): Options {
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
