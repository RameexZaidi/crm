<div id="content">
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading">
          <h3>Blank Leads</h3>
        </div>
        <div class="panel-body">
          <form action="<?= site_url('BlankLead/store') ?>" method="POST">
  <div class="row g-3">
    <div class="col-md-4">
      <label for="fname" class="form-label">First Name</label>
      <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter First Name">
    </div>

    <div class="col-md-4">
      <label for="mid_init" class="form-label">Middle Initial</label>
      <input type="text" class="form-control" name="mid_init" id="mid_init" placeholder="Enter Middle Initial">
    </div>

    <div class="col-md-4">
      <label for="surname" class="form-label">Surname</label>
      <input type="text" class="form-control" name="surname" id="surname" placeholder="Enter Surname">
    </div>

    <div class="col-md-4">
      <label for="phones" class="form-label">Phones <small class="text-muted">(comma-separated)</small></label>
      <input type="text" class="form-control" name="phones" id="phones" placeholder="Enter Phone Numbers"/>
    </div>

    <div class="col-md-4">
      <label for="street" class="form-label">Street</label>
      <input type="text" class="form-control" name="street" id="street" placeholder="Enter Street Address">
    </div>

    <div class="col-md-4">
      <label for="city" class="form-label">City</label>
      <input type="text" class="form-control" name="city" id="city" placeholder="Enter City">
    </div>

    <div class="col-md-4">
      <label for="state_abb" class="form-label">State Abbreviation</label>
      <input type="text" class="form-control" name="state_abb" id="state_abb" placeholder="e.g. NY, TX">
    </div>

    <div class="col-md-4">
      <label for="zipcode" class="form-label">Zip Code</label>
      <input type="text" class="form-control" name="zipcode" id="zipcode" placeholder="Enter Zip Code">
    </div>

    <div class="col-md-4">
      <label for="ssn" class="form-label">SSN</label>
      <input type="text" class="form-control" name="ssn" id="ssn" placeholder="XXX-XX-XXXX" pattern="\d{3}-\d{2}-\d{4}" title="Format: XXX-XX-XXXX">
    </div>

    <div class="col-md-4">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
    </div>

    <div class="col-md-4">
      <label for="gen_code" class="form-label">Gen Code</label>
      <input type="text" class="form-control" name="gen_code" id="gen_code" placeholder="Enter Gen Code">
    </div>

    <div class="col-md-4">
      <label for="dob" class="form-label">Date of Birth</label>
      <input type="date" class="form-control" name="dob" id="dob">
    </div>
  </div>
<!-- Existing fields above here -->

<div class="row g-3 mt-3">

  <!-- XFC fields -->
  <div class="col-md-4">
    <label for="XFC01" class="form-label">XFC01</label>
    <input type="text" class="form-control" name="XFC01" id="XFC01">
  </div>
  <div class="col-md-4">
    <label for="XFC02" class="form-label">XFC02</label>
    <input type="text" class="form-control" name="XFC02" id="XFC02">
  </div>
  <div class="col-md-4">
    <label for="XFC03" class="form-label">XFC03</label>
    <input type="text" class="form-control" name="XFC03" id="XFC03">
  </div>
  <div class="col-md-4">
    <label for="XFC04" class="form-label">XFC04</label>
    <input type="text" class="form-control" name="XFC04" id="XFC04">
  </div>
  <div class="col-md-4">
    <label for="XFC05" class="form-label">XFC05</label>
    <input type="text" class="form-control" name="XFC05" id="XFC05">
  </div>
  <div class="col-md-4">
    <label for="XFC06" class="form-label">XFC06</label>
    <input type="text" class="form-control" name="XFC06" id="XFC06">
  </div>
  <div class="col-md-4">
    <label for="XFC07" class="form-label">XFC07</label>
    <input type="text" class="form-control" name="XFC07" id="XFC07">
  </div>

  <!-- DEMO and SCORE fields -->
  <div class="col-md-4">
    <label for="DEM10" class="form-label">DEM10</label>
    <input type="text" class="form-control" name="DEM10" id="DEM10">
  </div>
  <div class="col-md-4">
    <label for="DEMO7" class="form-label">DEMO7</label>
    <input type="text" class="form-control" name="DEMO7" id="DEMO7">
  </div>
  <div class="col-md-4">
    <label for="DEMO9" class="form-label">DEMO9</label>
    <input type="text" class="form-control" name="DEMO9" id="DEMO9">
  </div>
  <div class="col-md-4">
    <label for="SCORE1" class="form-label">SCORE1</label>
    <input type="text" class="form-control" name="SCORE1" id="SCORE1">
  </div>
  <div class="col-md-4">
    <label for="DEM02" class="form-label">DEM02</label>
    <input type="text" class="form-control" name="DEM02" id="DEM02">
  </div>
  <div class="col-md-4">
    <label for="DEM08" class="form-label">DEM08</label>
    <input type="text" class="form-control" name="DEM08" id="DEM08">
  </div>

  <!-- ARV fields -->
  <div class="col-md-4">
    <label for="ARV05" class="form-label">ARV05</label>
    <input type="text" class="form-control" name="ARV05" id="ARV05">
  </div>
  <div class="col-md-4">
    <label for="ARV06" class="form-label">ARV06</label>
    <input type="text" class="form-control" name="ARV06" id="ARV06">
  </div>
  <div class="col-md-4">
    <label for="ARV16" class="form-label">ARV16</label>
    <input type="text" class="form-control" name="ARV16" id="ARV16">
  </div>
  <div class="col-md-4">
    <label for="ARV17" class="form-label">ARV17</label>
    <input type="text" class="form-control" name="ARV17" id="ARV17">
  </div>
  <div class="col-md-4">
    <label for="ARV18" class="form-label">ARV18</label>
    <input type="text" class="form-control" name="ARV18" id="ARV18">
  </div>

</div>

  <div class="mt-4 text-end">
    <button type="submit" class="btn btn-primary">Submit</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
  </div>
</form>

        </div>
      </div>
    </div>
  </div>
</div>
