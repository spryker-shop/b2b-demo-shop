import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';

export default class ProductCard extends Component {
    protected colorSelector: any;

    protected readyCallback(): void {

        this.colorSelector = $(this).find('color-selector');

        $(this).on('mouseenter', this.classToggler);
        $(this).on('mouseleave', this.classToggler);
    }

    classToggler(): void {

        if (this.colorSelector) {
            this.colorSelector.toggleClass('is-invisible');
        }
    }

}
