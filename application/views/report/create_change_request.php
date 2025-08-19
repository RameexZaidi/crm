<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Report Change Request</h3>
                <p class="animated fadeInDown">
                   
                </p>
            </div>
        </div>
    </div>
    <div class="form-element">
        <div class="col-md-12 padding-0">
            <div class="col-md-12">
                <div class="panel form-element-padding">
                    <div class="panel-heading">
                        

                       <form method="post" action="<?= site_url('ChangeRequest/store') ?>" class="form-horizontal">
                        <input type="hidden" name="report_id" value="<?= isset($report_id) ? $report_id : '' ?>">
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">
                                <i class="fa fa-edit text-primary"></i> Column Name
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="column_name" class="form-control" placeholder="Enter column name to change" required>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-sm-2 control-label text-right">
                                <i class="fa fa-pencil-square-o text-warning"></i> Requested Change
                            </label>
                            <div class="col-sm-10">
                                <textarea name="requested_change" class="form-control" rows="4" placeholder="Enter requested value" required></textarea>
                            </div>
                        </div>
                    
                        <div class="form-group text-center" style="margin-top: 20px;">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fa fa-paper-plane"></i> Submit Change Request
                            </button>
                        </div>
                    </form>


                    </div>
                </div>
            </div>

        </div>



    </div>
</div>

