<div id="content">
	<div class="col-md-12 top-20 padding-0">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-heading">
					<h3>Past Un-Assign Leads Listing</h3>
				</div>
				<div class="panel-body">
					<div class="responsive-table">
						<div class="table-responsive">

							<!-- Search + RowsPerPage + GoToPage -->
							<div class="d-flex justify-content-between align-items-center mb-2">
								<div class="mb-3 text-end">
									<input type="text" id="searchBox"
										   class="form-control d-inline-block"
										   style="width:200px; float: right"
										   placeholder="Search leads...">
								</div>

								<div>
									<label>Rows per page: </label>
									<select id="rowsPerPage" class="form-select d-inline-block w-auto">
										<option value="5">5</option>
										<option value="10" selected>10</option>
										<option value="25">25</option>
										<option value="50">50</option>
									</select>

									<label class="ms-3">Go to page: </label>
									<select id="goToPage" class="form-select d-inline-block w-auto"></select>
								</div>
							</div>

							<!-- Table -->
							<table id="leadTable" class="table table-striped table-bordered" width="100%" cellspacing="0">
								<thead>
								<tr>
									<th>#</th>
									<th>Fname</th>
									<th>Mid init</th>
									<th>Surname</th>
									<th>Phones</th>
									<th>Street</th>
									<th>City</th>
									<th>State Abb</th>
									<th>ZipCode</th>
									<th>Upload Date</th>
									<th>Detail</th>
								</tr>
								</thead>
								<tbody>
								<?php $sno=1; foreach ($leads as $lead): ?>
									<tr>
										<td><?= $sno++ ?></td>
										<td><?= $lead->fname ?></td>
										<td><?= $lead->mid_init ?></td>
										<td><?= $lead->surname ?></td>
										<td><?= $lead->phones ?></td>
										<td><?= $lead->street ?></td>
										<td><?= $lead->city ?></td>
										<td><?= $lead->state_abb ?></td>
										<td><?= $lead->zipcode ?></td>
										<td><?= date('d-m-Y',strtotime($lead->up_date)) ?></td>
										<td><a href="#" class="btn btn-primary btn-sm"><i class="fa fa-list"></i></a></td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>

							<!-- Pagination Buttons -->
							<div id="pagination" class="mt-3"></div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(function () {
		let rowsPerPage = parseInt($("#rowsPerPage").val()) || 10;
		let currentPage = 1;
		let searchTerm = "";

		const $table   = $("#leadTable");
		const $tbody   = $table.find("tbody");
		const $allRows = $tbody.find("tr");

		function getFilteredRows() {
			if (!searchTerm) return $allRows;
			return $allRows.filter(function () {
				return $(this).text().toLowerCase().indexOf(searchTerm) > -1;
			});
		}

		function buildGoToPage(totalPages) {
			let html = "";
			for (let i = 1; i <= totalPages; i++) {
				html += `<option value="${i}" ${i === currentPage ? "selected" : ""}>${i}</option>`;
			}
			$("#goToPage").html(html);
		}

		function buildPager(totalPages) {
			let html = `
				<button class="btn btn-sm btn-light first-btn" ${currentPage === 1 ? "disabled" : ""}>First</button>
				<button class="btn btn-sm btn-light prev-btn" ${currentPage === 1 ? "disabled" : ""}>Prev</button>
				<button class="btn btn-sm btn-light next-btn" ${currentPage === totalPages ? "disabled" : ""}>Next</button>
				<button class="btn btn-sm btn-light last-btn" ${currentPage === totalPages ? "disabled" : ""}>Last</button>
			`;
			$("#pagination").html(html);
		}

		function paginate() {
			const $filtered = getFilteredRows();
			const totalRows = $filtered.length;
			const totalPages = Math.max(1, Math.ceil(totalRows / rowsPerPage));

			if (currentPage > totalPages) currentPage = totalPages;
			if (currentPage < 1) currentPage = 1;

			$allRows.hide();
			const start = (currentPage - 1) * rowsPerPage;
			const end   = start + rowsPerPage;
			$filtered.slice(start, end).show();

			buildPager(totalPages);
			buildGoToPage(totalPages);

			if (totalRows === 0) {
				if (!$tbody.find("tr.no-data").length) {
					const colCount = $table.find("thead th").length || 1;
					$tbody.append(`<tr class="no-data"><td colspan="${colCount}" class="text-center">No matching records found</td></tr>`);
				}
			} else {
				$tbody.find("tr.no-data").remove();
			}
		}

		// events
		$(document).on("click", ".first-btn", function () { currentPage = 1; paginate(); });
		$(document).on("click", ".prev-btn",  function () { currentPage--; paginate(); });
		$(document).on("click", ".next-btn",  function () { currentPage++; paginate(); });
		$(document).on("click", ".last-btn",  function () {
			const $filtered = getFilteredRows();
			currentPage = Math.ceil($filtered.length / rowsPerPage);
			paginate();
		});

		$("#searchBox").on("keyup", function () {
			searchTerm = $(this).val().toLowerCase();
			currentPage = 1;
			paginate();
		});

		$("#rowsPerPage").on("change", function () {
			rowsPerPage = parseInt($(this).val()) || 10;
			currentPage = 1;
			paginate();
		});

		$("#goToPage").on("change", function () {
			currentPage = parseInt($(this).val());
			paginate();
		});

		// first render
		paginate();
	});
</script>
