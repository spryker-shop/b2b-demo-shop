import FormSubmitterCore from 'ShopUi/components/molecules/form-submitter/form-submitter';

export default class FormSubmitter extends FormSubmitterCore {
    protected onEvent(event: Event): void {
        const trigger = <HTMLFormElement>event.currentTarget;
        const form = <HTMLFormElement>(
            (this.formClassName ? document.getElementsByClassName(this.formClassName)[0] : trigger.closest(TAG_NAME))
        );

        if (!form) {
            return;
        }

        const submit =
            <HTMLButtonElement | HTMLInputElement>form.querySelector('[type="submit"]') ||
            <HTMLButtonElement>form.querySelector('button:not([type])');

        if (submit) {
            submit.click();

            return;
        }

        form.submit();
    }

    protected get formClassName(): string {
        return this.getAttribute('form-class-name');
    }
}
