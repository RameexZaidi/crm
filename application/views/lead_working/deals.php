<style>
.btn.btn-primary.btn-sm:hover,
.btn.btn-primary.btn-sm:focus,
.btn.btn-primary.btn-sm:active {
  background-color: #007bff !important;
  border-color: #007bff !important;
  color: white !important;
  box-shadow: none !important;
  opacity: 1 !important;
  transform: none !important;
  cursor: pointer !important;
}
</style>       
          <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Deal Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Agent Name</th>
                          <th>Firstname</th>
                          <th>Mid Initial</th>
                          <th>Surname</th>
                          <th>Phone</th>
                          <th>Deal Confirm</th>
                          <th>Working Tracking</th>
                         
                        </tr>
                      </thead>
                        <tbody>
                            <?php $sno=1; foreach($leads as $leads): ?>
                                <tr>
                                    <td><?= $sno++ ?></td>
                                    <td><?= $leads->u_name ?></td>
                                    <td><?= $leads->fname ?></td>
                                    <td><?= $leads->mid_init ?></td>
                                    <td><?= $leads->surname ?></td>
                                    <td><?= $leads->phones ?></td>
                                   <td>
                                      <a href="<?= site_url('Deal/LeadConversion/'.$leads->lead_id) ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-check"></i> Deal Confirm
                                      </a>
                                    </td>
                                    <td>
                                      <a href="<?= site_url('Deal/tracking/'.$leads->lead_id) ?>" class="btn btn-primary btn-sm">
                                        <i class="fas fa-truck"></i> Tracking
                                      </a>
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