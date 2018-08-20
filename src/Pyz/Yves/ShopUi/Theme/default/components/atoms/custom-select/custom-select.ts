import Component from 'ShopUi/models/component';
import $ from 'jquery';
import select from 'select2';

export default class CustomSelect extends Component {

    readonly $customSelect: $

    constructor() {
        super();
        this.$customSelect = <$>$(this);
    }

    protected readyCallback(): void {
        const select2 = select;
        const targetSelect = this.$customSelect.find(`.js-${this.name}`);

        targetSelect.select2({
            minimumResultsForSearch: Infinity,
            dropdownParent: this.$customSelect,
            width: '100%'
        });

        this.removeTitle();

        targetSelect.on('select2:select', function() {
            this.removeTitle();
        });
    }

    protected removeTitle():void {
        this.$customSelect.find('.select2-selection__rendered').removeAttr('title');
    }

}