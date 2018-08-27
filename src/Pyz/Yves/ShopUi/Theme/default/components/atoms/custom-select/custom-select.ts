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
        const self = this;

        targetSelect.select2({
            minimumResultsForSearch: Infinity,
            dropdownParent: this.$customSelect,
            width: this.selectWidth,
        });

        this.removeTitle();

        targetSelect.on('select2:select', function() {
            self.removeTitle();
        });
    }

    protected removeTitle():void {
        this.$customSelect.find('.select2-selection__rendered').removeAttr('title');
    }

    get selectWidth(): string {
        return this.$customSelect.find('select').attr('selectWidth');
    }
}