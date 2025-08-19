<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<div id="content">
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading"><h3>Assign Leads to Group</h3></div>
        <form method="post" action="<?= site_url("LeadAssign/assign_leads_to_group") ?>">
        <div class="panel-body">
          <div class="form-group">
            <label>Select Lead Type</label>
            <select class="form-control" id="lead_type" name="lead_type">
              <option value="cc_leads_a">Lead A</option>
              <option value="cc_leads_b">Lead B</option>
              <!-- Add more if needed -->
            </select>
          </div>

          <div class="form-group">
            <label>Select Employee Group</label>
            <select class="form-control" name="grp_id" id="grp_id">
              <?php foreach ($groups as $group): ?>
                <option value="<?= $group->id ?>"><?= $group->grp_name ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label>Number of Leads Per Agent</label>
            <input type="number" class="form-control" id="lead_count" name="lead_count" placeholder="e.g. 10" min="1">
          </div>

          <button type="submit" class="btn btn-primary" id="assign_btn">Assign</button>
          <div id="response" style="margin-top:15px;"></div>
        </div>
        </form>
          <!-- Include SweetAlert2 JS (from CDN) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    <?php if ($this->session->flashdata('success')): ?>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '<?= $this->session->flashdata("success") ?>',
            confirmButtonColor: '#3085d6'
        });
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: '<?= $this->session->flashdata("error") ?>',
            confirmButtonColor: '#d33'
        });
    <?php endif; ?>
</script>


      </div>
    </div>
  </div>
</div>



