<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

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

<form action="<?= site_url('Deal/submitConversion') ?>" method="post" enctype="multipart/form-data">
  <div class="card shadow-lg p-4 mb-4">
    <h1 class="text-center mb-4">Lead Conversion</h1>
    <br>
    <div class="row g-3">
      <div class="col-md-4">
        <input type="hidden" name="lead_id" value="<?= $leads['lead_id'] ?>">
        <label class="form-label">First Name</label>
        <input type="text" name="f_name" value="<?= $leads['fname'] ?>" class="form-control" placeholder="Enter First Name">
      </div>

      <div class="col-md-4">
        <label class="form-label">Middle Initial</label>
        <input type="text" name="mid_init" value="<?= $leads['mid_init'] ?>" class="form-control" placeholder="Enter Middle Initial">
      </div>

      <div class="col-md-4">
        <label class="form-label">Surname</label>
        <input type="text" name="surname" value="<?= $leads['surname'] ?>" class="form-control" placeholder="Enter Surname">
      </div>

      <div class="col-md-4">
        <label class="form-label">Phone</label>
        <input type="text" name="phones" value="<?= $leads['phones'] ?>" class="form-control" placeholder="Phone Number">
      </div>

      <div class="col-md-4">
        <label class="form-label">Street</label>
        <input type="text" name="street" value="<?= $leads['street'] ?>" class="form-control" placeholder="Street Address">
      </div>

      <div class="col-md-4">
        <label class="form-label">City</label>
        <input type="text" name="city" value="<?= $leads['city'] ?>" class="form-control" placeholder="City Name">
      </div>

      <div class="col-md-4">
        <label class="form-label">State Abbreviation</label>
        <input type="text" name="state_abb" value="<?= $leads['state_abb'] ?>" class="form-control" placeholder="State">
      </div>

      <div class="col-md-4">
        <label class="form-label">Zip Code</label>
        <input type="text" name="zipcode" value="<?= $leads['zipcode'] ?>" class="form-control" placeholder="Zip Code">
      </div>

      <div class="col-md-4">
        <label class="form-label">SSN</label>
        <input type="text" name="ssn" value="<?= $leads['ssn'] ?>" class="form-control" placeholder="Social Security Number">
      </div>

      <div class="col-md-4">
        <label class="form-label">Email</label>
        <input type="email" name="email" value="<?= $leads['email'] ?>" class="form-control" placeholder="Email Address">
      </div>

      <div class="col-md-4">
        <label class="form-label">Gen Code</label>
        <input type="text" name="gen_code" value="<?= $leads['gen_code'] ?>" class="form-control" placeholder="Gen Code">
      </div>

      <div class="col-md-4">
        <label class="form-label">Date of Birth</label>
        <input type="date" name="dob" value="<?= $leads['dob'] ?>" class="form-control">
      </div>

      <div class="col-md-4">
        <label class="form-label">AA</label>
        <input type="text" name="AA" value="<?= $leads['AA'] ?>" class="form-control" placeholder="AA Value">
      </div>
    </div>
  </div>

  <!-- Lead Progress Section -->
  <div class="card shadow-lg p-4 mb-4">
    <h4 class="text-center mb-3">Lead Progress</h4>
    <?php if (!empty($assigned_users)): ?>
    <div class="row">

        <?php if (isset($assigned_users['agent'])): ?>
        <div class="col-md-3">
            <div class="card p-3 mb-3" style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                <h4>👨‍💼 Agent</h4>
                <p><strong>Name:</strong> <?= $assigned_users['agent']['u_name'] ?></p>
                <p><strong>Remarks:</strong> <?= $leads['agent_remarks'] ?></p>
                <?php if (isset($leads['agent_revert']) && $leads['agent_revert'] == 0): ?>
                    <div class="text-success"><i class="fa fa-check-circle"></i></div>
                <?php else: ?>
                    <div class="text-warning"><i class="fa fa-exclamation-triangle"></i> Revert</div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($assigned_users['super_agent'])): ?>
        <div class="col-md-3">
            <div class="card p-3 mb-3" style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                <h4>⭐ Super Agent</h4>
                <p><strong>Name:</strong> <?= $assigned_users['super_agent']['u_name'] ?></p>
                <p><strong>Remarks:</strong> <?= $leads['super_agent_remarks'] ?></p>
                <?php if (isset($leads['super_agent_revert']) && $leads['super_agent_revert'] == 0): ?>
                    <div class="text-success"><i class="fa fa-check-circle"></i></div>
                <?php else: ?>
                    <div class="text-warning"><i class="fa fa-exclamation-triangle"></i> Revert</div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($assigned_users['qualifier'])): ?>
        <div class="col-md-3">
            <div class="card p-3 mb-3" style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                <h4>📋 Qualifier</h4>
                <p><strong>Name:</strong> <?= $assigned_users['qualifier']['u_name'] ?></p>
                <p><strong>Remarks:</strong> <?= $leads['qualifier_remarks'] ?></p>
                <?php if (isset($leads['qualifier_revert']) && $leads['qualifier_revert'] == 0): ?>
                    <div class="text-success"><i class="fa fa-check-circle"></i></div>
                <?php else: ?>
                    <div class="text-warning"><i class="fa fa-exclamation-triangle"></i> Revert</div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <?php if (isset($assigned_users['closer'])): ?>
        <div class="col-md-3">
            <div class="card p-3 mb-3" style="border: 1px solid #e0e0e0; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                <h4>🤝 Closer</h4>
                <p><strong>Name:</strong> <?= $assigned_users['closer']['u_name'] ?></p>
                <p><strong>Remarks:</strong> <?= $leads['closer_remarks'] ?></p>
                <?php if (isset($leads['closer_revert']) && $leads['closer_revert'] == 0): ?>
                    <div class="text-success"><i class="fa fa-check-circle"></i></div>
                <?php else: ?>
                    <div class="text-warning"><i class="fa fa-exclamation-triangle"></i> Revert</div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>
</div>


  <!-- Final Submission Section -->
  <div class="card shadow-lg p-4 mb-4">
    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Final Amount</label>
        <input type="number" name="final_amount" class="form-control" value="<?= $leads['closer_amount'] ?>" placeholder="Enter Final Amount">
      </div>

      <div class="col-md-4">
        <label class="form-label">Status</label>
       <select class="form-control" id="statusSelect" name="status" required>
        <option value="">Select Status</option>
        <?php
        $statuses = ['Approve', 'Decline', 'Revert', 'Close And Die', 'Pending'];
        foreach ($statuses as $status):
        ?>
            <option value="<?= $status ?>" <?= (isset($deal_status) && $deal_status == $status) ? 'selected' : '' ?>>
                <?= $status ?>
            </option>
        <?php endforeach; ?>
    </select>
      </div>

      <!-- Revert Users Section -->
      <div class="col-md-12 mt-3" id="revertUsers" style="display: none;">
        <label class="form-label"><strong>Select Users to Revert</strong></label>
        <div class="row">
          <?php if (isset($assigned_users['agent'])): ?>
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="revert_users[]" value="<?= $assigned_users['agent']['id'] ?>" id="agentCheck">
              <label class="form-check-label" for="agentCheck">👨‍💼 Agent - <?= $assigned_users['agent']['u_name'] ?></label>
            </div>
          </div>
          <?php endif; ?>
         <?php if (isset($assigned_users['super_agent'])): ?>
            <div class="col-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="revert_users[]" value="<?= $assigned_users['super_agent']['id'] ?>" id="superAgentCheck">
                    <label class="form-check-label" for="superAgentCheck">⭐ Super Agent - <?= $assigned_users['super_agent']['u_name'] ?></label>
                </div>
            </div>
            <?php endif; ?>
    
          <?php if (isset($assigned_users['qualifier'])): ?>
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="revert_users[]" value="<?= $assigned_users['qualifier']['id'] ?>" id="qualifierCheck">
              <label class="form-check-label" for="qualifierCheck">📋 Qualifier - <?= $assigned_users['qualifier']['u_name'] ?></label>
            </div>
          </div>
          <?php endif; ?>

          <?php if (isset($assigned_users['closer'])): ?>
          <div class="col-md-4">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="revert_users[]" value="<?= $assigned_users['closer']['id'] ?>" id="closerCheck">
              <label class="form-check-label" for="closerCheck">🤝 Closer - <?= $assigned_users['closer']['u_name'] ?></label>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>

     <div class="col-md-12 mb-3">
        <label class="form-label">Remarks</label>
        <textarea class="form-control" name="remarks" placeholder="Enter Remarks" required><?= isset($admin_remarks) ? htmlspecialchars($admin_remarks) : '' ?></textarea>
    </div>
    </div>
  </div>
    <br><br>
  <div class="text-center">
    <button type="submit" class="btn btn-success px-5 py-2">Submit</button>
  </div>
</form>


          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
<!-- Role Dropdown -->
<script>
  $(document).ready(function() {
    $('#statusSelect').change(function() {
      var selectedStatus = $(this).val();

      if (selectedStatus === 'Revert') {
        $('#revertUsers').slideDown();
      } else {
        $('#revertUsers').slideUp();
        // Optional: Uncheck all checkboxes if not Revert
        $('#revertUsers input[type="checkbox"]').prop('checked', false);
      }
    });
  });
</script>

<script>
  document.querySelectorAll('input[name="revert_users[]"]').forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      if (this.checked) {
        document.querySelectorAll('input[name="revert_users[]"]').forEach(function(otherCheckbox) {
          if (otherCheckbox !== checkbox) {
            otherCheckbox.checked = false;
          }
        });
      }
    });
  });
</script>

<script>
  document.getElementById("statusSelect").addEventListener("change", function () {
    const revertSection = document.getElementById("revertUsers");
    revertSection.style.display = this.value === "Revert" ? "block" : "none";
  });
</script>

