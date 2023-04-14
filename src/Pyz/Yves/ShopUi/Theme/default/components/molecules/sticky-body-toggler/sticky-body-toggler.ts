import Component from 'ShopUi/models/component';

export default class StickyBodyToggler extends Component {
    protected triggers: HTMLElement[];
    protected body: HTMLElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.body = <HTMLElement>document.body;
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', () => this.toggleStickyBody());
        });
    }

    protected toggleStickyBody(): void {
        const isBodySticky = this.body.classList.contains(this.classToFixBody);

        if (isBodySticky) {
            const scrollToVal = parseInt(this.body.dataset.scrollTo);

            this.body.style.top = '0';
            this.body.classList.remove(this.classToFixBody);
            window.scrollTo(0, scrollToVal);

            return;
        }

        const offset = window.scrollY;

        this.body.style.top = `${-offset}px`;
        this.body.classList.add(this.classToFixBody);
        this.body.dataset.scrollTo = offset.toString();
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get classToFixBody(): string {
        return this.getAttribute('class-to-fix-body');
    }
}
