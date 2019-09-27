import Component from 'ShopUi/models/component';

export default class TogglerClick extends Component {
    readonly triggers: HTMLElement[];
    readonly targets: HTMLElement[];
    isShowClasses: string = 'show-class';
    isHideClasses: string = 'hide-class';
    isContentOpened: boolean = false;

    constructor() {
        super();
        this.triggers = <HTMLElement[]>Array.from(document.querySelectorAll(this.triggerSelector));
        this.targets = <HTMLElement[]>Array.from(document.querySelectorAll(this.targetSelector));
    }

    protected readyCallback(): void {
        this.checkContentIsOpened();
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', (event: Event) => this.onTriggerClick(event));
        });

        document.addEventListener('click', (event: Event) => this.onDocumentClick(event));
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();

        this.toggle(event);
    }

    protected checkContentIsOpened(): void {
        if (this.onDocumentClickAction.length !== 0) {
            this.targets.forEach((target: HTMLElement) => {
                const isTargetActive = target.classList.contains(this.classToToggle);

                if (isTargetActive) {
                    this.isContentOpened = true;
                }
            });
        }
    }

    onDocumentClick(event: Event): void {
        if (this.onDocumentClickAction.length !== 0) {
            if (this.isContentOpened) {
                const eventTrigger = <HTMLElement>event.target;
                const isClosestTargetExist = !!eventTrigger.closest(this.targetSelector);
                const isClosestTriggerExist = !!eventTrigger.closest(this.triggerSelector);

                if (!isClosestTargetExist && !isClosestTriggerExist) {
                    if (this.onDocumentClickAction === this.isHideClasses) {
                        this.targets.forEach((target: HTMLElement) => {
                            target.classList.remove(this.classToToggle);
                        });

                        if (this.triggerClassToToggle.length !== 0) {
                            this.triggers.forEach((trigger: HTMLElement) => {
                                trigger.classList.remove(this.classToToggle);
                            });
                        }
                    }

                    if (this.onDocumentClickAction === this.isShowClasses) {
                        this.targets.forEach((target: HTMLElement) => {
                            target.classList.add(this.classToToggle);
                        });

                        if (this.triggerClassToToggle.length !== 0) {
                            this.triggers.forEach((trigger: HTMLElement) => {
                                trigger.classList.add(this.classToToggle);
                            });
                        }
                    }

                    this.isContentOpened = false;
                }
            }
        }
    }

    toggle(event: Event): void {
        this.onTriggerToggleClass(event);

        this.targets.forEach((target: HTMLElement) => {
            const addClass = !target.classList.contains(this.classToToggle);
            target.classList.toggle(this.classToToggle, addClass);

            this.isContentOpened = !this.isContentOpened;

            if (this.isFixBodyOnClick) {
                this.fixBody(addClass);
            }
        });
    }

    protected fixBody(isClassAddedFlag: boolean): void {
        const body = document.querySelector('body');

        if (!isClassAddedFlag) {
            const offset = window.pageYOffset;

            body.style.cssText = 'top:' + `${-offset}px`;
            body.classList.add(this.classToFixBody);
            body.dataset.scrollTo = offset.toString();
        } else {
            const scrollToVal = +body.dataset.scrollTo;

            body.style.cssText = 'top: 0;';
            body.classList.remove(this.classToFixBody);
            window.scrollTo(0, scrollToVal);
        }
    }

    protected onTriggerToggleClass(event: Event): void {
        if (this.triggerClassToToggle.length !== 0) {
            const triggerTarget = <HTMLElement>event.currentTarget;

            triggerTarget.classList.toggle(this.triggerClassToToggle);
        }
    }

    get triggerSelector(): string {
        return this.getAttribute('trigger-selector');
    }

    get targetSelector(): string {
        return this.getAttribute('target-selector');
    }

    get classToToggle(): string {
        return this.getAttribute('class-to-toggle');
    }

    get triggerClassToToggle(): string {
        return this.getAttribute('trigger-class-to-toggle');
    }

    get isFixBodyOnClick(): boolean {
        return this.checkedIsShouldFixBody === 'true';
    }

    get checkedIsShouldFixBody(): string {
        return this.getAttribute('fix-body');
    }

    get onDocumentClickAction(): string {
        return this.getAttribute('document-click');
    }

    get classToFixBody(): string {
        return this.getAttribute('class-to-fix-body');
    }
}
