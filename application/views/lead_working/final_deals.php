  <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Approve Deal Listing</h3>
                    </div>
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Approve Deal Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Deal Code</th>
                          <th>Agent Name</th>
                          <th>Qualifier Name</th>
                          <th>Closer Name</th>
                          <th>Amount</th>
                          <th>Confirmation Date</th>
                          <th>View Details</th>
                        </tr>
                      </thead>
                       <?php $sno=1; foreach($deals as $deal): ?>
                        <tr>
                            <td><?= $sno++ ?></td>
                            <td><?= $deal->deal_code ?></td>
                            <td><?php $agent_name = $this->Deal_model->GetName($deal->agent_id); echo $agent_name['u_name']??'' ; ?></td>
                            <td><?php $qualifier_name = $this->Deal_model->GetName($deal->qualifier_id); echo $qualifier_name['u_name']??'' ; ?></td>
                            <td><?php $closer_name = $this->Deal_model->GetName($deal->closer_id); echo $closer_name['u_name']??'' ; ?></td>
                            <td><?= number_format($deal->closer_amount,2) ?></td>
                            <td><?= $deal->conversion_date ?></td>
                            <td><a href="#">Detail</a></td>
                        </tr>
                       <?php endforeach; ?>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>