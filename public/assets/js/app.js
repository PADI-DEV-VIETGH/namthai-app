window.addEventListener("load", function () {
    app.hiddenLoading();
    let message_success = sessionStorage.getItem("message_success");
    if (message_success) {
        toast.success(message_success);
        sessionStorage.removeItem("message_success");
    }
});

const app = {
    showLoading: function () {
        $('body #global-loader').css({
            "display": "block"
        })
    },
    hiddenLoading: function () {
        $('body #global-loader').css({
            "display": "none"
        })
    }
};

const toast = {
    success: function (message = "") {
        toast.show('success', message)
    },
    error: function (message = "") {
        toast.show("error", message);
    },
    show: function (type = "", message = "") {
        let str = `
            <div class="padi_notice">
                <div
                    class="alert ${(() => {
            if (type === 'success') {
                return 'alert-success'
            }

            if (type === 'error') {
                return 'alert-danger'
            }
        })()}"
                    role="alert"
                >
                    <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>
                        ${(() => {
            if (type === 'success') {
                return 'Thành công!';
            }

            if (type === 'error') {
                return 'Lỗi!';
            }

            return "";
        })()}
                    </strong>
                    ${message}
                </div>
            </div>
        `;
        $('body').prepend(str);
        setTimeout(function () {
            toast.hidden();
        }, 3000)
    },
    hidden: function () {
        $.each($('body .padi_notice'), function (index, item) {
            $(item).remove();
        })
    }
};

$(document).ready(function () {
    $('form[name="formSubmit"]').submit(function (e) {
        // disable the submit button
        $('button[type="submit"]').attr('disabled', true);
        // submit the form
        return true;
    });

    $('body').on('change', 'form.custom-validate input:not(:disabled),textarea:not(:disabled),select:not(:disabled)', function () {
        let check_validate = [];
        check_validate.push($(this));
        validate.clearValidate($(this));

        if ($(this).prop('required')) {
            check_validate.push(validate.required($(this)));
        }

        if ($(this).prop('tagName') != 'TEXTAREA') {
            check_validate.push(validate.format($(this)));
        }

        check_validate.push(validate.regex($(this)));
        check_validate.push(validate.max_length($(this)));
        check_validate.push(validate.min_length($(this)));
        check_validate.push(validate.max($(this)));
        check_validate.push(validate.min($(this)));
    })

    $('body').on('click', '[data-action]', function (e) {
        e.preventDefault();
        if ($(this).attr('data-action') === "SUBMIT") {
            let form = $(this).parents('form')[0];
            if ($(form)) {
                app.showLoading();
                form_control.submit($(form))
                    .then((res) => {
                        if (res && res.url_redirect) {
                            window.location.href = res.url_redirect;
                            if (res && res.message_success) {
                                sessionStorage.setItem("message_success", res.message_success);
                            }
                        } else {
                            app.hiddenLoading();
                            if (res && res.message_success) {
                                toast.success(res.message_success);
                            }
                        }

                        $(form).find('[data-action="SUBMIT"]').trigger("FORM_SUBMIT_DONE", res)
                    })
                    .catch((err) => {
                        app.hiddenLoading();
                        if(!err.status){
                            err.status = 422;
                        }
                        $(form).find('[data-action="SUBMIT"]').trigger("FORM_SUBMIT_DONE", err)
                    });
            }
        }
    })

    $('body').on('click', function(event, params){
        if(event && event.target && $(event.target).parent('.customm-dropdown').length){
            $.each($('.customm-dropdown .customm-dropdown-menu'), function(index, item){
                $(item).css({
                    'display': 'none'
                })
            })

            let dropDownMenu = $(event.target).parent('.customm-dropdown').find('.customm-dropdown-menu');
            dropDownMenu.css({
                'display': 'block'
            });
        }else{
            $.each($('.customm-dropdown .customm-dropdown-menu'), function(index, item){
                if($(item).css('display') === 'block'){
                    $(item).css({
                        "display": "none"
                    })
                }

            })
        }
    })
});

const form_control = {
    'generate_ck_editor': function (list_ck_editor = null) {
        $.each(list_ck_editor, function (index, item) {
            let id = $(item).attr('id');
            if (CKEDITOR.instances[`${id}`]) {
                CKEDITOR.instances[`${id}`].destroy();
            }
            CKEDITOR.replace(`${id}`, {
                allowedContent: true,
                uiColor: '#EEEEEE',
                height: 200,
            });
        })
    },
    'submit': function (selector_form = null) {
        return new Promise((res, rej) => {
            validate.validate_form(selector_form)
                .then(() => {
                    let form_data = new FormData();
                    let form = selector_form;
                    let input_files = selector_form.find('input[type="file"]');
                    $.each(input_files, function (index, item) {
                        $.each($(item)[0].files, function (i, file) {
                            form_data.append(item.name, file);
                        })
                    });

                    let inputs = selector_form.serializeArray();

                    $.each(inputs, function (index, item) {
                        let selector_input = getSelectorInput(selector_form, item.name);
                        if (!selector_input.hasClass('cke_source')) {
                            let valueInput = item.value;
                            if (selector_input.prop('tagName') == 'TEXTAREA') {
                                let id = selector_input.attr('id');
                                if (id) {
                                    if (CKEDITOR.instances[`${id}`]) {
                                        valueInput = CKEDITOR.instances[`${id}`].getData();
                                    }
                                }
                            }
                            form_data.append(item.name, valueInput);
                        }
                    });
                    let url = selector_form.attr('action');
                    let method = selector_form.attr('method') ? selector_form.attr('method') : 'GET';
                    $.ajax({
                        url: url,
                        method: method,
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        dataType: 'json',
                        success: function (data, textStatus, jqXHR) {
                            return res(data);
                        },
                        error: function (error) {
                            return rej(error);
                        }
                    })

                })
                .catch((ex) => {
                    if (ex.selector && ex.selector.length) {
                        let selector_input = selector_form.find(ex.selector);
                        form_control.scrollToInputError($(selector_input));
                    }

                    return rej(ex);
                })
        })
    },
    'delete': function (selector_tag_delete = null) {
        return new Promise((res, rej) => {
            let src = selector_tag_delete.attr('data-src');
            $.ajax({
                url: src,
                type: 'DELETE',
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function (data, textStatus, jqXHR) {
                    res(data);
                },
                error: function (err) {
                    let message = error.responseJSON.message;
                    rej({
                        'message': message
                    });
                }
            });
        })
    },
    scrollToInputError: function (selector_input = null) {
        if (selector_input) {
            let row = selector_input.parents('.row')[0];
            let outerHeight = $(row).outerHeight();
            $('html, body').animate({
                scrollTop: $(selector_input).offset().top - outerHeight
            }, 500)
        }
    }
};

const validate = {
    'validate_form': function (selector_form = null) {
        return new Promise((res, rej) => {
            let inputs = selector_form.find('input:not(:disabled),textarea:not(:disabled),select:not(:disabled)');
            let check_validate = [];
            $.each(inputs, (index, item) => {
                if (!$(item).hasClass('cke_source')) {
                    validate.clearValidate($(item));

                    if ($(item).prop('required')) {
                        check_validate.push(validate.required($(item)));
                    }

                    if ($(item).prop('tagName') != 'TEXTAREA') {
                        check_validate.push(validate.format($(item)));
                    }

                    check_validate.push(validate.regex($(item)));
                    check_validate.push(validate.max_length($(item)));
                    check_validate.push(validate.min_length($(item)));
                    check_validate.push(validate.max($(item)));
                    check_validate.push(validate.min($(item)));
                }
            });

            if (check_validate.length) {
                Promise.all(check_validate)
                    .then(() => {
                        res();
                    })
                    .catch((ex) => {
                        rej(ex);
                    })
            } else {
                res();
            }
        });
    },
    'required': function (selector_input = null) {
        return new Promise((res, rej) => {
            let label = '';
            let value = '';
            let form_control = selector_input.parent('.form-group');
            if (!form_control.length) {
                form_control = $(selector_input.parents('.form-group')[0])
            }

            if (selector_input.attr('data-label')) {
                label = selector_input.attr('data-label');
            } else {
                label = form_control.find('label').text().toLowerCase();
                if (label) {
                    label = label.trim();
                    label.replace(/(\r\n|\n|\r)/gm, "");
                }
            }

            value = selector_input.val();

            if (typeof value === 'string' || value instanceof String) {
                value = value.replace(/\s/g, '');
            }

            if ((Array.isArray(value) && value.length) || (!Array.isArray(value) && value)) {
                return res({
                    "selector": selector_input
                });
            } else {
                let msg = trans(message.required, {"attribute": label});
                validate.addMsgErr(selector_input, msg);

                return rej({
                    "message": msg,
                    "selector": selector_input,
                    "validate_type": "required"
                });

            }
        })
    },
    'format': function (selector_input = null) {
        return new Promise((res, rej) => {
            let type = selector_input.attr('type');
            let label = '';

            let form_control = selector_input.parent('.form-group');
            if (!form_control.length) {
                form_control = $(selector_input.parents('.form-group')[0])
            }

            if (selector_input.attr('data-label')) {
                label = selector_input.attr('data-label');
            } else {
                label = form_control.find('label').text().toLowerCase();
                if (label) {
                    label = label.trim();
                    label.replace(/(\r\n|\n|\r)/gm, "");
                }
            }

            let value = selector_input.val();

            switch (type) {
                case 'email':
                    if (!validate.email(value)) {
                        let msg = trans(message.invalid, {"attribute": label});
                        validate.addMsgErr(selector_input, msg);

                        return rej({
                            "message": msg,
                            "selector": selector_input,
                            "validate_type": "email"
                        });
                    }
                    break;
                case 'phone_number':
                    if (!validate.phone_number(value.trim())) {
                        let msg = trans(message.invalid, {"attribute": label});
                        validate.addMsgErr(selector_input, msg);

                        return rej({
                            "message": msg,
                            "selector": selector_input,
                            "validate_type": "phone_number"
                        });
                    }
                    break;
            }

            return res({
                "selector": selector_input,
            });
        })
    },
    'max_length': function (selector_input = null) {
        return new Promise((res, rej) => {
            if (selector_input && selector_input.attr('max-length')) {
                let label = '';
                let form_control = selector_input.parent('.form-group');
                if (!form_control.length) {
                    form_control = $(selector_input.parents('.form-group')[0])
                }

                if (selector_input.attr('data-label')) {
                    label = selector_input.attr('data-label');
                } else {
                    label = form_control.find('label').text().toLowerCase();
                    if (label) {
                        label = label.trim();
                        label.replace(/(\r\n|\n|\r)/gm, "");
                    }
                }

                let value = selector_input.val();
                let max_length = parseInt(selector_input.attr('max-length'));
                if (selector_input.attr('data-type') == 'money') {
                    value = value.replace(/,/g, '');
                }

                if (value && value.trim().length > max_length) {
                    let msg = trans(message.max.string, {
                        "attribute": label,
                        "max": max_length
                    });
                    validate.addMsgErr(selector_input, msg);

                    rej({
                        "message": msg,
                        "selector": selector_input,
                        "validate_type": "max_length"
                    })
                } else {
                    res();
                }
            } else {
                res();
            }
        })
    },
    'min_length': function (selector_input = null) {
        return new Promise((res, rej) => {
            if (selector_input && selector_input.attr('min-length')) {
                let label = '';
                let form_control = selector_input.parent('.form-group');
                if (!form_control.length) {
                    form_control = $(selector_input.parents('.form-group')[0])
                }

                if (selector_input.attr('data-label')) {
                    label = selector_input.attr('data-label');
                } else {
                    label = form_control.find('label').text().toLowerCase();
                    if (label) {
                        label = label.trim();
                        label.replace(/(\r\n|\n|\r)/gm, "");
                    }
                }

                let value = selector_input.val();
                let min_length = parseInt(selector_input.attr('min-length'));
                if (value && value.trim().length < min_length) {
                    let msg = trans(message.min.string, {
                        "attribute": label,
                        "min": min_length
                    });
                    validate.addMsgErr(selector_input, msg);
                    return rej({
                        "message": msg,
                        "selector": selector_input,
                        "validate_type": "min_length"
                    })
                } else {
                    return res();
                }
            } else {
                return res();
            }
        })
    },
    'max': function (selector_input = null) {
        return new Promise((res, rej) => {
            if (selector_input && selector_input.attr('max')) {
                let label = '';
                let form_control = selector_input.parent('.form-group');
                if (!form_control.length) {
                    form_control = $(selector_input.parents('.form-group')[0])
                }

                if (selector_input.attr('data-label')) {
                    label = selector_input.attr('data-label');
                } else {
                    label = form_control.find('label').text().toLowerCase();
                    if (label) {
                        label = label.trim();
                        label.replace(/(\r\n|\n|\r)/gm, "");
                    }
                }

                let value = selector_input.val();
                let max = parseInt(selector_input.attr('max'));

                if (value && value > max) {
                    let msg = trans(message.max_unit, {
                        "attribute": label,
                        "max": max
                    });
                    validate.addMsgErr(selector_input, msg);

                    rej({
                        "message": msg,
                        "selector": selector_input,
                        "validate_type": "max"
                    })
                } else {
                    res();
                }
            } else {
                res();
            }
        })
    },
    'min': function (selector_input = null) {
        return new Promise((res, rej) => {
            if (selector_input && selector_input.attr('min')) {
                let label = '';
                let form_control = selector_input.parent('.form-group');
                if (!form_control.length) {
                    form_control = $(selector_input.parents('.form-group')[0])
                }

                if (selector_input.attr('data-label')) {
                    label = selector_input.attr('data-label');
                } else {
                    label = form_control.find('label').text().toLowerCase();
                    if (label) {
                        label = label.trim();
                        label.replace(/(\r\n|\n|\r)/gm, "");
                    }
                }

                let value = selector_input.val();
                let min = parseInt(selector_input.attr('min'));
                if (value && value < min) {
                    let msg = trans(message.min_unit, {
                        "attribute": label,
                        "min": min
                    });
                    validate.addMsgErr(selector_input, msg);
                    return rej({
                        "message": msg,
                        "selector": selector_input,
                        "validate_type": "min"
                    })
                } else {
                    return res();
                }
            } else {
                return res();
            }
        })
    },
    'regex': function (selector_input = null) {
        return new Promise((res, rej) => {
            if (selector_input && selector_input.attr('regex')) {
                let label = '';
                let value = '';
                let form_control = selector_input.parent('.form-group');
                if (!form_control.length) {
                    form_control = $(selector_input.parents('.form-group')[0])
                }

                if (selector_input.attr('data-label')) {
                    label = selector_input.attr('data-label');
                } else {
                    label = form_control.find('label').text().toLowerCase();
                    if (label) {
                        label = label.trim();
                        label.replace(/(\r\n|\n|\r)/gm, "");
                    }
                }

                value = selector_input.val();
                if (value) {
                    let str_regex = selector_input.attr('regex');
                    let re = new RegExp(str_regex);
                    if (re.test(value.trim())) {
                        return res();
                    } else {
                        let msg = trans(message.invalid, {"attribute": label});
                        validate.addMsgErr(selector_input, msg);
                        return rej({
                            "message": msg,
                            "selector": selector_input,
                            "validate_type": "regex"
                        });
                    }
                } else {
                    return res();
                }

            } else {
                return res();
            }
        });
    },
    'email': function (email = "") {
        if (email) {
            const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(String(email).toLowerCase());
        }
        return true;
    },
    'phone_number': function (phone_number = "") {
        if (phone_number) {
            let arrHeadPhoneNumber = [
                '086', '096', '097', '098', '032', '033', '034', '035', '036', '037', '038', '039',
                '089', '090', '093', '070', '079', '077', '076', '078',
                '088', '091', '094', '083', '084', '085', '081', '082',
                '092', '056', '058',
                '099', '059',
                '095'
            ];

            let headPhoneNumber = phone_number.substring(0, 3);
            return arrHeadPhoneNumber.includes(headPhoneNumber) && /^([0-9]{10,11})$/.test(phone_number.trim());
        }
        return true;
    },
    'clearValidate': function (selector_input = null) {
        let form_control = selector_input.parent('.form-group');
        if (!form_control.length) {
            form_control = $(selector_input.parents('.form-group')[0])
        }

        selector_input.removeClass('is-invalid');
        form_control.find('.invalid-feedback').remove();

    },
    'addMsgErr': function (selector_input = null, msg = '') {
        let form_control = selector_input.parent('.form-group');
        if (!form_control.length) {
            form_control = $(selector_input.parents('.form-group')[0])
        }

        $(form_control).ready(function () {
            if (form_control.find('.invalid-feedback').length === 0) {
                $(form_control).append(function (index, html) {
                    return `<div class="invalid-feedback" style="display: block">${msg}</div>`;
                })
            }

        });
    }
};

function getSelectorInput(selector_form = null, nameInput = "") {
    let selectorQuery = 'input[name="' + nameInput + '"],';
    selectorQuery += 'select[name="' + nameInput + '"],';
    selectorQuery += 'textarea[name="' + nameInput + '"]';
    let input = selector_form.find(selectorQuery);
    return input;
}

function trans(pattr = "", obj_param = null) {
    let str = pattr;
    if (obj_param) {
        for (let key in obj_param) {
            let regex = new RegExp(`:${key}`, 'ig');
            str = str.replaceAll(regex, obj_param[`${key}`]);
        }
    }
    return str;
}

function capitalizeFirstLetter(str = "") {
    if (str) {
        return str.charAt(0).toUpperCase() + str.slice(1);
    } else {
        return "";
    }
}

const cartessian = (arr1 = [], arr2 = []) => {
    if (arr1.length && arr2.length) {
        let rs = [];
        for (let i = 0; i < arr1.length; i++) {
            for (let j = 0; j < arr2.length; j++) {
                if (Array.isArray(arr1[i])) {
                    rs.push([...arr1[i], arr2[j]]);
                } else {
                    rs.push([arr1[i], arr2[j]]);
                }
            }
        }

        return rs;
    }

    if (arr1.length) {
        return arr1;
    }

    if (arr2.length) {
        return arr2;
    }

    return [];
};

const currency = (selector) => {
    selector.keypress(function (event) {
        if ((event.which < 48 || event.which > 58)) {
            event.preventDefault();
            return false;
        }
    });

    selector.keyup(function () {
        selector.formatCurrency();
    });

    selector.blur(function () {
        selector.formatCurrency();
    });

};

function limitWords(str = "", limit = 10) {
    if (str) {
        let newStr = removeAscent(str);

        if (!newStr.match(/\w+/g)) {
            return str;
        }
        let wordCount = newStr.match(/\w+/g).length;
        let re = new RegExp(`((\\w+\\W*){${limit -1}}(\\w+))`)
        let rs = newStr.match(re);
        if (wordCount > limit) {
            let length = rs[0].length;
            return str.substring(0, length) + '...';
        } else {
            return str;
        }
    } else {
        return "";
    }
}

function removeAscent(str = "") {
    if (str) {
        str = str.toLowerCase();
        str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
        str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
        str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
        str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
        str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
        str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
        str = str.replace(/đ/g, "d");
        return str;
    } else {
        return '';
    }
}

function setCookie(cname, cvalue, exdays = 1) {
    const d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    let expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

(function ($) {
    let page = 1;
    let isLoadMore = false;
    let isLoading = false;
    let oldSearchValue = "";
    let url = '';
    let method = 'GET';
    let length = 10;
    let searchValue = "";
    let input_selector = null;
    let notResult = false;
    let fnParams = null

    var getDataAutocomplete = () => {
        return new Promise((res, rej) => {
            let searchValue = input_selector.val();
            if (searchValue != oldSearchValue) {
                page = 1;
            }

            let data = {
                page: page,
                length: length,
                term: searchValue
            }
            let params = fnParams();
            if (params) {
                data = {
                    ...data,
                    ...params
                }
            }

            $.ajax({
                url: url,
                dataType: 'json',
                type: method,
                data: data,
                beforeSend: function () {
                    oldSearchValue = searchValue;
                    isLoading = true;
                    input_selector.parent('.form-group').find('img').css({
                        "display": "block"
                    })
                },
                success: function (data) {
                    isLoadMore = data.pagination && data.pagination.more ? data.pagination.more : false;
                    return res(data.results);
                },
                complete: function () {
                    isLoading = false;
                    input_selector.parent('.form-group').find('img').css({
                        "display": "none"
                    })
                },
                error: function () {
                    return rej();
                }

            })
        })
    }

    var isScrollbarBottom = (selector_container = null) => {
        let height = selector_container.outerHeight();
        let scrollHeight = selector_container[0].scrollHeight;
        let scrollTop = selector_container.scrollTop();
        if (scrollTop >= (scrollHeight - height + 5)) {
            return true;
        }
        return false;
    }

    $.ui.autocomplete.prototype._scrollMenu = function (ul) {
        var that = this;
        $(ul).find('tbody').scroll(function () {
            if (isScrollbarBottom($(this)) && isLoadMore && !isLoading) {
                page = page + 1;
                getDataAutocomplete()
                    .then((data) => {
                        $.each(data, function (index, item) {
                            that._renderItemData(ul.find('table tbody'), item);
                        });
                    })
            }
        })
    }

    $.fn.customAutocompleteTable = function (customConfig = null) {
        input_selector = this;
        if (input_selector.attr('data-url')) {
            url = input_selector.attr('data-url');
        }

        if (input_selector.attr('data-method')) {
            method = input_selector.attr('data-method');
        }

        if (input_selector.attr('data-length')) {
            length = parseInt(input_selector.attr('data-length'));
        }

        if (customConfig.params) {
            fnParams = customConfig.params;
        }

        let autocompleteEmployee = input_selector.autocomplete({
            classes: {
                "ui-autocomplete": "custom-container-autocomlete-table"
            },
            source: function (req, res) {
                getDataAutocomplete()
                    .then((data) => {
                        res(data);
                    })
            },
            minLength: 2,
            open: function (event, ui) {
                input_selector.autocomplete("widget").find('table').removeClass('ui-menu-item');
            },
            close: function (event, ui) {
                if (notResult) {
                    let ul = $(this).autocomplete("widget");
                    ul.show();
                    notResult = false;
                }

                page = 1;
                isLoadMore = false;
                isLoading = false;
            },
            select: function (event, el) {
                input_selector.trigger('custom_autocomplete_selected', el)
            },
            response: function (event, ui) {
                if (!(ui && ui.content && ui.content.length)) {
                    let withDropDown = 750;
                    if (input_selector.attr('data-dropdown-with')) {
                        withDropDown = input_selector.attr('data-dropdown-with');
                    }

                    let ul = $(this).autocomplete("widget");
                    ul.hide();
                    ul.html('').promise().done(function () {
                        let heightBody = $('body').height();
                        let topDropDown = input_selector.offset().top;
                        let height = input_selector.outerHeight();
                        let left = input_selector.offset().left;

                        ul.append(`
                            <table class="table table-hover">
                                <thead>
                                    ${
                            (() => {
                                return customConfig.renderHeader()
                            })()
                        }
                                </thead>
                                <tbody>
                                    ${
                            (() => {
                                return customConfig.noResult()
                            })()
                        }
                                </tbody>
                            </table>
                        `)

                        ul.css({
                            width: withDropDown + 'px',
                            position: 'relative',
                            top: -(heightBody - topDropDown - height) + 'px',
                            left: left + 'px',
                            display: 'block'
                        });

                        let mesage = input_selector.autocomplete("instance").liveRegion;
                        mesage.remove();

                        notResult = true;
                    });
                }
            },
            messages: {
                noResults: '',
                results: function (amount) {
                    return '';
                }
            }
        });

        autocompleteEmployee.data('ui-autocomplete')._renderItem = function (ul, item) {
            let row = customConfig.renderItem(item);
            return $(`${row}`).appendTo(ul);
        }

        autocompleteEmployee.data('ui-autocomplete')._renderMenu = function (ul, items) {
            var that = this;
            ul.append(`
                    <table class="table table-hover">
                        <thead>
                            ${
                (() => {
                    return customConfig.renderHeader()
                })()
            }
                        </thead>
                        <tbody></tbody>
                    </table>
                `);

            $.each(items, function (index, item) {
                that._renderItemData(ul.find('table tbody'), item);
            });
            that._scrollMenu($(ul))
        }

        autocompleteEmployee.data('ui-autocomplete')._resizeMenu = function (ul, item) {
            let withDropDown = 750;
            if (input_selector.attr('data-dropdown-with')) {
                withDropDown = input_selector.attr('data-dropdown-with');
            }
            this.menu.element.outerWidth(withDropDown);
        }
    }
}(jQuery));
