import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class ImageGallery extends Component {
    protected galleryItems: HTMLElement[];
    protected thumbnailSlider: $;
    protected defaultImageUrl: string;
    protected currentSlideImage: HTMLImageElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.galleryItems = <HTMLElement[]>Array.from(this.getElementsByClassName(`${this.jsName}__item`));
        this.thumbnailSlider = $(`.${this.jsName}__thumbnails`);

        this.initializationSlider();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.thumbnailSlider.on('mouseenter', '.slick-slide', (event: Event) => this.onThumbnailHover(event));
        this.thumbnailSlider.on('afterChange', (event: Event, slider: $) => this.onAfterChange(event, slider));
    }

    protected initializationSlider(): void {
        const imagesQuantity = this.galleryItems.length;

        if (!imagesQuantity) {
            return;
        }

        if (imagesQuantity > 1) {
            this.thumbnailSlider.slick(this.thumbnailSliderConfig);
        }

        this.getCurrentSlideImage();
        this.setDefaultImageUrl();
    }

    protected onThumbnailHover(event: Event): void {
        const slide = $(event.currentTarget);
        const index = slide.data('slick-index');

        if (!slide.hasClass('slick-current')) {
            this.thumbnailSlider.find('.slick-slide').removeClass('slick-current');
            slide.addClass('slick-current');
            this.changeImage(index);
            this.getCurrentSlideImage();
            this.setDefaultImageUrl();
        }
    }

    protected onAfterChange(event: Event, slider: $): void {
        const index = slider.currentSlide;
        this.changeImage(index);
    }

    protected changeImage(activeItemIndex: number): void {
        this.galleryItems.forEach((galleryItem, index) => {
            if (galleryItem.classList.contains(this.activeClass) && activeItemIndex !== index) {
                galleryItem.classList.remove(this.activeClass);
            }
            if (activeItemIndex === index) {
                galleryItem.classList.add(this.activeClass);
            }
        });
    }

    set slideImageUrl(url: string) {
        this.currentSlideImage.src = url;
    }

    restoreDefaultImageUrl(): void {
        this.currentSlideImage.src = this.defaultImageUrl;
    }

    protected getCurrentSlideImage(): void {
        const currentSlide = this.galleryItems.filter((element: HTMLElement) =>
            element.classList.contains(this.activeClass),
        )[0];
        this.currentSlideImage = currentSlide.getElementsByTagName('img')[0];
    }

    protected setDefaultImageUrl(): void {
        this.defaultImageUrl = this.currentSlideImage.src;
    }

    protected get activeClass(): string {
        return this.getAttribute('active-class');
    }

    protected get thumbnailSliderConfig(): object {
        const sliderConfig: string = this.getAttribute('config-thumbnail-slider');

        return JSON.parse(sliderConfig);
    }
}
