import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class SlickCarousel extends Component {

    readyCallback(): void {
        this.mapEvents();
        this.sliderInit();
    }

    protected mapEvents(): void {
        this.sliderContainer.on('init', () => this.showSlider());
    }

    protected showSlider(): void {
        this.sliderContainer.removeClass('is-hidden');
    }

    protected sliderInit (): void {
        this.sliderContainer.slick(
            this.sliderConfig
        );
    }

    get sliderConfig(): object {
        return JSON.parse(this.getAttribute('slider-config'));
    }

    get sliderContainer(): $ {
        return  $(this.querySelector(`.js-${this.name}`));
    }
}
