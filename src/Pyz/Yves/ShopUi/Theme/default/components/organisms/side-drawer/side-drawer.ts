import Component from 'ShopUi/models/component';

export default class SideDrawer extends Component {
    protected triggers: HTMLElement[];
    protected containers: HTMLElement[];

    protected readyCallback(): void {}

    protected init(): void {
        this.triggers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.triggerClassName));
        this.containers = <HTMLElement[]>Array.from(document.getElementsByClassName(this.containerClassName));
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.triggers.forEach((trigger: HTMLElement) => {
            trigger.addEventListener('click', (event: Event) => this.onTriggerClick(event));
        });
    }

    protected onTriggerClick(event: Event): void {
        event.preventDefault();
        this.toggle();
    }

    toggle(): void {
        const isShown = !this.classList.contains(`${this.name}--show`);
        this.classList.toggle(`${this.name}--show`, isShown);
        this.containers.forEach((conatiner: HTMLElement) => {
            conatiner.classList.toggle(this.lockedBodyClassName, isShown);
        });
    }

    protected get triggerClassName(): string {
        return this.getAttribute('trigger-class-name');
    }

    protected get containerClassName(): string {
        return this.getAttribute('container-class-name');
    }

    protected get lockedBodyClassName(): string {
        return this.getAttribute('locked-body-class-name');
    }
}
