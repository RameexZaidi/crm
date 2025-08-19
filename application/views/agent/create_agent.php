<!-- Dropzone CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet" />
<!-- Dropzone JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>

<div id="content">
  <div class="panel box-shadow-none content-header">
    <div class="panel-body">
    </div>
  </div>
  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading"><h3>Create Agent</h3></div>
        <div class="panel-body">
          <div class="responsive-table">
            <form action="<?= site_url('Agent/store') ?>" method="post" enctype="multipart/form-data">
              <div class="row">
                 <div class="form-group col-md-4">
                  <label>First Name</label>
                  <input type="text" name="f_name" placeholder="Firstname"  class="form-control" name="Father Name">
                </div>
                <div class="form-group col-md-4">
                  <label>Father Name</label>
                  <input type="text" name="u_father" placeholder="Lastname" class="form-control" name="Father Name">
                </div>
                <div class="form-group col-md-4">
                  <label>Mobile</label>
                  <input type="text" name="u_mobile" placeholder="Mobile" class="form-control" required>
                </div>

                <div class="form-group col-md-4">
                  <label>Whatsapp</label>
                  <input type="text" name="u_whatsapp" class="form-control" placeholder="Whatsapp">
                </div>

                <div class="form-group col-md-4">
                  <label>Email</label>
                  <input type="email" name="u_email" class="form-control" placeholder="Email" required>
                </div>

                <div class="form-group col-md-4">
                  <label>Qualification</label>
                  <input type="text" name="u_qual" class="form-control" placeholder="Qualification">
                </div>

                <div class="form-group col-md-4">
                  <label>Date of Birth</label>
                  <input type="date" name="u_dob" class="form-control">
                </div>

                <div class="form-group col-md-4">
                  <label>Alternate Mobile</label>
                  <input type="text" name="u_mob2" class="form-control" placeholder="Alternate Mobile">
                </div>

                <div class="form-group col-md-4">
                  <label>Phone</label>
                  <input type="text" name="u_ph" class="form-control" placeholder="Landline">
                </div>

                <div class="form-group col-md-4">
                  <label>CNIC</label>
                  <input type="text" name="u_cnic" class="form-control" placeholder="CNIC">
                </div>
                
                 <div class="form-group col-md-4">
                  <label>Select Group</label>
                  <select class="form-control" name="grp_id">
                      <option value="">Select Group</option>
                      <?php foreach($groups as $group): ?>
                        <option value="<?= $group->id ?>"><?= $group->grp_name ?></option>
                      <?php endforeach; ?>    
                  </select>
                </div>
               

                <div class="form-group col-md-4">
                  <label>Gender</label>
                  <select name="u_gender" class="form-control">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label>Spouse</label>
                  <input type="text" name="u_spouse" class="form-control" placeholder="Spouse">
                </div>

                <div class="form-group col-md-4">
                  <label>Married</label>
                  <select name="married" class="form-control">
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                  </select>
                </div>

                <div class="form-group col-md-12">
                  <label>Address</label>
                  <textarea type="text" name="u_add" placeholder="Address" class="form-control"></textarea>
                </div>

                 <div class="form-group col-md-4">
                  <label>Country</label>
                  <select class="form-control" name="u_country">
                    <option>Select Country</option>
                    <option value="pak">Pakistan</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label>State</label>
                  <select class="form-control" name="u_state">
                    <option value="">Select State</option>
                    <option value="sindh">Sindh</option>
                    <option value="punjab">Punjab</option>
                    <option value="kpk">KPK</option>
                    <option value="balochistan">Balochistan</option>
                  </select>
                </div>

                <div class="form-group col-md-4">
                  <label>City</label>
                  <select class="form-control" name="u_city">
                    <option value="">Select City</option>
                    <option value="khi">Karachi</option>
                    <option value="hayd">Hyderabad</option>
                    <option value="lhr">Lahore</option>
                    <option value="isb">Islamabad</option>
                    <option value="qut">Quetta</option>
                    <option value="pesh">Peshawar</option>

                  </select>
                </div>

                
               

                <div class="form-group col-md-4">
                  <label>Joining Date</label>
                  <input type="date" name="jn_date" class="form-control">
                </div>

                <div class="form-group col-md-4">
                  <label>Rejoining Date</label>
                  <input type="date" name="rjn_dt" class="form-control">
                </div>

                <div class="form-group col-md-4">
                  <label>Salary</label>
                  <input type="number" name="u_sal" class="form-control" placeholder="Salary">
                </div>
                 <div class="form-group col-md-4">
                  <label>Select Role</label>
                  <select name="role" class="form-control">
                    <option value="sadmin">Super Admin</option>
                    <option value="admin">Admin</option>
                    <option value="agent">Agent</option>
                    <option value="super_agent">Super Agent</option>
                    <option value="qualifier">Qualifier</option>
                    <option value="closer">Closer</option>
                    <option value="report_manager">Report Manager</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <!-- File Uploads -->
               <!-- Profile Picture -->
                  <div class="form-group col-md-6">
                    <label>Profile Picture</label>
                    <div class="dropzone" id="profileDropzone"></div>
                  </div>

                  <!-- CNIC Front -->
                  <div class="form-group col-md-6">
                    <label>CNIC Front</label>
                    <div class="dropzone" id="cnicFrontDropzone"></div>
                  </div>

                  <!-- CNIC Back -->
                  <div class="form-group col-md-6">
                    <label>CNIC Back</label>
                    <div class="dropzone" id="cnicBackDropzone"></div>
                  </div>

                  <!-- CV File -->
                  <div class="form-group col-md-6">
                    <label>CV File</label>
                    <div class="dropzone" id="cvFileDropzone"></div>
                  </div>

                  <!-- Last File -->
                  <div class="form-group col-md-6">
                    <label>Last File</label>
                    <div class="dropzone" id="lastFileDropzone"></div>
                  </div>


                <!-- Hidden Fields -->
                <input type="hidden" name="cr_user" value="1">
                <input type="hidden" name="up_user" value="1">

                <div class="form-group col-md-12">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
<script>
Dropzone.autoDiscover = false;

function createDropzone(id) {
    return new Dropzone(id, {
        url: "<?= site_url('Agent/upload_file') ?>",
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.docx",
        success: function (file, response) {
            if (response.success) {
                // Optionally store uploaded filenames in hidden inputs
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = id.replace('#', '') + '_file[]';
                input.value = response.file_name;
                document.querySelector('form').appendChild(input);
            } else {
               
            }
        }
    });
}
createDropzone("#profileDropzone");
createDropzone("#cnicFrontDropzone");
createDropzone("#cnicBackDropzone");
createDropzone("#cvFileDropzone");
createDropzone("#lastFileDropzone");

</script>
