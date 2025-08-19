<div id="content">
    <div class="col-md-12 top-20 padding-0">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3>Agent Listing</h3></div>
                <div class="panel-body">
                    <div class="responsive-table">
                        <div class="table-responsive">
                            <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Group</th>
                                        <th>Name</th>
                                        <th>Lastname</th>
                                        <th>Contact</th>
                                        <th>Email</th>
                                        <th>Cnic</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sno=1; foreach($agents as $agent): ?>
                                        <tr>
                                            <td>
                                                <?= $sno++ ?>
                                            </td>
                                            <td>
                                                <?= $agent->grp_name ?>
                                            </td>
                                            <td>
                                                <?= $agent->u_name ?>
                                            </td>
                                            <td>
                                                <?= $agent->u_father ?>
                                            </td>
                                            <td>
                                                <?= $agent->u_mobile ?>
                                            </td>
                                            <td>
                                                <?= $agent->u_email ?>
                                            </td>
                                            <td>
                                                <?= $agent->u_cnic ?>
                                            </td>
                                            <td>
                                                <?php if($agent->u_enable=='t'){ ?>
                                                    <span class="badge badge-success">Enable</span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger">Disable</span>
                                                        <?php } ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>