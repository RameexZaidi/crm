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
                        .mapping-table {
                            max-width: 700px;
                            margin: auto;
                            box-shadow: 0 0 15px rgba(0,0,0,0.1);
                            border-radius: 10px;
                            overflow: hidden;
                        }
                        .mapping-table th, .mapping-table td {
                            vertical-align: middle !important;
                        }
                        .table thead th {
                            background-color: #343a40;
                            color: white;
                        }
                    </style>
                       

                        <form method="post" action="<?= site_url('LeadUploading/process_mapping') ?>">
        <div class="card mapping-table">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th style="width: 50%">Excel Column Name</th>
                        <th>Map to DB Field</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($header as $index => $colName): ?>
                        <tr>
                            <td><strong><?= htmlspecialchars($colName) ?></strong></td>
                            <td>
                                <select name="mapping[<?= $index ?>]" class="form-control" required>
                                    <option value="">-- Select DB Field --</option>
                                    <?php foreach ($db_fields as $field): ?>
                                        <option value="<?= $field ?>" 
                                            <?= strtolower(trim($colName)) == strtolower(trim($field)) ? 'selected' : '' ?>>
                                            <?= strtoupper($field) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Process Upload</button>
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
