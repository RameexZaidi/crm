  <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<style>
   h2 {
      text-align: center;
    }

    textarea {
      width: 100%;
      height: 400px;
      padding: 15px;
      font-size: 16px;
      box-sizing: border-box;
      resize: none;
      border: 1px solid #ccc;
      border-radius: 8px;
      background: #fff;
    }

    .buttons {
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
    }

    button {
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      background-color: #4285f4;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }

    button:hover {
      background-color: #306fd0;
    }
  </style>
</style>
  <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                  </div>
              </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Notepad</h3></div>
                    <div class="panel-body">
                      <div class="responsive-table">
                        <h2>📝 My Notepad</h2>
                          <textarea id="note" placeholder="Start writing here..."></textarea>

                          <div class="buttons">
                            <button onclick="saveNote()">Save</button>
                            <button onclick="downloadNote()">Download</button>
                            <button onclick="clearNote()">Clear</button>
                          </div>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
            
<script>
    const textarea = document.getElementById('note');

    // Load saved note
    window.onload = function () {
      const saved = localStorage.getItem('my_note');
      if (saved) textarea.value = saved;
    };

    // Save note to localStorage
    function saveNote() {
      localStorage.setItem('my_note', textarea.value);
      alert('Note saved!');
    }

    // Download note as text file
    function downloadNote() {
      const blob = new Blob([textarea.value], { type: 'text/plain' });
      const a = document.createElement('a');
      a.href = URL.createObjectURL(blob);
      a.download = 'my_note.txt';
      a.click();
    }

    // Clear the textarea and localStorage
    function clearNote() {
      if (confirm("Clear all content?")) {
        textarea.value = '';
        localStorage.removeItem('my_note');
      }
    }
  </script>