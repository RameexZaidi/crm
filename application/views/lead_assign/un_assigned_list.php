  <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Assign List</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Firstname</th>
                          <th>Midinit</th>
                          <th>Surname</th>
                        </tr>
                      </thead>
                      <?php $sno=1; foreach($un_assign_leads as $lead): ?>
                          <tr>
                            <td><?= $sno++ ?></td>
                            <td><?= $lead->fname ?></td>
                            <td><?= $lead->mid_init ?></td>
                            <td><?= $lead->surname ?></td>
                          </tr>
                      <?php endforeach; ?>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>