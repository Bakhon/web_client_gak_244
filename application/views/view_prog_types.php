<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12" id="osn-panel">
            <div class="ibox float-e-margins">
                
                        <div class="ibox-content">

                            <script>
                                var flag = 0;
                                function fn(){
                                    if (flag==0){
                                    document.getElementById('officers').style='display: table-row;';
                                    flag=1;
                                    
                                      }
                                    else {
                                        document.getElementById('officers').style='display: none;';
                                    flag=0;
                                    
                                         }
                                    }
                            </script>

                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="40">
                                <thead>
                                <tr>
                                    <th data-toggle="true">Код</th>
                                    <th data-hide="phone">Наименование</th>
                                    <th data-hide="phone">Тип справочника</th>
                                    <th data-hide="all" style="display: ">Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                
                                <tr class="footable-even" id="66" onclick="fn()">
                                    <td>010000</td>
                                    <td>Аннуитетное страхование в рамках Закона РК "О пенсионном обеспечении в РК"</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr style="display: none;" class="footable-row-detail">
                                    <td>0101000001</td>
                                    <td>"Офицеры"</td>
                                    <td>Программа</td>
                                </tr>
                                <tr style="display: none;" id="officers" class="footable-row-detail">
                                    <td>0101000001</td>
                                    <td>"Серебрянный возраст"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even">
                                    <td>0103000003</td>
                                    <td>Доплата по договорам ПА</td>
                                    <td>Вид страхования</td>
                                </tr>
                                
                                <tr class="footable-even">
                                    <td>0103000004</td>
                                    <td>Выплаты по гарантированному периоду</td>
                                    <td>Вид страхования</td>
                                </tr>
                                
                                
                                <script>
                                    var flagOS = 0;
                                    function fnOSOR(){
                                        if (flagOS==0){
                                        document.getElementById('osor').style='display: table-row;';
                                        flagOS=1;
                                        
                                          }
                                        else {
                                            document.getElementById('osor').style='display: none;';
                                        flagOS=0;
                                        
                                             }
                                        }
                                </script>
                                
                                <tr class="footable-even" style="display: table-row;" onclick="fnOSOR()">
                                    <td>0201</td>
                                    <td>Аннуитетное страхование в рамках Закона ОСОР</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr style="display: none;" class="footable-row-detail">
                                    <td>020100001</td>
                                    <td>"Кормилец"</td>
                                    <td>Программа</td>
                                </tr>
                                <tr style="display: none;" id="osor" class="footable-row-detail">
                                    <td>020100002</td>
                                    <td>Выплата по вторичному ОСОР</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>020200001</td>
                                    <td>Добровольное страхование для договоров Казахмыс</td>
                                    <td>Вид страхования</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>020300003</td>
                                    <td>Доплата по договорам ОСОР</td>
                                    <td>Вид страхования</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>030100001</td>
                                    <td>Выплата выкупной суммы по договорам ПА</td>
                                    <td>Вид страхования</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0401</td>
                                    <td>Долгосрочное накопительное страхование жизни и трудоспособности</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>0401000001</td>
                                    <td>"Королевский стандарт"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0501</td>
                                    <td>Накопительное страхование жизни в пользу ребенка</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>050100001</td>
                                    <td>"Родительская забота"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0601</td>
                                    <td>Срочное страхование жизни</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>060100001</td>
                                    <td>"Хранитель"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0602</td>
                                    <td>Страхование жизни заемщика ипотечных и иных кредитов</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>060200001</td>
                                    <td>"Гарантийный"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0603</td>
                                    <td>Срочное страхование жизни замещика от НС</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>060300001</td>
                                    <td>"Жизнь без тревог"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0604</td>
                                    <td>Срочное страхование от несчастных случаев</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>060400001</td>
                                    <td>"Премиум"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <script>
                                    var flagOB = 0;
                                    function fnOBYAZ(){
                                        if (flagOB==0){
                                        document.getElementById('obyaz').style='display: table-row;';
                                        document.getElementById('obyaz2').style='display: table-row;';
                                        flagOB=1;
                                        
                                          }
                                        else {
                                            document.getElementById('obyaz').style='display: none;';
                                            document.getElementById('obyaz2').style='display: none;';
                                        flagOB=0;
                                        
                                             }
                                        }
                                </script>
                                
                                <tr class="footable-even" style="display: table-row;" onclick="fnOBYAZ()">
                                    <td>0701</td>
                                    <td>Обязательное страхование работника от несчастных случаев (ОСНС)</td>
                                    <td>Вид страхования</td>
                                </tr>
                                <tr class="footable-row-detail">
                                    <td>0701000001</td>
                                    <td>"ОСНС"</td>
                                    <td>Программа</td>
                                </tr>
                                <tr class="footable-row-detail" id="obyaz" class="footable-row-detail">
                                    <td>0701000001</td>
                                    <td>"ОСНС"</td>
                                    <td>Программа</td>
                                </tr>
                                <tr class="footable-row-detail" id="obyaz2" class="footable-row-detail">
                                    <td>0701000001</td>
                                    <td>"ОСНС"</td>
                                    <td>Программа</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0801000001</td>
                                    <td>Выплата на погребение ПА</td>
                                    <td>Вид страхования</td>
                                </tr>
                                
                                <tr class="footable-even" style="display: table-row;">
                                    <td>0802000001</td>
                                    <td>Выплата на погребение ОСНС</td>
                                    <td>Вид страхования</td>
                                </tr>

                               <tr class="footable-even" style="display: table-row;">
                                    <td>0901000001</td>
                                    <td>Возврат части страховой премии по договорам ОСОР</td>
                                    <td>Вид страхования</td>
                               </tr>

                               <tr class="footable-even" style="display: table-row;">
                                    <td>0902000001</td>
                                    <td>Возврат части страховой премии по договорам ОСНС</td>
                                    <td>Вид страхования</td>
                               </tr>
                               
                               <tr class="footable-even" style="display: table-row;">
                                    <td>0903000001</td>
                                    <td>Возрат с БВУ</td>
                                    <td>Вид страхования</td>
                               </tr>
                               
                               <tr class="footable-even" style="display: table-row;">
                                    <td>100100001</td>
                                    <td>Выплата пени по договорам ПА</td>
                                    <td>Вид страхования</td>
                               </tr>
                               
                               <tr class="footable-even" style="display: table-row;">
                                    <td>100200001</td>
                                    <td>Выплата пени по договорам ОСОР</td>
                                    <td>Вид страхования</td>
                               </tr>
                               
                               <tr class="footable-even" style="display: table-row;">
                                    <td>110100001</td>
                                    <td>Корректировка начислений по договорам ПА</td>
                                    <td>Вид страхования</td>
                               </tr>
                               
                               <tr class="footable-even" style="display: table-row;">
                                    <td>110200001</td>
                                    <td>Корректировка начислений по договорам ОСОР</td>
                                    <td>Вид страхования</td>
                               </tr>
                               
                               
                               <tr class="footable-even" style="display: table-row;">
                                    <td>110700001</td>
                                    <td>Корректировка начислений по елиновременным выплатам ОСНС</td>
                                    <td>Вид страхования</td>
                               </tr>
                                
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                  
                </div>
                
                </div>
                
                </div></div></div>
