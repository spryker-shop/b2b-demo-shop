import Component from 'ShopUi/models/component';
import noUiSlider from 'nouislider';

export default class RangeSlider extends Component {
    sliderContainer: HTMLElement;
    rangeInputs: HTMLInputElement[];

    protected readyCallback(): void {
        this.sliderContainer = document.querySelector(this.wrapSelector);
        this.rangeInputs = Array.from(document.querySelectorAll(this.targetSelector));

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

    get sliderConfig(): object {
        return JSON.parse(this.getAttribute('slider-config'));
    }
}
