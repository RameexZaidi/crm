<div id="content">
 

  <div class="col-md-12 top-20 padding-0">
    <div class="col-md-12">
      <div class="panel">
        <div class="panel-heading"><h3>Lead Tracking</h3></div>
        <div class="panel-body">
          <div class="row">
           <table class="table table-hover table-bordered" id="leadTable">
    <thead>
        <tr>
            <th>Firstname</th>
            <th>Mid Initial</th>
            <th>Surname</th>
            <th>Phone</th>
            <th>Action</th> <!-- New column for Copy -->
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><?= $lead['fname'] ?></td>
            <td><?= $lead['mid_init'] ?></td>
            <td><?= $lead['surname'] ?></td>
            <td><?= $lead['phones'] ?></td>
            <td>
                <button class="btn btn-sm btn-primary" onclick="copyRowWithHeaders(this)">Copy</button>
            </td>
        </tr>
    </tbody>
</table>

<script>
function copyRowWithHeaders(button) {
    const row = button.closest("tr");
    const cells = row.querySelectorAll("td");
    const headers = document.querySelectorAll("#leadTable thead th");

    let text = "";

    for (let i = 0; i < cells.length - 1; i++) { // skip last column (Action)
        let header = headers[i].innerText.trim();
        let value = cells[i].innerText.trim();
        text += `${header}: ${value}\n`;
    }

    navigator.clipboard.writeText(text).then(() => {
        alert("Row copied with column names!");
    }).catch(err => {
        console.error("Copy failed", err);
        alert("Failed to copy row.");
    });
}
</script>

            <!-- Agent Card -->
            <div class="col-md-3">
              <div class="card" style="border:1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                <h4>👨‍💼 Agent</h4>
                <p><strong>Name:</strong> <?php $agent_name = $this->Deal_model->GetName($lead['agent_id']); echo $agent_name['u_name']; ?></p>
                <p><strong>Remarks:</strong> <?= $lead['agent_remarks'] ?></p>
                <p><strong>Date & Time:</strong> <?= $lead['remarks_at'] ?></p>
              </div>
            </div>
            
            
            <!-- Super Agent Card -->
            <div class="col-md-3">
              <div class="card" style="border:1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                <h4>⭐ Super Agent</h4>
                <p><strong>Name:</strong> 
                  <?php 
                    $agent_name = $this->Deal_model->GetName($lead['super_agent_id']); 
                    echo $agent_name['u_name']; 
                  ?>
                </p>
                <p><strong>Remarks:</strong> <?= $lead['super_agent_remarks'] ?></p>
                <p><strong>Date & Time:</strong> <?= $lead['super_agent_remarks_at'] ?></p>
              </div>
            </div>


            <!-- Qualifier Card -->
            <div class="col-md-3">
              <div class="card" style="border:1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                <h4>📋 Qualifier</h4>
                <p><strong>Name:</strong> <?php $agent_name = $this->Deal_model->GetName($lead['qualifier_id']); echo $agent_name['u_name']; ?></p>
                <p><strong>Remarks:</strong> <?= $lead['qualifier_remarks'] ?></p>
                <p><strong>Date & Time:</strong> <?= $lead['qualifier_remarks_at'] ?></p>
              </div>
            </div>

            <!-- Closer Card -->
            <div class="col-md-3">
              <div class="card" style="border:1px solid #ddd; border-radius: 8px; padding: 15px; margin-bottom: 20px;">
                <h4>🤝 Closer</h4>
                <p><strong>Name:</strong> <?php $agent_name = $this->Deal_model->GetName($lead['closer_id']); echo $agent_name['u_name']; ?></p>
                <p><strong>Remarks:</strong> <?= $lead['closer_remarks'] ?></p>
                <p><strong>Date & Time:</strong> <?= $lead['closer_remarks_at'] ?></p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>  
  </div>
</div>
