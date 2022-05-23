// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataTable').DataTable({
    responsive: true,
    "paging":   false,
		"ordering": false,
		"info":     false,
    "searching": false
  });
});
