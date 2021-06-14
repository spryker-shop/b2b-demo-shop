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

    protected readyCallback(): void {}

    protected init(): void {
        this.inputFile = <HTMLInputElement>document.getElementById(this.inputFileId);
        this.fileUploadMessage = <HTMLElement>this.getElementsByClassName(`${this.jsName}__file-select`)[0];
        this.uploadMessage = <string>this.fileUploadMessage.innerText;
        this.fileExtensionMessage = <HTMLElement>this.getElementsByClassName(`${this.jsName}__file-extension`)[0];
        this.removeIcon = <HTMLElement>this.getElementsByClassName(`${this.jsName}__remove-file`)[0];
        this.browseFileLabel = <HTMLLabelElement>this.getElementsByClassName(`${this.jsName}__browse-file`)[0];
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.inputFile.addEventListener('change', this.inputFileHandler.bind(this, this.inputFile));
        this.removeIcon.addEventListener('click', this.cleanInputFile.bind(this, this.removeIcon));
    }

    protected inputFileHandler(inputFile: HTMLInputElement): void {
        if (inputFile.files && inputFile.files.length > 0) {
            let filesName = '';
            Array.from(inputFile.files).forEach((file) => (filesName += file.name));
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
        this.browseFileLabel.setAttribute('for', this.inputFileId.substring(1));
    }

    protected toggleClassForIconExtensionMessage(): void {
        this.fileExtensionMessage.classList.toggle(this.hiddenClass);
        this.removeIcon.classList.toggle(this.hiddenClass);
        this.browseFileLabel.classList.toggle(this.browseFileLabelToggleClass);
    }

    protected get inputFileId(): string {
        return this.getAttribute('input-file-id');
    }
}
