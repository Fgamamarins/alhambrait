@extends('layouts.steps')

@section('content')
    <div class="row">
        @csrf
        <div class="col-md-6 col-md-offset-3">
            <form id="msform">
                <!-- progressbar -->
                <ul id="progressbar">
                    <li class="active">Informações Pessoais</li>
                    <li>Endereço</li>
                    <li>Contato</li>
                </ul>
                <!-- fieldsets -->
                <fieldset id="step1">
                    <h2 class="fs-title">Informações Pessoais</h2>
                    <h3 class="fs-subtitle">Conte-nos um pouco sobre você</h3>
                    <div>
                        <x-input maxlength="50" onkeypress="return /[a-z, ]/i.test(event.key)" id="full_name" class="block mt-1 w-full" type="text" name="full_name" :value="old('full_name') ?? $lead->full_name ?? ''" placeholder="Nome Completo" required autofocus/>
                        <span class="text-danger error-text full_name_err"></span>
                    </div>
                    <div>
                        <x-input id="birth_date" class="block mt-1 w-full" type="text" name="birth_date" :value="old('birth_date') ?? $lead->birth_date ?? ''" placeholder="Data de Nascimento" required autofocus/>
                        <span class="text-danger error-text birth_date_err"></span>
                    </div>
                    <input type="button" name="next" class="next action-button" data-step="1" value="Avançar"/>
                </fieldset>
                <fieldset id="step2">
                    <h2 class="fs-title">Endereço</h2>
                    <h3 class="fs-subtitle">Nos diga por onde mora</h3>
                    <div>
                        <x-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep') ?? $lead->cep ?? ''" placeholder="CEP" required autofocus/>
                        <span class="text-danger error-text cep_err"></span>
                    </div>
                    <div>
                        <x-input maxlength="50" onkeypress="return /[a-z, ]/i.test(event.key)" id="state" class="block mt-1 w-full" type="text" name="state" :value="old('state') ?? $lead->state ?? ''" placeholder="Estado" required autofocus/>
                        <span class="text-danger error-text state_err"></span>
                    </div>
                    <div>
                        <x-input maxlength="50" onkeypress="return /[a-z, ]/i.test(event.key)" id="city" class="block mt-1 w-full" type="text" name="city" :value="old('city') ?? $lead->city ?? ''" placeholder="Cidade" required autofocus/>
                        <span class="text-danger error-text city_err"></span>
                    </div>
                    <div>
                        <x-input maxlength="50" onkeypress="return /[a-z, ]/i.test(event.key)" id="street" class="block mt-1 w-full" type="text" name="street" :value="old('street') ?? $lead->street ?? ''" placeholder="Rua" required autofocus/>
                        <span class="text-danger error-text street_err"></span>
                    </div>
                    <div>
                        <x-input maxlength="10" id="number" class="block mt-1 w-full" type="text" name="number" :value="old('number') ?? $lead->number ?? ''" placeholder="Número" required autofocus/>
                        <span class="text-danger error-text number_err"></span>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Voltar"/>
                    <input type="button" name="next" class="next action-button" data-step="2" value="Avançar"/>
                </fieldset>
                <fieldset id="step3">
                    <h2 class="fs-title">Contato</h2>
                    <h3 class="fs-subtitle">Como vamos manter contato?</h3>
                    <div>
                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone') ?? $lead->phone ?? ''" placeholder="Telefone" required autofocus/>
                        <span class="text-danger error-text phone_err"></span>
                    </div>
                    <div>
                        <x-input id="cellphone" class="block mt-1 w-full" type="text" name="cellphone" :value="old('cellphone') ?? $lead->cellphone ?? ''" placeholder="Celular" required autofocus/>
                        <span class="text-danger error-text cellphone_err"></span>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Voltar"/>
                    <input type="button" name="next" class="next action-button" data-step="3" value="Avançar"/>
                </fieldset>
                <fieldset id="step4">
                    <h2 class="fs-title">Cadastro Efetuado com sucesso</h2>
                    <h3 class="fs-subtitle">Obrigado!</h3>
                </fieldset>
            </form>
        </div>
    </div>

@section('javascript')
<script>
    $(document).ready(function () {
        $('#birth_date').mask('99/99/9999');
        $('#cep').mask('99999-999');
        $('#number').mask('9999999999');
        $('#phone').mask('(99) 9999-9999');
        $('#cellphone').mask('(99) 99999-9999');

        let actualStep = '{{ $lead->step ?? 0 }}';
        if (actualStep > 0) {
            let actualFieldset = $('#step' + actualStep);
            let previousFieldset = $('#step' + (actualStep - 1));
            if (actualStep == 3 || actualStep == 4) {
                $("#progressbar li").eq($("fieldset").index($('#step2'))).addClass("active");
                $("#progressbar li").eq($("fieldset").index($('#step3'))).addClass("active");
            } else {
                $("#progressbar li").eq($("fieldset").index(actualFieldset)).addClass("active");
            }
            $('#step1').hide();
            actualFieldset.show();

            previousFieldset.animate({opacity: 0}, {
                step: function (now, mx) {
                    //as the opacity of current_fs reduces to 0 - stored in "now"
                    //1. scale current_fs down to 80%
                    scale = 1 - (1 - now) * 0.2;
                    //2. bring next_fs from the right(50%)
                    left = (now * 50) + "%";
                    //3. increase opacity of next_fs to 1 as it moves in
                    opacity = 1 - now;
                    previousFieldset.css({
                        'transform': 'scale(' + scale + ')',
                        'position': 'absolute'
                    });
                    previousFieldset.css({'left': left, 'opacity': opacity});
                },
                duration: 800,
                complete: function () {
                    previousFieldset.hide();
                    animating = false;
                },
                //this comes from the custom easing plugin
                easing: 'easeInOutBack'
            });
        }
    });

    //jQuery time
    var current_fs, next_fs, previous_fs; //fieldsets
    var left, opacity, scale; //fieldset properties which we will animate
    var animating; //flag to prevent quick multi-click glitches

    $(".next").click(function () {
        if (animating) return false;

        if (!steps($(this).data('step'))) {
            return false;
        }

        animating = true;

        current_fs = $(this).parent();
        next_fs = $(this).parent().next();

        //activate next step on progressbar using the index of next_fs
        $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

        //show the next fieldset
        next_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale current_fs down to 80%
                scale = 1 - (1 - now) * 0.2;
                //2. bring next_fs from the right(50%)
                left = (now * 50) + "%";
                //3. increase opacity of next_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({
                    'transform': 'scale(' + scale + ')',
                    'position': 'absolute'
                });
                next_fs.css({'left': left, 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    $(".previous").click(function () {
        if (animating) return false;
        animating = true;

        current_fs = $(this).parent();
        previous_fs = $(this).parent().prev();

        //de-activate current step on progressbar
        $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

        //show the previous fieldset
        previous_fs.show();
        //hide the current fieldset with style
        current_fs.animate({opacity: 0}, {
            step: function (now, mx) {
                //as the opacity of current_fs reduces to 0 - stored in "now"
                //1. scale previous_fs from 80% to 100%
                scale = 0.8 + (1 - now) * 0.2;
                //2. take current_fs to the right(50%) - from 0%
                left = ((1 - now) * 50) + "%";
                //3. increase opacity of previous_fs to 1 as it moves in
                opacity = 1 - now;
                current_fs.css({'left': left});
                previous_fs.css({'transform': 'scale(' + scale + ')', 'opacity': opacity});
            },
            duration: 800,
            complete: function () {
                current_fs.hide();
                animating = false;
            },
            //this comes from the custom easing plugin
            easing: 'easeInOutBack'
        });
    });

    /**
     *
     * @param step
     * @returns {boolean}
     */
    function steps(step) {
        if (step === 1) {
            let data = {
                "full_name": $('#full_name').val(),
                "birth_date": $('#birth_date').val(),
                "step": 2
            };
            let url = '{{ route("stepOne") }}';
            return ajax(url, data);
        } else if (step === 2) {
            let data = {
                "cep": $('#cep').val(),
                "state": $('#state').val(),
                "city": $('#city').val(),
                "street": $('#street').val(),
                "number": $('#number').val(),
                "step": 3
            };
            let url = '{{ route("stepTwo") }}';
            return ajax(url, data);
        } else if (step === 3) {
            let data = {
                "phone": $('#phone').val(),
                "cellphone": $('#cellphone').val(),
                "step": 4
            };
            let url = '{{ route("stepThree") }}';
            return ajax(url, data);
        } else {
            return false;
        }
    }

    /**
     *
     * @param url
     * @param data
     * @returns {boolean}
     */
    function ajax(url, data) {
        let result = false;
        $.ajax({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            type: 'POST',
            url: url,
            dataType: 'JSON',
            data: data,
            async: false,
            success: function (data) {
                result = true;
                if (!$.isEmptyObject(data.error)) {
                    printErrorMsg(data.error);
                }
            },
            error: function (error) {
                result = false;
                printErrorMsg(error.responseJSON.errors);
            },
        });

        return result;
    }

    function printErrorMsg(msg) {
        $.each(msg, function (key, value) {
            $('.' + key + '_err').text(value);
        });
    }

</script>
@stop
@stop

