import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class SlickCarousel extends Component {

    readyCallback(): void {
        this.mapEvents();
        this.sliderInit();
    }

    protected mapEvents(): void {
        $(this).on('init', () => this.showSlider());
    }

    protected showSlider(): void {
        this.classList.remove('is-hidden');
    }

    protected sliderInit (): void {
        $(this).slick(
            this.sliderConfig
        );
    }

    get sliderConfig(): object {
        return JSON.parse(this.getAttribute('slider-config'));
    }
}
