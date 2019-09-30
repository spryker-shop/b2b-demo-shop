import Component from 'ShopUi/models/component';

export default class TogglerBodyHeightLimiter extends Component {
    protected triggers: HTMLElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', () => this.toggleBodyHeightFix());
        });
    }

    protected toggleBodyHeightFix(): void {
        const classAddedFlag = document.body.classList.contains(this.classToFixBody);

        this.fixBody(classAddedFlag);
    }

    protected fixBody(isClassAddedFlag: boolean): void {
        const body = document.body;

        if (isClassAddedFlag) {
            const scrollToVal = parseInt(body.dataset.scrollTo);

            body.style.top = '0';
            body.classList.remove(this.classToFixBody);
            window.scrollTo(0, scrollToVal);
        }

        if (!isClassAddedFlag) {
            const offset = window.pageYOffset;

            body.style.top = `${-offset}px`;
            body.classList.add(this.classToFixBody);
            body.dataset.scrollTo = offset.toString();
        }
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get classToFixBody(): string {
        return this.getAttribute('class-to-fix-body');
    }
}
