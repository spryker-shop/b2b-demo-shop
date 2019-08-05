import Component from 'ShopUi/models/component';

export default class QuickOrderFileUpload extends Component {
    protected inputFile: HTMLInputElement;
    protected fileUploadMessage: HTMLElement;
    protected fileExtensionMessage: HTMLElement;
    protected removeIcon: HTMLElement;
    protected browseFileLabel: HTMLLabelElement;
    protected uploadMessage: string;
    protected readonly hiddenClass: string = 'is-hidden';
    protected readonly browseFileLabelToggleClass: string = 'label--browse-file-cursor-default';

    protected readyCallback(): void {
        this.inputFile = <HTMLInputElement>this.querySelector(this.inputFileAttribute);
        this.fileUploadMessage = <HTMLElement>this.querySelector(`.${this.jsName}__file-select`);
        this.uploadMessage = <string>this.fileUploadMessage.innerText;
        this.fileExtensionMessage = <HTMLElement>this.querySelector(`.${this.jsName}__file-extension`);
        this.removeIcon = <HTMLElement>this.querySelector(`.${this.jsName}__remove-file`);
        this.browseFileLabel = <HTMLLabelElement>this.querySelector(`.${this.jsName}__browse-file`);
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.inputFile.addEventListener('change', this.inputFileHandler.bind(this, this.inputFile));
        this.removeIcon.addEventListener('click', this.cleanInputFile.bind(this, this.removeIcon));
    }

    protected inputFileHandler(inputFile: HTMLInputElement): void {
        if (inputFile.files && inputFile.files.length > 0) {
            let filesName = '';
            Array.from(inputFile.files).forEach(file => filesName += file.name);
            this.fileUploadMessage.innerText = filesName;
            this.toggleClassForIconExtensionMessage();
            this.browseFileLabel.removeAttribute('for');
        }
    }

    protected cleanInputFile(removeIcon: HTMLElement, event: Event): void {
        event.preventDefault();
        this.inputFile.value = '';
        this.fileUploadMessage.innerText = this.uploadMessage;
        this.toggleClassForIconExtensionMessage();
        this.browseFileLabel.setAttribute('for', this.inputFileAttribute.substring(1));
    }

    protected toggleClassForIconExtensionMessage(): void {
        this.fileExtensionMessage.classList.toggle(this.hiddenClass);
        this.removeIcon.classList.toggle(this.hiddenClass);
        this.browseFileLabel.classList.toggle(this.browseFileLabelToggleClass);
    }

    get inputFileAttribute(): string {
        return this.getAttribute('input-file');
    }
}
