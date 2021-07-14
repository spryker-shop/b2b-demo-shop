import Component from 'ShopUi/models/component';

export default class MiniCartRadio extends Component {
    protected form: HTMLFormElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.form = <HTMLFormElement>this.getElementsByClassName(`${this.jsName}__form`)[0];

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.addEventListener('click', () => this.onMiniCartRadioClick());
    }

    protected onMiniCartRadioClick(): void {
        this.form.submit();
    }
}
