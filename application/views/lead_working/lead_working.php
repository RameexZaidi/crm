<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id="content">
  <div class="panel box-shadow-none content-header">
    <div class="panel-body">
    </div>
  </div>
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
       
        <div class="panel-body">
          <div class="responsive-table">
            <style>
    .form-section {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #dee2e6;
    }

    .form-section h5 {
        border-left: 5px solid #007bff;
        padding-left: 10px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .form-group label {
        font-weight: 500;
    }
</style>

<form action="<?= site_url('LeadsProcess/store') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow-lg p-4 mb-4">
    <h4 class="text-center mb-4">Lead Working</h4>
    <div class="row g-3">
      
      <div class="col-md-4">
          <input type="hidden" name="lead_id" value="<?= $leads['id'] ?>">

        <label for="f_name" class="form-label">First Name</label>
        <input type="text" name="f_name" value="<?= $leads['fname'] ?>" class="form-control" placeholder="Enter First Name">
      </div>

      <div class="col-md-4">
        <label for="mid_init" class="form-label">Middle Initial</label>
        <input type="text" name="u_father" value="<?= $leads['mid_init'] ?>" class="form-control" placeholder="Enter Middle Initial">
      </div>

      <div class="col-md-4">
        <label for="surname" class="form-label">Surname</label>
        <input type="text" name="u_mobile" value="<?= $leads['surname'] ?>" class="form-control" placeholder="Enter Surname">
      </div>

      <div class="col-md-4">
        <label for="phones" class="form-label">Phone</label>
        <input type="text" name="phones" value="<?= $leads['phones'] ?>" class="form-control" placeholder="Phone Number">
      </div>

      <div class="col-md-4">
        <label for="street" class="form-label">Street</label>
        <input type="text" name="street" value="<?= $leads['street'] ?>" class="form-control" placeholder="Street Address">
      </div>

      <div class="col-md-4">
        <label for="city" class="form-label">City</label>
        <input type="text" name="city" value="<?= $leads['city'] ?>" class="form-control" placeholder="City Name">
      </div>

      <div class="col-md-4">
        <label for="state_abb" class="form-label">State Abbreviation</label>
        <input type="text" name="state_abb" value="<?= $leads['state_abb'] ?>" class="form-control" placeholder="State">
      </div>

      <div class="col-md-4">
        <label for="zipcode" class="form-label">Zip Code</label>
        <input type="text" name="zipcode" value="<?= $leads['zipcode'] ?>" class="form-control" placeholder="Zip Code">
      </div>

      <div class="col-md-4">
        <label for="ssn" class="form-label">SSN</label>
        <input type="text" name="ssn" value="<?= $leads['ssn'] ?>" class="form-control" placeholder="Social Security Number">
      </div>

      <div class="col-md-4">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" value="<?= $leads['email'] ?>" class="form-control" placeholder="Email Address">
      </div>

      <div class="col-md-4">
        <label for="gen_code" class="form-label">Gen Code</label>
        <input type="text" name="gen_code" value="<?= $leads['gen_code'] ?>" class="form-control" placeholder="Gen Code">
      </div>

      <div class="col-md-4">
        <label for="dob" class="form-label">Date of Birth</label>
        <input type="date" name="jn_date" value="<?= $leads['dob'] ?>" class="form-control">
      </div>

      <div class="col-md-4">
        <label for="AA" class="form-label">AA</label>
        <input type="text" name="AA" value="<?= $leads['AA'] ?>" class="form-control" placeholder="AA Value">
      </div>
      
      <div class="col-md-4 report_request" style="display: none;">
    <label for="Report Required" class="form-label">Report Required</label>
    <?php if ($report_request_enable == 1): ?>
    <p style="color:red; font-weight:bold;">Request sending enabled for this lead</p>
<?php else: ?>
    <select class="form-control" name="report_request" id="report_request_dropdown">
        <option value="">Report Required</option>
        <option value="yes" <?= ($report_request == 1 || $report_request === 'yes') ? 'selected' : '' ?>>YES</option>
        <option value="no" <?= ($report_request === 'no' || $report_request == 0) ? 'selected' : '' ?>>NO</option>
    </select>
<?php endif; ?>


</div>

    </div>
  </div>

  <div class="card shadow-lg p-4 mb-4">
    <h4 class="text-center mb-3">Switch Role</h4>
    <div class="row g-3">
      <div class="col-md-4">
        <label for="roleSelect" class="form-label">Select Role</label>
        <select class="form-control" id="roleSelect" name="role">
          <option value="">-- Choose Role --</option>
          <option value="agent">Agent</option>
          <option value="super_agent">Super Agent</option>
          <option value="qualifier">Qualifier</option>
          <option value="closer">Closer</option>
        </select>
      </div>

      <div class="col-md-4">
        <label for="userSelect" class="form-label">Select User</label>
        <select class="form-control" id="userSelect" name="assigned_user">
          <option value="">-- Choose User --</option>
        </select>
      </div>
    </div>
  </div>

  <div class="card shadow-lg p-4 mb-4">
    <h4 class="text-center mb-3">Lead Working</h4>
    <div class="row g-3">
      <div class="col-md-4 amount">
        <label for="final_amount" class="form-label">Final Amount</label>
        <input type="number" name="final_amount" class="form-control" placeholder="Enter Final Amount" value="<?= $amount??'' ?>">
      </div>
      
      <div class="col-md-4 revert">
        <label for="final_amount" class="form-label">Revert</label>
       <select class="form-control" name="revert">
           <option>Revert</option>
           <option value="1">Revert To Qualifier</option>
       </select>
      </div>

      <div class="col-md-12">
        <label for="remarks" class="form-label">Working Area</label>
<textarea name="remarks" style="height:150px !important" class="form-control"><?= htmlspecialchars($remarks !== null ? $remarks : '') ?></textarea>



       <input type="hidden" name="user_role" value="<?= $this->session->userdata('role') ?>"> 

    </div>


    </div>
  </div>
    <br>
  <div class="text-center mb-4">
  <div class="d-flex justify-content-center gap-3">
    <button type="submit" class="btn btn-success px-5 py-2">Submit</button>
    <button type="button" class="btn btn-primary px-4 py-2" onclick="copyFormData()">Copy Data</button>
  </div>
</div>

</form>



          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
<!-- Role Dropdown -->


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="userForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Authentication</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>

        <div class="modal-body">
          <!-- Hidden User ID -->
          <input type="hidden" id="selectedUserId" name="user_id">

          <!-- Show Role -->
          <div class="form-group">
            <label>Role</label>
            <input type="text" class="form-control" id="selectedUserRole" name="role" readonly>
          </div>

          <!-- Password Field -->
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" id="userPassword" name="password" required>
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</div>


<script>
    var loggedInRole = "<?= $this->session->userdata('role'); ?>";      // PHP variable with logged-in user's role
    var loggedInUserId = "<?= $this->session->userdata('user_id'); ?>"; // PHP variable with logged-in user's ID

    // Set role dropdown to logged in user's role
    $('#roleSelect').val(loggedInRole);

    // Function to load users for given role and select logged-in user
    function loadUsersByRole(role, selectedUserId = null) {
        if (role !== '') {
            $.ajax({
                url: '<?= site_url('LeadsProcess/get_users_by_role') ?>',  // Replace with your URL
                type: 'POST',
                data: { role: role },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        var users = response.users;
                        var options = '<option value="">Select User</option>';

                        $.each(users, function (index, user) {
                            var selected = (user.user_id == selectedUserId) ? 'selected' : '';
                            options += '<option value="' + user.user_id + '" ' + selected + '>' + user.u_name + '</option>';
                        });

                        $('#userSelect').html(options);
                    } else {
                        $('#userSelect').html('<option value="">' + response.message + '</option>');
                    }
                }
            });
        } else {
            $('#userSelect').html('<option value="">Select User</option>');
        }
    }

    // On page load, load users of logged in role and select logged in user
    $(document).ready(function () {
        loadUsersByRole(loggedInRole, loggedInUserId);
    });

    // Also update users dropdown on role change by user
    $('#roleSelect').on('change', function () {
        var selectedRole = $(this).val();
        loadUsersByRole(selectedRole);
    });
</script>

<script>
    $('#userSelect').on('change', function () {
        var userId = $(this).val();
        var userRole = $('#roleSelect').val(); // Get selected role

        if (userId !== "") {
            $('#selectedUserId').val(userId);        // Set hidden user ID
            $('#selectedUserRole').val(userRole);    // Set visible role
            $('#userModal').modal('show');           // Show modal
        }
    });

    // Form submission (optional)
    $('#userForm').on('submit', function (e) {
        e.preventDefault();
        var userId = $('#selectedUserId').val();
        var role = $('#selectedUserRole').val();
        var password = $('#userPassword').val();

        console.log("User ID:", userId);
        console.log("Role:", role);
        console.log("Password:", password);

        // Optional: Send via AJAX or submit form

        $('#userModal').modal('hide');
    });
    
    
   $('#userForm').on('submit', function (e) {
    e.preventDefault();
    var userId = $('#selectedUserId').val();
    var role = $('#selectedUserRole').val();
    var password = $('#userPassword').val();

    $.ajax({
        url: '<?= base_url("LeadsProcess/login_user") ?>',
        method: 'POST',
        data: {
            user_id: userId,
            password: password,
            role: role
        },
        success: function (response) {
            var res = JSON.parse(response);
            if (res.status === 'success') {
                alert("User logged in successfully!");
                $('#userModal').modal('hide');
                location.reload(); // Refresh page to reflect new session
            } else {
                alert(res.message);
            }
        }
    });
});

</script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('roleSelect');
    const amountDiv = document.querySelector('.amount');

    function toggleAmountField() {
      if (roleSelect.value === 'closer') {
        amountDiv.style.display = 'block';
      } else {
        amountDiv.style.display = 'none';
      }
    }

    // Initial check on page load
    toggleAmountField();

    // Check on role change
    roleSelect.addEventListener('change', toggleAmountField);
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('roleSelect');
    const amountDiv = document.querySelector('.revert');

    function toggleAmountField() {
      if (roleSelect.value === 'closer') {
        amountDiv.style.display = 'block';
      } else {
        amountDiv.style.display = 'none';
      }
    }

    // Initial check on page load
    toggleAmountField();

    // Check on role change
    roleSelect.addEventListener('change', toggleAmountField);
  });
</script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('roleSelect');
    const amountField = document.querySelector('.amount');
    const remarksField = document.getElementById('remarks'); // Add ID in textarea
    const userSelect = document.getElementById('userSelect');

    // Show/hide Final Amount based on role
    function toggleFinalAmountField() {
      amountField.style.display = (roleSelect.value === 'closer') ? 'block' : 'none';
    }

    toggleFinalAmountField();

    roleSelect.addEventListener('change', function () {
      toggleFinalAmountField();
    });
    
    // Lock roles after agent submits
    <?php
    $session_role = $this->session->userdata('role');
    if ($session_role == 'agent_done') : ?>
      roleSelect.value = 'qualifier';
      roleSelect.querySelector('option[value="agent"]').disabled = true;
    <?php elseif ($session_role == 'qualifier_done') : ?>
      roleSelect.value = 'closer';
      roleSelect.querySelector('option[value="agent"]').disabled = true;
      roleSelect.querySelector('option[value="qualifier"]').disabled = true;
    <?php endif; ?>
  });
</script>
<script>
function copyFormData() {
  const form = document.querySelector("form");
  const inputs = form.querySelectorAll("input, select, textarea");
  let copiedText = "Lead Form Data:\n\n";

  inputs.forEach(input => {
    const label = form.querySelector(`label[for="${input.name}"]`);
    const labelText = label ? label.textContent.trim() : input.name;
    let value = input.value;
    if (input.tagName === "SELECT") {
      value = input.options[input.selectedIndex]?.text || "";
    }
    copiedText += `${labelText}: ${value}\n`;
  });

  // Copy to clipboard
  navigator.clipboard.writeText(copiedText).then(() => {
    alert("Form data copied to clipboard!");
  }).catch(err => {
    console.error("Copy failed", err);
    alert("Failed to copy data.");
  });
}
</script>

<script>
$(document).ready(function(){
    var role = $('#roleSelect').val(); // get selected or hidden input value
    if (role === 'agent' || role === 'super_agent') {
        $('.report_request').show();
    } else {
        $('.report_request').hide();
    }

    // If role can change dynamically
    $('#user_role').on('change', function() {
        var newRole = $(this).val();
        if (newRole === 'agent' || newRole === 'super_agent') {
            $('.report_request').show();
        } else {
            $('.report_request').hide();
        }
    });
});
</script>
<script>
    $(document).ready(function () {
        const lead_id = <?= isset($leads['id']) ? $leads['id'] : 'null'; ?>;

        $('#report_request_dropdown').change(function () {
            const report_request = $(this).val();

            if (report_request === '') return;

            if(lead_id === null){
                alert('Lead ID not found!');
                return;
            }

            $.ajax({
                url: "<?= base_url('LeadsProcess/ajaxSubmitReportRequest') ?>",
                method: "POST",
                data: {
                    report_request: report_request,
                    lead_id: lead_id
                },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Report request has been submitted',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message || 'Something went wrong',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'AJAX Error',
                        text: 'Request failed. Please try again.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });
    });
</script>

