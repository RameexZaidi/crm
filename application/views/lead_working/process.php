  <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Leads Listing</h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Leads Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Firstname</th>
                          <th>Mid Initial</th>
                          <th>Surname</th>
                          <th>Phone</th>
                          <th>Start Working</th>
                         
                        </tr>
                      </thead>
                        <tbody>
                            <?php $sno=1; foreach($leads as $leads): ?>
                                <tr>
                                    <td><?= $sno++ ?></td>
                                    <td><?= $leads->fname ?></td>
                                    <td><?= $leads->mid_init ?></td>
                                    <td><?= $leads->surname ?></td>
                                    <td><?= $leads->phones ?></td>
                                    <td><a href="<?= site_url('LeadsProcess/StartWorking/'.$leads->id.' ') ?>" class="btn btn-primary btn-sm">Start Working</a></td>
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