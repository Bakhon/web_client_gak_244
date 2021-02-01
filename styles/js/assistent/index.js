var s = location.href;
var p = s.substr(0, 5);
if(p == 'https'){   
    //Подключаем голос от Яндекса
    var tts = new ya.speechkit.Tts({
        // Настройки синтеза.
        // API-ключ
        apikey: '069b6659-984b-4c5f-880e-aaedcfd84102',
        // Эмоциональная окраска: добрый голос.
        emotion: 'good', //neutral,good,evil
        // Скорость речи.
        speed: 1, //от 0.1 до 3
        //	lang: 'en-US',
        // Имя диктора.
        speaker: 'ermil' //jane, oksana хрень, alyss хрень и omazh хрень, zahar хрень вроде и ermil - норм
    });
    
    //Подключаем модули по распознованию голосового текста
    var recognizer = new webkitSpeechRecognition();
    recognizer.interimResults = true;
    recognizer.lang = 'ru-Ru';
    recognizer.onresult = function (event) {
        var result = event.results[event.resultIndex];
        if (result.isFinal) {
            toastr.success(result[0].transcript, 'Вы сказали');
            $.post('speek', {"text":result[0].transcript}, function(data){
                console.log(data);
                var j = JSON.parse(data);
                console.log(j);
                if(j.alert !== ''){
                    alert(j.alert);
                    say(j.alert);
                    return;
                }
                console.log(j);
            });
            //console.log('Вы сказали: ' + result[0].transcript);
        } else {
            console.log('Промежуточный результат: ', result[0].transcript);
        }
    };
        
    function say(text){
        tts.speak(text,
        {
            stopCallback: function () {
                console.log("Озвучивание текста завершено.");
            }
        });
    }
    
    $('#rec').click(function(){
        var s = location.href;
        var p = s.substr(0, 5);
        var t = s.replace('http', 'https');    
        if(p !== 'https'){
            alert('Для использования микрофона необходимо перейти на защищенный протокол! <br /><a href="'+t+'"><h3>Перейти</h3></a>');
        }else{
            //say('Добрый день! Чем могу помочь?');
          recognizer.start();  
        }
    });
}