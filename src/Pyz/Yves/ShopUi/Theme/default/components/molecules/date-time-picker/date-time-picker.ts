import Component from 'ShopUi/models/component';
import $ from 'jquery/dist/jquery';
import 'jquery-datetimepicker/build/jquery.datetimepicker.full';

export default class DateTimePicker extends Component {
    protected trigger: HTMLInputElement;

    protected readyCallback(): void {}

    protected init(): void {
        this.trigger = <HTMLInputElement>this.getElementsByTagName('input')[0];
        this.mapEvents();
    }

    protected mapEvents(): void {
        this.datetimepickerInit();
        this.setLanguage(this.language);
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
}
