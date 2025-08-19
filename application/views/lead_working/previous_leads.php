  <div id="content">
              
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Previous Leads Listing</h3></div>
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
                          <?php if (!empty($leads)): ?>
                            <?php $sno = 1; foreach($leads as $lead): ?>
                              <tr>
                                <td><?= $sno++ ?></td>
                                <td><?= $lead->fname ?></td>
                                <td><?= $lead->mid_init ?></td>
                                <td><?= $lead->surname ?></td>
                                <td><?= $lead->phones ?></td>
                                <td>
                                  <?php if (in_array($lead->id, $in_process_ids)): ?>
                                    <span class="label label-success">Already in process</span>
                                  <?php else: ?>
                                    <button class="btn btn-default btn-sm" disabled data-toggle="tooltip" title="This lead is die">
                                      Start Working
                                    </button>
                                  <?php endif; ?>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          <?php else: ?>
                            <tr>
                              <td colspan="6" class="text-center text-danger"><strong>No previous data for this user</strong></td>
                            </tr>
                          <?php endif; ?>
                        </tbody>


                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>