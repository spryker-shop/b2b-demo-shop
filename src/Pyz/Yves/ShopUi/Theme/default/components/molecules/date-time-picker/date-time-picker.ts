import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'jquery-datetimepicker/build/jquery.datetimepicker.full';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;
    protected dateFrom: HTMLInputElement;
    protected dateTo: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = <HTMLInputElement>this.getElementsByTagName('input')[0];
        this.dateFrom = <HTMLInputElement>document.getElementById(this.dateFromSelector);
        this.dateTo = <HTMLInputElement>document.getElementById(this.dateToSelector);

        this.mapEvents();
    }

    protected mapEvents(): void {
        this.datetimepickerInit();
        this.setLanguage(this.language);
        this.setMaxDate();
        this.setMinDate();
    }

    protected datetimepickerInit(): void {
        if (this.formattedDateTime && $(this.trigger).val()) {
            $(this.trigger).val(this.formattedDateTime);
        }

        $(this.trigger).datetimepicker(this.config);
    }

    protected setLanguage(language: string): void {
        $.datetimepicker.setLocale(language);
    }

    protected setMaxDate(): void {
        const self = this;

        if (!this.dateFrom) {
            return;
        }

        $(this.dateFrom).datetimepicker({
            onShow() {
                this.setOptions({
                    maxDate: $(self.dateTo).val() ?? false,
                });
            },
        });
    }

    protected setMinDate(): void {
        const self = this;

        if (!this.dateTo) {
            return;
        }

        $(this.dateTo).datetimepicker({
            onShow() {
                this.setOptions({
                    minDate: $(self.dateFrom).val() ?? false,
                });
            },
        });
    }

    protected get parent(): string {
        return this.getAttribute('parent-id');
    }

    protected get language(): string {
        return this.getAttribute('language');
    }

    protected get config(): object {
        const config = JSON.parse(this.getAttribute('config'));
        config.parentID = this.parent;

        return config;
    }

    protected get formattedDateTime(): string {
        return this.getAttribute('formatted-date-time');
    }

    protected get dateFromSelector(): string {
        return this.getAttribute('date-from-selector');
    }

    protected get dateToSelector(): string {
        return this.getAttribute('date-to-selector');
    }
}
