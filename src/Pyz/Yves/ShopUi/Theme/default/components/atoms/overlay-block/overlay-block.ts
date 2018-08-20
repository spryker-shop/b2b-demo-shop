import Component from 'ShopUi/models/component';

export default class OverlayBlock extends Component {

    protected readyCallback(): void {}

    showOverlay():void {
        this.classList.add('showed');
    }

    hideOverlay():void {
        this.classList.remove('showed');
    }

}