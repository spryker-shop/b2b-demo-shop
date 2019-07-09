import Component from 'ShopUi/models/component';

export default class FilterCategory extends Component {
    activeCategory: HTMLElement;
    categoriesToShow: HTMLElement[];

    constructor() {
        super();
        this.activeCategory = <HTMLElement>document.getElementsByClassName(`${this.jsName}__menu-item`)[0];

        const parent = this.activeCategory ? this.activeCategory : this;
        this.categoriesToShow = <HTMLElement[]>Array.from(parent.getElementsByClassName(
            this.categoriesToShowClassName
        ));
    }

    protected readyCallback(): void {
        if (this.activeCategory) {
            if (this.activeCategory.classList.contains(this.parentClassName)) {
                this.removeClass(this.categoriesToShow);
            } else {
                let target = <HTMLElement>this.activeCategory;
                while (!target.classList.contains(this.wrapClassName)) {
                    if (target.classList.contains(this.parentClassName)) {
                        this.removeClass(<HTMLElement[]>Array.from(
                            target.getElementsByClassName(this.categoriesToShowClassName)
                        ));

                        return;
                    }
                    target = <HTMLElement> target.parentNode;
                }
            }
        } else {
            this.removeClass(this.categoriesToShow);
        }
    }

    protected removeClass(categoriesToShow: HTMLElement[]): void {
        categoriesToShow.forEach((element: HTMLElement) => element.classList.remove(this.classToRemove));
    }

    protected get wrapClassName(): string {
        return this.getAttribute('wrap-class-name');
    }

    protected get parentClassName(): string {
        return this.getAttribute('parent-class-name');
    }

    protected get categoriesToShowClassName(): string {
        return this.getAttribute('categories-to-show-class-name');
    }

    protected get classToRemove(): string {
        return this.getAttribute('class-to-remove');
    }
}
