import Component from 'ShopUi/models/component';
import CustomSelect from '../custom-select/custom-select';
import { mount } from 'ShopUi/app';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class SlickCarousel extends Component {
    protected slider: HTMLElement;
    protected customSelects: CustomSelect[];

    protected readyCallback(): void {}

    protected init(): void {
        this.slider = <HTMLElement>this.getElementsByClassName(`${this.jsName}__container`)[0];
        if (this.customSelectClassName) {
            this.customSelects = <CustomSelect[]>Array.from(this.getElementsByClassName(this.customSelectClassName));
        }

        this.mapEvents();
        this.sliderInit();
    }

    protected mapEvents(): void {
        $(this.slider).on('init', async() => {
            this.showSlider();
            await mount();
        });
    }

    protected showSlider(): void {
        this.slider.classList.add(`${this.name}__container--is-inited`);
    }

    protected sliderInit(): void {
        $(this.slider).on('init', () => {
            if (this.customSelects) {
                this.customSelects.forEach((select: CustomSelect) => {
                    select.initSelect();
                    select.changeSelectEvent();
                });
            }
        });

        $(this.slider).slick(
            this.sliderConfig
        );
    }

    protected get sliderConfig(): object {
        return JSON.parse(this.getAttribute('slider-config'));
    }

    protected get customSelectClassName(): string {
        return this.getAttribute('custom-select-class-name');
    }
}
