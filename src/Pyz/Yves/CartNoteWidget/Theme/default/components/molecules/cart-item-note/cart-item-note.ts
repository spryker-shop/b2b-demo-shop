import Component from 'ShopUi/models/component';

export default class CartItemNote extends Component {
    readonly editButton: HTMLElement;
    readonly removeButton: HTMLElement;
    readonly formTarget: HTMLElement;
    readonly textTarget: HTMLElement;

    constructor() {
        super();
        this.editButton = <HTMLElement>this.querySelector(this.editButtonSelector);
        this.removeButton = <HTMLElement>this.querySelector(this.removeButtonSelector);
        this.formTarget = <HTMLElement>this.querySelector(this.formSelector);
        this.textTarget = <HTMLElement>this.querySelector(this.textTargetSelector);
    }

    protected readyCallback(): void {
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.addEventListener('click', (event: Event) => this.onTriggerClick(event));
    }

    protected onTriggerClick(event: Event): void {
        let target = <any> event.target;
        while (target != this) {
            if (target === this.editButton) {
                event.preventDefault();
                this.classToggle(this.formTarget);
                this.classToggle(this.textTarget);
                return;
            }
            if (target === this.removeButton) {
                event.preventDefault();
                const form = <HTMLFormElement>this.formTarget.querySelector('form');
                const textarea = <HTMLTextAreaElement>form.querySelector('textarea');
                textarea.value = null;
                form.submit();
                return;
            }
            target = target.parentNode;
        }
    }

    protected classToggle(activeTrigger: HTMLElement): void {
        const isTriggerActive = activeTrigger.classList.contains(this.classToToggle);
        activeTrigger.classList.toggle(this.classToToggle, !isTriggerActive);
    }

    get editButtonSelector(): string {
        return this.getAttribute('edit-button-selector');
    }

    get removeButtonSelector(): string {
        return this.getAttribute('remove-button-selector');
    }

    get textTargetSelector(): string {
        return this.getAttribute('read-section-selector');
    }

    get formSelector(): string {
        return this.getAttribute('form-selector');
    }

    get classToToggle(): string {
        return this.getAttribute('change-class');
    }
}