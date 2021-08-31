import Component from 'ShopUi/models/component';

export default class FilterCategory extends Component {
    protected activeCategory: HTMLElement;
    protected visibleCategories: HTMLElement[];
    protected parent: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.activeCategory = <HTMLElement>document.getElementsByClassName(this.activeCategoryClassName)[0];
        this.parent = this.activeCategory ? this.activeCategory : this;
        this.visibleCategories = <HTMLElement[]>(
            Array.from(this.parent.getElementsByClassName(this.visibleCategoryClass))
        );

        this.hideCategory();
    }

    protected hideCategory(): void {
        if (!this.activeCategory || this.activeCategory.classList.contains(this.parentClassName)) {
            this.removeClass(this.visibleCategories);

            return;
        }

        this.hideParentCategories();
    }

    protected hideParentCategories(): void {
        let target = <HTMLElement>this.activeCategory;

        while (!target.classList.contains(this.wrapperClassName)) {
            if (target.classList.contains(this.parentClassName)) {
                this.removeClass(<HTMLElement[]>Array.from(target.getElementsByClassName(this.visibleCategoryClass)));

                return;
            }

            target = <HTMLElement>target.parentNode;
        }
    }

    protected removeClass(categoriesToShow: HTMLElement[]): void {
        categoriesToShow.forEach((element: HTMLElement) => element.classList.remove(this.classToRemove));
    }

    protected get wrapperClassName(): string {
        return this.getAttribute('wrapper-class-name');
    }

    protected get parentClassName(): string {
        return this.getAttribute('parent-class-name');
    }

    protected get activeCategoryClassName(): string {
        return this.getAttribute('active-category-class-name');
    }

    protected get visibleCategoryClass(): string {
        return this.getAttribute('visible-category-class');
    }

    protected get classToRemove(): string {
        return this.getAttribute('class-to-remove');
    }
}
