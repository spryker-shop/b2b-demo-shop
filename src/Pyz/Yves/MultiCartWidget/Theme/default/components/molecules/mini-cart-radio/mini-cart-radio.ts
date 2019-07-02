import Component from 'ShopUi/models/component';

export default class MiniCartRadio extends Component {
    radio: HTMLElement;

    protected readyCallback(): void {
        this.radio = this.querySelector(`input`);

        this.mapEvents();
    }

    private mapEvents(): void {
        this.onclick = () => window.location.href = this.locationUrl;
    }

    protected get locationUrl(): string {
        return this.radio.dataset.href;
    }
}
