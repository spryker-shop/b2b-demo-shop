import Component from 'ShopUi/models/component';

export default class CustomerReorderLink extends Component {
    protected trigger: HTMLButtonElement;
    protected targetForm: HTMLFormElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = <HTMLButtonElement>this.getElementsByClassName(`${this.jsName}__trigger`)[0];
        this.targetForm = <HTMLFormElement>document.getElementsByClassName(this.formTargetClass)[0];

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.trigger.addEventListener('click', () => this.onTriggerButtonClick());
    }

    protected onTriggerButtonClick(): void {
        this.formSubmit();
    }

    protected formSubmit(): void {
        this.targetForm.submit();
    }

    protected get formTargetClass(): string {
        return this.getAttribute('form-target-class');
    }
}
