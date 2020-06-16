import ReturnProductReasonCore from 'SalesReturnPage/components/molecules/return-product-reason/return-product-reason';

export default class ReturnProductReason extends ReturnProductReasonCore {
    protected select: HTMLSelectElement;
    protected target: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.select = <HTMLSelectElement>this.getElementsByClassName(this.selectClass)[0];
        this.target = <HTMLElement>this.getElementsByClassName(`${this.jsName}__target`)[0];

        super.toggleTargetClass();
        super.mapEvents();
    }

    protected get selectClass(): string {
        return this.getAttribute('select-class');
    }
}
