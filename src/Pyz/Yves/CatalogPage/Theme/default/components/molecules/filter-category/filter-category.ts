import Component from 'ShopUi/models/component';

export default class FilterCategory extends Component {
    readonly activeCategory: HTMLElement;
    categoriesToShow: HTMLElement[];

    constructor() {
        super();
        this.activeCategory = <HTMLElement>document.querySelector(this.listSelector);

        const parent = this.activeCategory ? this.activeCategory : this;
        this.categoriesToShow = <HTMLElement[]>Array.from(parent.querySelectorAll(this.categoriesToShowSelector));
    }

    protected readyCallback(): void {

        if (this.activeCategory) {
            if (this.activeCategory.classList.contains(this.parentSelector)) {
                this.removeClass(this.categoriesToShow);
            } else {
                let target = <HTMLElement> this.activeCategory;
                while (!target.classList.contains(this.wrapSelector)) {
                    if (target.classList.contains(this.parentSelector)) {
                        this.removeClass(<HTMLElement[]>Array.from(target.querySelectorAll(this.categoriesToShowSelector)));
                        return;
                    }
                    target = <HTMLElement> target.parentNode;
                }
            }
        } else {
            this.removeClass(this.categoriesToShow);
        }
    }

    protected removeClass(categoriesToShow): void {
        for (let i = 0; i <= categoriesToShow.length - 1; i++) {
            categoriesToShow[i].classList.remove(this.classToRemove);
        }
    }

    get wrapSelector(): string {
        return this.getAttribute('wrap-selector');
    }

    get parentSelector(): string {
        return this.getAttribute('parent-selector');
    }

    get listSelector(): string {
        return this.getAttribute('list-selector');
    }

    get categoriesToShowSelector(): string {
        return this.getAttribute('category-selector');
    }

    get classToRemove(): string {
        return this.getAttribute('change-class');
    }
}