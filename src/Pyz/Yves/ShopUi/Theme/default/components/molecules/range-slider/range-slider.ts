import Component from 'ShopUi/models/component';
import noUiSlider from 'nouislider';

export default class RangeSlider extends Component {

    wrap: any;

    protected readyCallback(): void {

        this.wrap = document.querySelector(this.wrapSelector);
        const sliderConfig = {
            start: [ this.valueCurrentMin, this.valueCurrentMax ],
            step: 1,
            connect: true,
            margin: 1,
            range: {
                'min': +this.valueMin,
                'max': +this.valueMax
            }
        };

        noUiSlider.create(this.wrap, sliderConfig);

        const selectorList = <string> JSON.parse(this.targetSelector);
        const inputs = Array.from(document.querySelectorAll(selectorList));
        this.valueUpdate(this.wrap, inputs);

        inputs.forEach((input, index) => {
            input.addEventListener('change',  (event: Event) => {
                const currentInput = <HTMLInputElement> event.currentTarget;
                this.setInputValueToSlider(index, currentInput.value);
            });
        });

    }

    protected setInputValueToSlider(i, value) {
        const r = [null,null];
        r[i] = value;
        this.wrap.noUiSlider.set(r);
    }

    protected valueUpdate(wrap, target): void {
        wrap.noUiSlider.on('update', function changeValue( values, handle ) {
            target[handle].value = Number(values[handle]);
        });
    }

    get wrapSelector(): string {
        return this.getAttribute('wrap-selector');
    }

    get valueMin(): string {
        return this.getAttribute('value-min');
    }

    get valueMax(): string {
        return this.getAttribute('value-max');
    }

    get valueCurrentMin(): string {
        return this.getAttribute('active-min');
    }

    get targetSelector(): string {
        return this.getAttribute('target-selector');
    }

    get valueCurrentMax(): string {
        return this.getAttribute('active-max');
    }

}