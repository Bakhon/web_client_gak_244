<div class="middle-box loginscreen animated fadeInDown">
        <h1 class="logo-name">ГАК</h1>
        <form class="m-t" role="form" action="">
            <div class="form-group">
                <input id="old_pass1" type="password" class="form-control" placeholder="Действующий пароль" required=""/>
            </div>
            <div class="form-group">
                <input onblur="check_old_pass();" onkeyup="return checkPassword(this);" id="new_pass" type="password" class="form-control" placeholder="Новый пароль" required=""/>
            </div>
            <div class="form-group">
                <input onblur="check_old_pass();" onkeyup="return checkPassword(this);" id="new_pass2" type="password" class="form-control" placeholder="Повторите пароль" required=""/>
            </div>
            <button id="change_pass_btn" disabled="" type="submit" class="btn btn-primary block full-width m-b"> Сменить </button>
        </form>
        <p class="m-t text-center "> <small>Пароль защищен политикой безопасности</small> </p>
        <div class="col-lg-12">
            <fieldset>
                <div id="same_pass" class="checkbox checkbox-info checkbox-circle">
                    <input type="checkbox" class="checkcheck" class="checkcheck"/><label for="checkbox2">Пароли совпадают</label>
                </div>
                <div id="pass_lenght" class="checkbox checkbox-info checkbox-circle">
                    <input type="checkbox" class="checkcheck"/><label for="checkbox2">Не менее 8 символов</label>
                </div> 
                <div id="upper_case" class="checkbox checkbox-info checkbox-circle">
                    <input type="checkbox" class="checkcheck"/><label for="checkbox2"> Не менее одного символа в верхнем регистре</label>
                </div>
                <div id="numbers" class="checkbox checkbox-info checkbox-circle">
                    <input type="checkbox" class="checkcheck"/><label for="checkbox2"> Не менее 1 цифры (0 - 9)</label>
                </div>
                <div id="specials" class="checkbox checkbox-info checkbox-circle">
                    <input type="checkbox" class="checkcheck"/><label for="checkbox2"> Не менее 1 спецсимвола (!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~)</label>
                </div>
            </fieldset>
        </div>
</div>

<script>
    $('.checkcheck').change(
        function(){
            check_checkbox();
        }
    )

    function check_checkbox(){
        var i = 0;
        $('.checkcheck').each(function(){if($(this).prop("checked")){
            i++;            
        }});
        
        if(i == 5){
            $('#change_pass_btn').removeAttr('disabled');
        }else{
            $('#change_pass_btn').attr('disabled','disabled');
        }
    }

    function check_old_pass()
    {
        check_checkbox();
        var new_pass1 = $('#new_pass').val();
        var new_pass2 = $('#new_pass2').val();
        console.log(new_pass1+' '+new_pass2);
        check_checkbox();
        if(new_pass1 != '' && new_pass2 != ''){
            if(new_pass1 == new_pass2){
                $('#same_pass').html('<input type="checkbox" class="checkcheck" checked=""/><label for="checkbox2">Пароли совпадают</label>');
            }else{
                $('#same_pass').html('<input type="checkbox" class="checkcheck"/><label for="checkbox2">Пароли совпадают</label>');
            }
        }else{
             $('#same_pass').html('<input type="checkbox" class="checkcheck"/><label for="checkbox2">Пароли совпадают</label>');
        }
    }
    
    function check_lenght()
    {
        check_checkbox();
        var new_pass1 = $('#new_pass').val();
        if(new_pass1.length >= 8){$('#pass_lenght').html('<input type="checkbox" class="checkcheck" checked=""/><label for="checkbox2">Не менее 8 символов</label>')}
        else{$('#pass_lenght').html('<input type="checkbox" class="checkcheck"/><label for="checkbox2">Не менее 8 символов</label>')}
    }

  function checkPassword(form) {
    check_old_pass();
    check_lenght();
    var password = $('#new_pass').val(); // Получаем пароль из формы
    var s_letters = "qwertyuiopasdfghjklzxcvbnmабвгдеёжзийклмнопрстуфхцчшщъыьэюяәіңғүұқө"; // Буквы в нижнем регистре
    var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNMАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯӘІҢҒҮҰҚӨ"; // Буквы в верхнем регистре
    var digits = "0123456789"; // Цифры
    var specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
    var is_s = false; // Есть ли в пароле буквы в нижнем регистре
    var is_b = false; // Есть ли в пароле буквы в верхнем регистре
    var is_d = false; // Есть ли в пароле цифры
    var is_sp = false; // Есть ли в пароле спецсимволы
    $('#specials').html('<input type="checkbox" class="checkcheck" id="inlineCheckbox2" value="option1"/>');
    $('#upper_case').html('<input type="checkbox" class="checkcheck"/><label for="checkbox2"> Не менее одного символа в верхнем регистре</label>');
    $('#numbers').html('<input type="checkbox" class="checkcheck" id="inlineCheckbox2" value="option1"/>');
    for (var i = 0; i < password.length; i++) {
      /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
      if (!is_b && b_letters.indexOf(password[i]) != -1) {is_b = '<input type="checkbox" class="checkcheck" checked=""/><label for="checkbox2"> Не менее одного символа в верхнем регистре</label>';}
      else if (!is_d && digits.indexOf(password[i]) != -1) {is_d = '<input type="checkbox" class="checkcheck" checked=""/><label for="checkbox2"> Не менее 1 цифры (0 - 9)</label>';}
      else if (!is_sp && specials.indexOf(password[i]) != -1) {is_sp = '<input type="checkbox" class="checkcheck" checked=""/><label for="checkbox2"> Не менее 1 спецсимвола (!"#$%&()*+,-./:;<=>?@[\]^_`{|}~)</label>';}
    }
    var text = is_b+' '+is_d+' '+is_sp;
    $('#specials').html(is_sp);
    $('#upper_case').html(is_b);
    $('#numbers').html(is_d);
    if(is_sp == false){$('#specials').html('<input type="checkbox" class="checkcheck"/><label for="checkbox2"> Не менее 1 спецсимвола (!"#$%&()*+,-./:;<=>?@[\]^_`{|}~)</label>')}
    if(is_b == false){$('#upper_case').html('<input type="checkbox" class="checkcheck" /><label for="checkbox2"> Не менее одного символа в верхнем регистре</label>')}
    if(is_d == false){$('#numbers').html('<input type="checkbox" class="checkcheck"/><label for="checkbox2"> Не менее 1 цифры (0 - 9)</label>')}
    
    console.log(text); // Выводим итоговую сложность пароля
    return false; // Форму не отправляем
  }
</script>
















