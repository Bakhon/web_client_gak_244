<div class="row">
    <div class="col-lg-12">
        <div class="ibox-content">
            <div class="feed-activity-list">
                
                <?php foreach($bi->result as $k=>$v){ ?>                
                <div class="feed-element">
                    <a href="bi?report=<?php echo $v['ID']; ?>" class="pull-left">                        
                        <strong><?php echo $v['NAME']; ?></strong>
                        <div><?php echo $v['DESCS']; ?></div>                        
                    </a>
                                        
                    <a href="bi?report_del=<?php echo $v['ID']; ?>" class="pull-right btn btn-danger btn-xs" style="margin-right: 15px;"><i class="fa fa-trash"></i></a>
                    <a href="bi?report_edit=<?php echo $v['ID']; ?>" class="pull-right btn btn-success btn-xs" style="margin-right: 15px;"><i class="fa fa-pencil"></i></a>
                    <a href="bi?report_edit=0" class="pull-right btn btn-info btn-xs" style="margin-right: 15px;"><i class="fa fa-plus"></i></a>                    
                    <a href="bi?report=<?php echo $v['ID']; ?>" class="pull-right btn btn-default btn-xs" style="margin-right: 15px;"><i class="fa fa-eye"></i></a>
                </div>
                <?php } ?>
                        
            </div>
        </div>                
    </div>
</div>