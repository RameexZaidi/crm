<style>
                            .drop-zone {
                                border: 2px dashed #4CAF50;
                                padding: 40px;
                                text-align: center;
                                color: #999;
                                border-radius: 10px;
                                background: #f9f9f9;
                                transition: background 0.3s ease;
                                cursor: pointer;
                            }
                            .drop-zone.dragover {
                                background-color: #e8f5e9;
                                border-color: #2e7d32;
                            }
                            .drop-zone input {
                                display: none;
                            }
                            .drop-zone .icon {
                                font-size: 40px;
                                color: #4CAF50;
                                margin-bottom: 10px;
                            }
                            #file-name {
                                margin-top: 10px;
                                font-weight: bold;
                                color: #333;
                            }
                        </style>
<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Add Group Master</h3>
            </div>
        </div>
    </div>
    <div class="form-element">
        <div class="col-md-12 padding-0">
            <div class="col-md-12">
                <div class="panel form-element-padding">
                    <div class="panel-heading">Group Details</div>
                    <div class="panel-body" style="padding:30px;">
                        <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
                        <?php endif; ?>

                        <form method="post" action="<?= site_url('Group/store') ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Group Name</label>
                                <input type="text" name="grp_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Group Company</label>
                                <input type="text" name="grp_comp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Group Description</label>
                                <textarea name="grp_desc" class="form-control" rows="3" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Group Logo</label>
                                <div class="drop-zone" id="drop-zone">
                                    <div class="icon"><i class="fa fa-cloud-upload"></i></div>
                                    <p>Drag & drop your logo here or click to select</p>
                                    <input type="file" id="grp_logo" name="grp_logo" accept=".jpg,.jpeg,.png" required>
                                    <div id="file-name"></div>
                                </div>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fa fa-save"></i> Save Group
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const dropZone = document.getElementById("drop-zone");
    const fileInput = document.getElementById("grp_logo");
    const fileNameDisplay = document.getElementById("file-name");

    dropZone.addEventListener("click", () => fileInput.click());
    fileInput.addEventListener("change", function () {
        if (fileInput.files.length) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        }
    });

    dropZone.addEventListener("dragover", function (e) {
        e.preventDefault();
        dropZone.classList.add("dragover");
    });

    dropZone.addEventListener("dragleave", function () {
        dropZone.classList.remove("dragover");
    });

    dropZone.addEventListener("drop", function (e) {
        e.preventDefault();
        dropZone.classList.remove("dragover");
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            fileNameDisplay.textContent = e.dataTransfer.files[0].name;
        }
    });
});
</script>
