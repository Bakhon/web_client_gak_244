$.getScript('https://webasr.yandex.net/jsapi/v1/webspeechkit.js');
$.getScript('https://webasr.yandex.net/jsapi/v1/webspeechkit-settings.js');

var tts = new ya.speechkit.Tts(
    {
        // ��������� �������.
        // API-����
        apikey: '069b6659-984b-4c5f-880e-aaedcfd84102',
        // ������������� �������: ������ �����.
        emotion: 'good', //neutral,good,evil
        // �������� ����.
        speed: 1.20, //�� 0.1 �� 3
        //	lang: 'en-US',
        // ��� �������.
        speaker: 'nastya' //jane, oksana �����, alyss ����� � omazh �����, zahar ����� ����� � ermil - ����
    });

var say = function(text){
    tts.speak(text,
    {
        stopCallback: function () {
            console.log("����������� ������ ���������.");
        }
    }
} 