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

<form action="<?= site_url('BlankLead/update/' . $leads['id']) ?>" method="post" enctype="multipart/form-data">

  <div class="card shadow-lg p-4 mb-4">
    <h4 class="text-center mb-4">Blank Lead Detail</h4>
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
        <select class="form-control" name="report_request">
            <option value="">Report Required</option>
            <option value="yes">YES</option>
            <option value="no">NO</option>
        </select>
    </div>
     <div class="col-md-4 amount">
        <label for="final_amount" class="form-label">Change Request From</label>
        <input type="text" name="u_name" class="form-control" placeholder="Enter Final Amount" value="<?= $leads['u_name']??'' ?>" readonly>
      </div>
      
      <div class="col-md-4 amount">
        <label for="final_amount" class="form-label">User Type</label>
        <input type="text" name="u_name" class="form-control" placeholder="Enter Final Amount" value="<?= $leads['up_type']??'' ?>" readonly>
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


