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

function say(text){
    tts.speak(text,
    {
        stopCallback: function () {
            console.log("����������� ������ ���������.");
        }
    }
} 

$('#rec').click(function(){
    var s = location.href;
    var p = s.substr(0, 5);
    var t = s.replace('http', 'https');    
    if(p !== 'https'){
        alert('��� ������������� ��������� ���������� ������� �� ���������� ��������! <br /><a href="'+t+'"><h3>�������</h3></a>');
    }else{
        say('������ ����! ��� ���� ������?');
      recognizer.start();  
    }
});