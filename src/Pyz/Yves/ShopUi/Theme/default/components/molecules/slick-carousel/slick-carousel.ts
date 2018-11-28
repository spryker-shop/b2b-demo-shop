import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class SlickCarousel extends Component {
    slider: HTMLElement

    readyCallback(): void {
        this.slider = this.querySelector(`.${this.jsName}__container`);
        this.mapEvents();
        this.sliderInit();
    }

    protected mapEvents(): void {
        $(this.slider).on('init', () => this.showSlider());
    }

    protected showSlider(): void {
        this.slider.classList.add('is-inited');
    }

    protected sliderInit (): void {
        $(this.slider).slick(
            this.sliderConfig
        );
    }

    get sliderConfig(): object {
        return JSON.parse(this.getAttribute('slider-config'));
    }
}
