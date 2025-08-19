  <!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    .btn-sm i {
    margin-right: 4px;
}
.btn-xs {
  padding: 0.15rem 0.3rem;
  font-size: 0.75rem;
  line-height: 1;
}
table{
    font-size:9px;
}
</style>
  <div id="content">
             
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Blank Deals Manual</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                              <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Reference</th>
                                      <th>Fname</th>
                                      <th>Mid Initial</th>
                                      <th>Surname</th>
                                      <th>Phone</th>
                                      <th>Generate</th>
                                      <th>Role</th>
                                      <th>Status</th> <!-- ✅ NEW -->
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php $sno=1; foreach($blank_lead as $leads): ?>
                                      <tr>
                                        <td><?= $sno++ ?></td>
                                        <td><?= $leads->reference_number ?></td>
                                        <td><?= $leads->fname ?></td>
                                        <td><?= $leads->mid_init ?></td>
                                        <td><?= $leads->surname ?></td>
                                        <td><?= $leads->phones ?></td>
                                        <td><?= $leads->u_name ?></td>
                                        <td><?= $this->session->userdata('role') ?></td>
                                        
                                        <!-- ✅ Status -->
                                        <td>
                                          <?= ($leads->t_enable == 't') ? 'True' : 'False' ?>
                                        </td>
                                
                                        <!-- ✅ Actions -->
                                       <td>
                                  <div class="d-flex align-items-center gap-1">
                                    <!-- Detail Button -->
                                    <a href="<?= site_url('BlankLead/BlankLeadDetail/'.$leads->id) ?>" 
                                       class="btn btn-info btn-sm d-flex justify-content-center align-items-center p-0" 
                                       data-toggle="tooltip" 
                                       title="View Details" style="width:25px; height:25px;">
                                      <i class="fa fa-eye"></i>
                                    </a>
                                
                                    <!-- Copy Button -->
                                    <button 
                                      class="btn btn-secondary btn-sm d-flex justify-content-center align-items-center p-0 copy-btn" 
                                      data-ref="<?= $leads->reference_number ?>"
                                      data-fname="<?= $leads->fname ?>"
                                      data-mid="<?= $leads->mid_init ?>"
                                      data-surname="<?= $leads->surname ?>"
                                      data-phone="<?= $leads->phones ?>"
                                      data-uname="<?= $leads->u_name ?>"
                                      data-role="<?= $this->session->userdata('role') ?>"
                                      data-toggle="tooltip" 
                                      title="Copy Lead Info" style="width:25px; height:25px;">
                                      <i class="fa fa-copy"></i>
                                    </button>
                                
                                    <!-- Enable/Disable Button -->
                                    <a href="<?= site_url('BlankLead/toggle_status/'.$leads->id) ?>" 
                                       class="btn btn-warning btn-sm d-flex justify-content-center align-items-center p-0" 
                                       data-toggle="tooltip" 
                                       title="<?= ($leads->t_enable == 't') ? 'Disable Lead' : 'Enable Lead' ?>" style="width:25px; height:25px;">
                                      <i class="fa fa-power-off"></i>
                                    </a>
                                  </div>
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
            
            <script>
            document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll(".copy-btn").forEach(function (button) {
            button.addEventListener("click", function () {
            let data = `
            Reference #: ${this.dataset.ref}
            First Name: ${this.dataset.fname}
            Middle Initial: ${this.dataset.mid}
            Surname: ${this.dataset.surname}
            Phone: ${this.dataset.phone}
            Username: ${this.dataset.uname}
            Role: ${this.dataset.role}
                        `.trim();
            
                        // Copy to clipboard
                        navigator.clipboard.writeText(data).then(() => {
                            alert("Row data copied to clipboard!");
                        }).catch(err => {
                            console.error("Copy failed", err);
                            alert("Failed to copy");
                        });
                    });
                });
            });
</script>
<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });
</script>
