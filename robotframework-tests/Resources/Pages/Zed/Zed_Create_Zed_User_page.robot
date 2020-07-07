*** Settings ***
Library    SeleniumLibrary    plugins=SeleniumTestability;True;30 Seconds;True

*** Variables ***
${zed_user_email_field}    id=user_username
${zed_user_password_filed}    id=user_password_first
${zed_user_repeat_password_field}    id=user_password_second
${zed_user_first_name_field}    id=user_first_name
${zed_user_last_name_field}    id=user_last_name
${zed_user_interface_language}    id=user_fk_locale
