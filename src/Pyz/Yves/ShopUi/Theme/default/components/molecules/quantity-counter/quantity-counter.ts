import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';

export default class QuantityCounter extends Component {

    timeout = null;

    protected readyCallback(): void {

        const input = $(this).find(`.${this.name}__input`);
        let maxQuantity = input.data('max-quantity');
        const decrButton = $(this).find('.js-quantity-decrement');
        const incrButton = $(this).find('.js-quantity-increment');
        const autoUpdate = input.data('auto-update');
        const form = $(this).parent('form');

        const self = this;

        if(!maxQuantity){
            maxQuantity = Infinity;
        }
        decrButton.click(() => {
            let value = +input.val();
            if(value > 1){
                input.val(value - 1);

                const event = new CustomEvent('quantityChange');
                self.querySelector(`.${self.name}__input`).dispatchEvent(event);
                if(autoUpdate) {
                    this.timer(form);
                }
            }
        });
        incrButton.click(() => {
            let value = +input.val();
            if(value < maxQuantity) {
                input.val(value + 1);

                const event = new CustomEvent('quantityChange');
                self.querySelector(`.${self.name}__input`).dispatchEvent(event);
                if(autoUpdate) {
                    this.timer(form);
                }
            }
        });

        if(autoUpdate) {
            input.change(() => this.timer(form));
        }
    }

    protected timer(form): void {
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => form.submit(), 1000);
    }
}
