 <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <style>
     .custom-password-btn {
    background-color: #f0ad4e; /* Bootstrap warning color */
    color: #fff;
    border: none;
    padding: 6px 12px;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.2s ease;
    white-space: nowrap; /* Prevent width change */
    display: inline-block;
    width: 160px; /* Fixed width to prevent jump */
    text-align: center;
}

.custom-password-btn:hover {
    background-color: #ec971f; /* Darker shade for hover */
    transform: scale(1.03); /* Slight zoom effect */
    text-decoration: none;
    color: #fff;
}
/* Toggle Switch */
.switch {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 26px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider-status {
  position: absolute;
  cursor: pointer;
  top: 0; left: 0;
  right: 0; bottom: 0;
  background-color: #e74c3c; /* red by default (F) */
  transition: 0.4s;
  border-radius: 34px;
}

.slider-status:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

input:checked + .slider-status {
  background-color: #4CAF50; /* green when T */
}

input:checked + .slider-status:before {
  transform: translateX(24px);
}


 </style>
  <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Employee Id Password Listing</h3></div>
                    <div class="panel-body">
                        <div>
                  Show 
                  <select id="rowsPerPage" onchange="renderTable()">
                    <option value="5">5</option>
                    <option value="10" selected>10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                  </select>
                  entries
                
                  <input type="text" id="searchInput" placeholder="Search..." onkeyup="renderTable()" style="float: right;">
                 <button onclick="exportTableToCSV('datatables-example', 'User_Data.csv')" class="btn btn-success" style="margin-bottom: 10px;">
                    Export to Excel
                </button>


                </div>

                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Agent Name</th>
                          <th>Login Username</th>
                          <th>Password</th>
                          <th>Role</th>
                          <th>Group</th>
                          <th>Change Password</th>
                          <th>Change Status</th>
                          <th>Current Status</th>
                        </tr>
                      </thead>
                      <tbody id="tableBody">
                          <?php $sno=1; foreach($user as $user): ?>
                            <tr>
                                <td><?= $sno++ ?></td>
                                <td><?= $user->agent_name ?></td>
                                <td><?= $user->u_name ?></td>
                                <td><?= $user->plain_password ?></td>
                                <td><?= $user->role ?></td>
                                <td><?= $user->grp_name ?></td>
                                <td><a href="#" class="btn btn-warning btn-sm custom-password-btn" data-id="<?= $user->id ?>" data-name="<?= $user->agent_name ?>" onclick="openPasswordModal(this)">
          Change Password <i class="fa fa-key"></i>
        </a>
                                </td>
                                
                                <td>
<label class="switch">
  <input type="checkbox" class="status-toggle" data-user-id="<?= $user->id ?>" <?= ($user->u_enable === 't') ? 'checked' : '' ?>>
  <span class="slider-status"></span>
</label>

</td>
<td>
    <?php if($user->u_enable==='t'){?>
        <span class="badge badge-success">Enable</span>
    <?php }else{ ?>
    <span class="badge badge-danger">Disable</span>
    <?php } ?>
</td>

                            </tr>
                          <?php endforeach; ?>
                          
                      </tbody>
                        </table>
                         <div id="pagination" style="margin-top: 10px;"></div>

                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel">
                  <div class="modal-dialog" role="document">
                    <form method="post" action="<?= base_url('Agent/change_password') ?>">
                      <input type="hidden" name="user_id" id="modal_user_id">
                      <div class="modal-content">
                        <div class="modal-header bg-warning text-white">
                          <h5 class="modal-title">Change Password for <span id="agent_name"></span></h5>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label>New Password</label>
                            <input type="text" name="new_password" class="form-control" required>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success">Save Password</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
    <?php if ($this->session->flashdata('success')): ?>
<script>
Swal.fire({
  icon: 'success',
  title: 'Success',
  text: '<?= $this->session->flashdata("success") ?>',
  confirmButtonColor: '#3085d6'
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
<script>
Swal.fire({
  icon: 'error',
  title: 'Error',
  text: '<?= $this->session->flashdata("error") ?>',
  confirmButtonColor: '#d33'
});
</script>
<?php endif; ?>

             <script>
let originalRows = Array.from(document.querySelectorAll('#tableBody tr'));
let currentPage = 1;

function renderTable() {
  const search = document.getElementById('searchInput').value.toLowerCase();
  const rowsPerPage = parseInt(document.getElementById('rowsPerPage').value);
  const tbody = document.getElementById('tableBody');
  const pagination = document.getElementById('pagination');

  // Filter rows
  const filtered = originalRows.filter(row => {
    return Array.from(row.cells).some(cell =>
      cell.textContent.toLowerCase().includes(search)
    );
  });

  const totalPages = Math.ceil(filtered.length / rowsPerPage);
  if (currentPage > totalPages) currentPage = 1;

  // Paginate rows
  const start = (currentPage - 1) * rowsPerPage;
  const paginated = filtered.slice(start, start + rowsPerPage);

  // Clear and append new rows
  tbody.innerHTML = '';
  paginated.forEach(row => tbody.appendChild(row));

  // Pagination buttons
  pagination.innerHTML = '';
  for (let i = 1; i <= totalPages; i++) {
    const btn = document.createElement('button');
    btn.textContent = i;
    btn.style.margin = '2px';
    btn.style.padding = '5px 10px';
    btn.style.fontWeight = i === currentPage ? 'bold' : 'normal';
    btn.onclick = () => { currentPage = i; renderTable(); };
    pagination.appendChild(btn);
  }
}
window.onload = renderTable;
</script>
<script>
function exportTableToCSV(tableID, filename = 'Report.csv') {
    const table = document.getElementById(tableID);
    let csv = [];

    const rows = table.querySelectorAll('tr');
    for (let row of rows) {
        let cols = row.querySelectorAll('td, th');
        let csvRow = [];
        for (let col of cols) {
            let data = col.innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/"/g, '""');
            csvRow.push(`"${data}"`);
        }
        csv.push(csvRow.join(','));
    }

    const csvFile = new Blob([csv.join('\n')], { type: "text/csv" });
    const downloadLink = document.createElement("a");
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = "none";
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}
</script>
<script>
    function openPasswordModal(button) {
  var userId = button.getAttribute('data-id');
  var agentName = button.getAttribute('data-name');

  document.getElementById('modal_user_id').value = userId;
  document.getElementById('agent_name').innerText = agentName;

  $('#passwordModal').modal('show');
}
</script>

<script>
$(document).on('change', '.status-toggle', function () {
    var userId = $(this).data('user-id');
    var status = $(this).is(':checked') ? 't' : 'f';

    $.ajax({
        url: '<?= site_url("Agent/toggle_status") ?>',
        type: 'POST',
        data: {
            user_id: userId,
            status: status
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Status Updated',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                location.reload(); // ✅ reloads page after message
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong!'
            });
        }
    });
});
</script>

