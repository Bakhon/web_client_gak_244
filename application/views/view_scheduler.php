<div class="row">
    
    <div class="col-lg-8">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Органайзер</h5>
                <div class="ibox-tools">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a></li>
                        <li><a href="#">Config option 2</a></li>
                    </ul>                            
                </div>
            </div>
            <div class="ibox-content">
                <div id="calendar"></div>                 
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Навигационная панель</h5>
                <div class="ibox-tools">                                        
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a></li>
                        <li><a href="#">Config option 2</a></li>
                    </ul>                            
                </div>
            </div>
            <div class="ibox-content">
                             
            </div>
        </div>
    </div>
</div>    
               
                
<div class="modal inmodal fade" id="createEventModal" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>      
                <i class="fa fa-calendar modal-icon"></i>
                <h4 class="modal-title">Новая запись</h4>                                                                          
            </div>
            <div class="modal-body">
            
                <form id="createAppointmentForm" class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label" for="inputPatient">Patient:</label>
                        <div class="controls">
                            <input type="text" name="patientName" id="patientName" tyle="margin: 0 auto;" data-provide="typeahead" data-items="4" data-source="[&quot;Value 1&quot;,&quot;Value 2&quot;,&quot;Value 3&quot;]">
                            <input type="hidden" id="apptStartTime"/>
                            <input type="hidden" id="apptEndTime"/>
                            <input type="hidden" id="apptAllDay" />
                        </div>
                    </div>
                        
                    <div class="control-group">
                        <label class="control-label" for="when">When:</label>
                        <div class="controls controls-row" id="when" style="margin-top:5px;"></div>
                    </div>
                </form>   
                                                    
            </div>
            <div class="modal-footer">                
                <button type="submit" class="btn btn-primary" id="submitButton">Сохранить</button>
                <button type="button" class="btn btn-white" data-dismiss="modal">Закрыть</button>                
            </div>
        </div>
    </div>
</div>                   