import Component from 'ShopUi/models/component';

export default class MiniCartRadio extends Component {
    protected radio: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.radio = this.getElementsByTagName('input')[0];

        this.mapEvents();
    }

    private mapEvents(): void {
        this.onclick = () => window.location.href = this.locationUrl;
    }

    protected get locationUrl(): string {
        return this.radio.dataset.href;
    }
}
