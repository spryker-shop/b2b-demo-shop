import Component from 'ShopUi/models/component';
import noUiSlider from 'nouislider';

export default class RangeSlider extends Component {
    sliderContainer: HTMLElement;
    sliderConfig: object;
    rangeInputs: HTMLInputElement[];

    protected readyCallback(): void {
        this.sliderContainer = document.querySelector(this.wrapSelector);
        this.rangeInputs = Array.from(document.querySelectorAll(this.targetSelector));
        this.sliderConfig = {
            start: [ this.valueCurrentMin, this.valueCurrentMax ],
            step: 1,
            connect: true,
            margin: 1,
            range: {
                'min': this.valueMin,
                'max': this.valueMax
            }
        };

        this.initUiSlider();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.rangeInputs.forEach((input, index) => {
            input.addEventListener('change',  (event: Event) => {
                this.setInputValueToSlider(index, (<HTMLInputElement>event.currentTarget).value);
            });
        });

        this.valueUpdate();
    }

    protected initUiSlider(): void {
        noUiSlider.create(this.sliderContainer, this.sliderConfig);
    }

    protected setInputValueToSlider(index, value) {
        const inputsValue = [null, null];
        inputsValue[index] = value;
        (<noUiSlider>this.sliderContainer).noUiSlider.set(inputsValue);
    }

    protected valueUpdate(): void {
        (<noUiSlider>this.sliderContainer).noUiSlider.on('update', ( values, handle ) => {
            this.rangeInputs[handle].value = String(values[handle]);
        });
    }

    get wrapSelector(): string {
        return this.getAttribute('wrap-selector');
    }

    get targetSelector(): string {
        return this.getAttribute('target-selector');
    }

    get valueMin(): number {
        return Number(this.getAttribute('value-min'));
    }

    get valueMax(): number {
        return Number(this.getAttribute('value-max'));
    }

    get valueCurrentMin(): string {
        return this.getAttribute('active-min');
    }

    get valueCurrentMax(): string {
        return this.getAttribute('active-max');
    }
}
