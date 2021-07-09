import FormSubmitterCore from 'ShopUi/components/molecules/form-submitter/form-submitter';

export default class FormSubmitter extends FormSubmitterCore {
    protected onEvent(event: Event): void {
        const trigger = <HTMLFormElement>event.currentTarget;
        const form = <HTMLFormElement>(!this.formSelector ? trigger.closest(TAG_NAME) : document.querySelector(this.formSelector));

        if (!form) {
            return;
        }

        const submit =
            <HTMLButtonElement | HTMLInputElement>form.querySelector('[type="submit"]') ||
            <HTMLButtonElement>form.querySelector('button');

        if (submit) {
            submit.click();
            return;
        }

        form.submit();
    }

    protected get formSelector(): string {
        return this.getAttribute('form-selector');
    }
}
