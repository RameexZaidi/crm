  <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Report Change Request</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Requested By</th>
                          <th>Firstname</th>
                          <th>Mid init</th>
                          <th>Surname</th>
                          <th>SSN</th>
                          <th>Update Record</th>
                        </tr>
                      </thead>
                        <tbody>
                            <?php $sno=1; foreach($request as $req): ?>
                                <tr>
                                    <td><?= $sno++ ?></td>
                                    <td><?= $req->u_name ?></td>
                                    <td><?= $req->fname ?></td>
                                    <td><?= $req->mid_init ?></td>
                                    <td><?= $req->surname ?></td>
                                    <td><?= $req->ssn ?></td>
                                    <td><a href="<?= site_url('ChangeRequest/UpdateReportRecord/'.$req->id.' ') ?>" class="btn btn-primary btn-sm">Update Record</a></td>
                                    
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
       
            
         

