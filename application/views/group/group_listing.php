  <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Group Listing</h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Group Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Group name</th>
                          <th>Group Company</th>
                          <th>Group Description</th>
                          <th>Group Logo</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                        <?php $sno=1; foreach($groups as $groups): ?>
                          <tr>
                            <td><?= $sno++ ?></td>
                            <td><?= $groups->grp_name ?></td>
                            <td><?= $groups->grp_comp ?></td>
                            <td><?= $groups->grp_desc ?></td>
                            <td><?= $groups->grp_logo ?></td>
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