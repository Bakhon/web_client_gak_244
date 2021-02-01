$.getScript('https://webasr.yandex.net/jsapi/v1/webspeechkit.js');
$.getScript('https://webasr.yandex.net/jsapi/v1/webspeechkit-settings.js');

var tts = new ya.speechkit.Tts(
    {
        // Настройки синтеза.
        // API-ключ
        apikey: '069b6659-984b-4c5f-880e-aaedcfd84102',
        // Эмоциональная окраска: добрый голос.
        emotion: 'good', //neutral,good,evil
        // Скорость речи.
        speed: 1.20, //от 0.1 до 3
        //	lang: 'en-US',
        // Имя диктора.
        speaker: 'nastya' //jane, oksana хрень, alyss хрень и omazh хрень, zahar хрень вроде и ermil - норм
    });

var say = function(text){
    tts.speak(text,
    {
        stopCallback: function () {
            console.log("Озвучивание текста завершено.");
        }
    }
} 