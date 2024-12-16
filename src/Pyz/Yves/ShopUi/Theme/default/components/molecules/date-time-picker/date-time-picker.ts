import Component from 'ShopUi/models/component';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;
    protected dateFrom: HTMLInputElement;
    protected dateTo: HTMLInputElement;
    protected datepicker: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = <HTMLInputElement>this.querySelector('input[type="text"]');
        this.dateFrom = <HTMLInputElement>document.getElementById(this.dateFromId);
        this.dateTo = <HTMLInputElement>document.getElementById(this.dateToId);
        this.datepicker = <HTMLInputElement>this.querySelector(`.${this.jsName}__datepicker`);
        this.datepicker.value = this.trigger.value;

        this.datetimepickerInit();
        this.mapEvents();
    }

    protected mapEvents(): void {
        if (this.dateTo) {
            this.setMaxDate();
            this.dateTo.addEventListener('change', () => this.setMaxDate());
        }
        if (this.dateFrom) {
            this.setMinDate();
            this.dateFrom.addEventListener('change', () => this.setMinDate());
        }

        this.trigger.addEventListener('focus', () => {
            this.datepicker.showPicker();
        });

        this.trigger.addEventListener('click', () => {
            this.datepicker.showPicker();
        });

        this.datepicker.addEventListener('change', () => {
            this.trigger.value = this.datepicker.value;
        });

        this.trigger.addEventListener('change', () => {
            this.datepicker.value = this.trigger.value;
        });
    }

    protected datetimepickerInit(): void {
        if (this.formattedDateTime && this.trigger.value) {
            this.trigger.value = this.formattedDateTime;
        }
    }

    protected setMaxDate(): void {
        const dateTo = document.getElementById(this.dateToId) as HTMLInputElement;
        this.datepicker.setAttribute('max', dateTo.value);
    }

    protected setMinDate(): void {
        const dateFrom = document.getElementById(this.dateFromId) as HTMLInputElement;
        this.datepicker.setAttribute('min', dateFrom.value);
    }

    protected get parent(): string {
        return this.getAttribute('parent-id');
    }

    protected get formattedDateTime(): string {
        return this.getAttribute('formatted-date-time');
    }

    protected get dateFromId(): string {
        return this.getAttribute('date-from-id');
    }

    protected get dateToId(): string {
        return this.getAttribute('date-to-id');
    }
}
