import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class SlickCarousel extends Component {

    readyCallback(): void {

        const $container = $(this).find(`.${this.name}__container`);
        const sliderConfig = $(this).data('json');

        $container.on('init', function (event, slick) {
            $(this).fadeIn('fast', () => $(this).removeClass('is-hidden'));
        });

        $container.slick(
            sliderConfig
        );

        if ("ontouchstart" in document.documentElement){
            $container.slick('slickPause');
        }
    }

}
