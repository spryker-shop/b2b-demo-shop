import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class ImageGallery extends Component {
    readonly galleryItems: HTMLElement[];
    readonly quantityImages: number;
    readonly thumbnailSlider: $;

    constructor() {
        super();
        this.galleryItems = <HTMLElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__item`));
        this.quantityImages = this.galleryItems.length;
        this.thumbnailSlider = $(`.${this.jsName}__thumbnails`);
    }

    readyCallback(): void {
        this.initializationSlider();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.thumbnailSlider.on('mouseenter', '.slick-slide', (event: Event) => this.onThumbnailHover(event));
        this.thumbnailSlider.on('afterChange', (event: Event, slider: $) => this.onAfterChange(event, slider));
    }

    protected initializationSlider(): void {
        if (this.quantityImages > 1) {
            this.thumbnailSlider.slick(
                this.thumbnailSliderConfig
            );
        }
    }

    protected onThumbnailHover(event: Event): void {
        const slide = $(event.currentTarget);
        const index = slide.data('slick-index');

        if (!slide.hasClass('slick-current')) {
            this.thumbnailSlider.find('.slick-slide').removeClass('slick-current');
            slide.addClass('slick-current');
            this.changeImage(index);
        }
    }

    protected onAfterChange(event: Event, slider: $): void {
        const index = slider.currentSlide;
        this.changeImage(index);
    }

    protected changeImage(activeItemIndex: number): void {
        this.galleryItems.forEach((galleryItem, index) => {
            if (galleryItem.classList.contains(this.activeClass) && activeItemIndex !== index){
                galleryItem.classList.remove(this.activeClass);
            }
            if (activeItemIndex === index) {
                galleryItem.classList.add(this.activeClass);
            }
        });
    }

    protected get activeClass(): string {
        return this.getAttribute('active-class');
    }

    protected get thumbnailSliderConfig(): object {
        const sliderConfig: string = this.getAttribute('config-thumbnail-slider');

        return JSON.parse(sliderConfig);
    }
}
