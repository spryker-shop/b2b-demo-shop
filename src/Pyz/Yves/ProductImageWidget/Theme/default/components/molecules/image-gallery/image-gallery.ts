import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'slick-carousel';

export default class ImageGallery extends Component {
    readonly galleryItems: HTMLElement[]
    readonly quantityImages: number
    readonly activeClass: string
    readonly thumbnailSlider: $
    readonly thumbnailSliderConfig: object


    constructor() {
        super();
        this.galleryItems = <HTMLElement[]>Array.from(this.querySelectorAll(`.${this.jsName}__item`));
        this.quantityImages = this.galleryItems.length;
        this.activeClass = `${this.name}__item--active`;
        this.thumbnailSlider = $(`.${this.jsName}__thumbnails`);
        this.thumbnailSliderConfig = {
            'slidesToShow': 4,
            'slidesToScroll': 1,
            'infinite': false,
            'vertical': true,
            'prevArrow': '<dev class="thumb-prev"><svg class="icon"><use href="#:caret-down"></use></svg></div>',
            'nextArrow': '<dev class="thumb-next"><svg class="icon"><use href="#:caret-down"></use></svg></div>'
        }
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
        if(this.quantityImages > 1) {
            this.thumbnailSlider.slick(
                this.thumbnailSliderConfig
            );
        }
    }

    protected onThumbnailHover(event: Event): void {
        let slide = $(event.currentTarget),
            index = slide.data('slick-index');
        if(!slide.hasClass('slick-current')) {
            this.thumbnailSlider.find('.slick-slide').removeClass('slick-current');
            slide.addClass('slick-current');
            this.changeImage(index);
        }
    }

    protected onAfterChange(event: Event, slider: $): void {
        let index = slider.currentSlide;
        this.changeImage(index);
    }

    protected changeImage(activeItemIndex: number): void {
        this.galleryItems.forEach((galleryItem, index) => {
            if(galleryItem.classList.contains(this.activeClass) && activeItemIndex !== index){
                galleryItem.classList.remove(this.activeClass);
            }
            if(activeItemIndex === index) {
                galleryItem.classList.add(this.activeClass);
            }
        });
    }
}
