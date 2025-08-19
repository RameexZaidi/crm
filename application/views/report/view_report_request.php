  <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Report Request Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Firstname</th>
                          <th>Mid Initial</th>
                          <th>Surname</th>
                          <th>Request By</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php $sno=1; foreach($report_request as $request): ?>
                            <tr>
                                <td><?= $sno++ ?></td>
                                <td><?= $request->fname ?></td>
                                <td><?= $request->mid_init ?></td>
                                <td><?= $request->surname ?></td>
                                <td>
                                    
                                    <?php 
                                    if($request->agent_id >0)
                                    { 
                                        $agent_name = $this->Deal_model->GetName($request->agent_id);
                                        echo $agent_name['u_name'];
                                    }
                                    
                                    if($request->qualifier_id >0)
                                    { 
                                        $qualifier = $this->Deal_model->GetName($request->qualifier_id);
                                        echo $qualifier['u_name'];
                                    }
                                    
                                    if($request->closer_id >0)
                                    { 
                                        $closer = $this->Deal_model->GetName($request->closer_id);
                                        echo $closer['u_name'];
                                    }
                                    
                                    ?>
                                    </td>
                                <td>
                                    <a href="<?= site_url('Report/ReportUploading/'.$request->lead_id.' ') ?>" class="btn btn-primary btn-sm">Take Action</a>
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