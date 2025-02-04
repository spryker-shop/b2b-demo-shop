import Component from 'ShopUi/models/component';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;
    protected dateFrom: HTMLInputElement;
    protected dateTo: HTMLInputElement;
    protected datePicker: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = this.querySelector<HTMLInputElement>('input[type="text"]');
        this.dateFrom = document.getElementById(this.dateFromId) as HTMLInputElement;
        this.dateTo = document.getElementById(this.dateToId) as HTMLInputElement;
        this.datePicker = this.querySelector<HTMLInputElement>(`.${this.jsName}__datepicker`);

        this.datePickerInit();
        this.mapEvents();
    }

    protected mapEvents(): void {
        if (this.dateTo) {
            this.dateTo.addEventListener('change', () => {
                this.setMaxDate();
            });
        }

        if (this.dateFrom) {
            this.dateFrom.addEventListener('change', () => {
                this.setMinDate();
            });
        }

        this.trigger.addEventListener('focus', () => {
            this.datePicker.showPicker();
        });

        this.trigger.addEventListener('click', () => {
            this.datePicker.showPicker();
        });

        this.datePicker.addEventListener('change', () => {
            this.trigger.value = this.datePicker.value;
        });

        this.trigger.addEventListener('change', () => {
            this.datePicker.value = this.trigger.value;
        });
    }

    protected datePickerInit(): void {
        if (this.formattedDateTime && this.trigger.value) {
            this.trigger.value = this.formattedDateTime;
        }

        this.datePicker.value = this.trigger.value;

        if (this.dateTo) {
            this.setMaxDate();
        }

        if (this.dateFrom) {
            this.setMinDate();
        }
    }

    protected setMaxDate(): void {
        const dateTo = document.getElementById(this.dateToId) as HTMLInputElement;
        this.datePicker.setAttribute('max', dateTo.value);
    }

    protected setMinDate(): void {
        const dateFrom = document.getElementById(this.dateFromId) as HTMLInputElement;
        this.datePicker.setAttribute('min', dateFrom.value);
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
