  <div id="content">
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Uploaded report Listing</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Firstname</th>
                          <th>Mid Initial</th>
                          <th>Surname</th>
                          <th>Report</th>
                          <th>Change Request</th>
                        </tr>
                      </thead>
                      <tbody>
                         <?php $sno=1; foreach($uploaded_report as $report): ?>
                            <tr>
                                <td><?= $sno++ ?></td>
                                <td><?= $report->fname ?></td>
                                <td><?= $report->mid_init ?></td>
                                <td><?= $report->surname ?></td>
                                <td><a href="javascript:void(0);" onclick="openReport('<?= base_url() ?>/<?= $report->fileupload ?>')">View Report</a></td>
                                <td>
                                    <a href="<?= site_url('ChangeRequest/RequestForChange/'.$report->id.' ') ?>">Change Request</a>
                                </td>
                            </tr>
                         <?php endforeach; ?>
                      </tbody>
                      </table>
                      </div>
                  </div>
                </div>
                <div id="reportContainer" style="display: none; margin-top: 20px; position: relative;">
                    <button onclick="closeReport()" style="
                        position: absolute;
                        top: -10px;
                        right: 0;
                        background-color: red;
                        color: white;
                        border: none;
                        padding: 5px 10px;
                        cursor: pointer;
                        border-radius: 3px;
                    ">Close</button>
                
                    <iframe id="reportFrame" src="" width="100%" height="600px" frameborder="0"></iframe>
                </div>

              </div>  
              </div>
            </div>
       
            
            <script>
function openReport(url) {
    document.getElementById('reportContainer').style.display = 'block';
    document.getElementById('reportFrame').src = url;
}

function closeReport() {
    document.getElementById('reportFrame').src = ""; // Clear iframe
    document.getElementById('reportContainer').style.display = 'none';
}
</script>

<script>
function loadReport(url) {
    var iframe = document.getElementById('reportFrame');
    iframe.src = url;

    iframe.onload = function () {
        try {
            var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;

            // Agar header/footer ka tag naam ya class maaloom hai, yahan change karo
            let header = iframeDoc.querySelector('header');
            let footer = iframeDoc.querySelector('footer');

            if (header) header.style.display = 'none';
            if (footer) footer.style.display = 'none';
        } catch (e) {
            console.warn("Iframe content not accessible due to cross-origin.");
        }
    };

    document.getElementById('reportContainer').style.display = 'block';
}

function closeReport() {
    document.getElementById('reportContainer').style.display = 'none';
    document.getElementById('reportFrame').src = '';
}
</script>

