import Component from 'ShopUi/models/component';

export default class OverlayBlock extends Component {

    protected readyCallback(): void {}

    showOverlay():void {
        this.classList.add(this.classToShow);
    }

    hideOverlay():void {
        this.classList.remove(this.classToShow);
    }

    get classToShow(): string {
        return this.name + '--is-shown';
    }

}