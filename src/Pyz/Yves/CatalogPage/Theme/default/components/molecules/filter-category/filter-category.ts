import Component from 'ShopUi/models/component';

export default class FilterCategory extends Component {
    protected activeCategory: HTMLElement;
    protected categoriesToShow: HTMLElement[];
    protected parent: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.activeCategory = <HTMLElement>document.getElementsByClassName(this.listSelector)[0];
        this.parent = this.activeCategory ? this.activeCategory : this;
        this.categoriesToShow = <HTMLElement[]>Array.from(
            this.parent.getElementsByClassName(this.categoriesToShowSelector));

        this.removeVisibilityClass();
    }

    protected removeVisibilityClass(): void {
        if (!this.activeCategory || this.activeCategory.classList.contains(this.parentSelector)) {
            this.removeClass(this.categoriesToShow);

            return;
        }

        this.removeVisibilityClasses();
    }

    protected removeVisibilityClasses(): void {
        let target = <HTMLElement>this.activeCategory;

        while (!target.classList.contains(this.wrapSelector)) {
            if (target.classList.contains(this.parentSelector)) {
                this.removeClass(<HTMLElement[]>Array.from(
                    target.getElementsByClassName(this.categoriesToShowSelector)
                ));

                return;
            }

            target = <HTMLElement>target.parentNode;
        }
    }

    protected removeClass(categoriesToShow: HTMLElement[]): void {
        categoriesToShow.forEach((element: HTMLElement) => element.classList.remove(this.classToRemove));
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
