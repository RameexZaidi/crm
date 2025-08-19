  <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Leads (A) Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered table-responsive" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Firstname</th>
                          <th>Mid Initial</th>
                          <th>Surname</th>
                          <th>Phones</th>
                          <th>Street</th>
                          <th>City</th>
                          <th>SSN</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      	<?php $sno=1; foreach($all_leads as $leads): ?>	
                      		<tr>
                      			<td><?= $sno++ ?></td>
                      			<td><?= $leads->fname ?></td>
                      			<td><?= $leads->mid_init ?></td>
                      			<td><?= $leads->surname ?></td>
                      			<td><?= $leads->phones ?></td>
                      			<td><?= $leads->street ?></td>
                      			<td><?= $leads->city ?></td>
                      			<td><?= $leads->ssn ?></td>
                      			
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
  $(document).ready(function() {
      $('#datatables-example').DataTable({
          "pageLength": 10,
          "lengthMenu": [5, 10, 25, 50, 100],
          "ordering": true,
          "searching": true
      });
  });
</script>
