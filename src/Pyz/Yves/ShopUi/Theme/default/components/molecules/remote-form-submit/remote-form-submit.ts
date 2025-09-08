import CoreRemoteFormSubmit from 'ShopUi/components/molecules/remote-form-submit/remote-form-submit';

export default class RemoteFormSubmit extends CoreRemoteFormSubmit {
    protected createForm(): void {
        if (document.getElementById(this.formName)?.tagName === 'FORM') {
            return;
        }

        super.createForm();
    }

    protected removeFieldsContainer(): void {
        if (!this.fieldsContainer) {
            return;
        }

        super.removeFieldsContainer();
    }
}
