<div id="content">
    <div class="panel box-shadow-none content-header">
        <div class="panel-body">
            <div class="col-md-12">
                <h3 class="animated fadeInLeft">Import Leads File</h3>
                <p class="animated fadeInDown">
                   
                </p>
            </div>
        </div>
    </div>
    <div class="form-element">
        <div class="col-md-12 padding-0">
            <div class="col-md-12">
                <div class="panel form-element-padding">
                    <div class="panel-heading">
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

                        <form method="post" action="<?= site_url('LeadUploading/upload_excel') ?>" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-sm-2 control-label text-right">
                                    <i class="fa fa-file-excel-o text-success"></i> Upload Excel
                                </label>
                                <div class="col-sm-10">
                                    <div class="drop-zone" id="drop-zone">
                                        <div class="icon"><i class="fa fa-cloud-upload"></i></div>
                                        <p>Drag & drop your Excel file here or click to select</p>
                                        <input type="file" id="excel_file" name="excel_file" accept=".xls,.xlsx" required>
                                        <div id="file-name"></div>
                                    </div>
                                    <small class="form-text text-muted mt-2">Only .xls or .xlsx files are allowed. Max 5MB.</small>
                                </div>
                            </div>

                            <div class="form-group text-center" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-success btn-lg">
                                    <i class="fa fa-upload"></i> Upload File
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
    const fileInput = document.getElementById("excel_file");
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
