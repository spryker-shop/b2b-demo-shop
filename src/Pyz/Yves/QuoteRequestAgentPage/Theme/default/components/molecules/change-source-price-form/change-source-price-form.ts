import SourcePriceForm from '../source-price-form/source-price-form';

export default class ChangeSourcePriceForm extends SourcePriceForm {
    protected init(): void {
        super.readyCallback();
    }
}
