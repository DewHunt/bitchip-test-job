<!-- Required Js -->
<script src="{{ asset('public/admin/assets/js/vendor-all.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/pcoded.min.js') }}"></script>
{{-- <script src="{{ asset('public/admin/assets/js/menu-setting.min.js') }}"></script> --}}


<!-- am chart js -->
<script src="{{ asset('public/admin/assets/plugins/chart-am4/js/core.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/chart-am4/js/charts.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/chart-am4/js/animated.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/chart-am4/js/maps.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/chart-am4/js/worldLow.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/chart-am4/js/continentsLow.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/switchery/dist/switchery.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/plugins/sweetalert/jquery.sweet-alert.custom.js') }}"></script>

<!-- datatable Js -->
<script src="{{ asset('public/admin/assets/plugins/data-tables/js/datatables.min.js') }}"></script>
<script src="{{ asset('public/admin/assets/js/pages/data-basic-custom.js') }}"></script>
{{-- <script src="{{ asset('public/admin/assets/plugins/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script> --}}

<!-- Summernote -->
<script src="{{ asset('public/admin/assets/plugins/summernote/summernote-bs4.js') }}"></script>

<!-- Date Range Picker js -->
<script src="{{ asset('public/admin/assets/datepicker/js/moment.js') }}"></script>
<script src="{{ asset('public/admin/assets/datepicker/js/daterangepicker.js') }}"></script>

<!-- Bootstrap Date Time Picker js -->
<script src="{{ asset('public/admin/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

<script>
    $(document).ready(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });

        // For select 2
        $(".select2").select2();

        // Date Time Picker
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        $('#date-time-picker').datetimepicker({
			format: "DD-MM-YYYY",
			defaultDate: today,
		});
    });
         
	var start = moment();
	var end = moment();
	show_daterange(start,end);

	function set_date(start, end) {
		$('#daterange-div .date-input-div input[name="from_date"]').val(start.format('YYYY-MM-DD'));
		$('#daterange-div .date-input-div input[name="to_date"]').val(end.format('YYYY-MM-DD'));
		$('#daterange-div span').html(start.format('MMMM D, YYYY')+' - '+end.format('MMMM D, YYYY'));
	}

	function show_daterange(start,end) {
		console.log('Start Date',start);
		console.log('End Date',end);
		$('#daterange-div').daterangepicker({
			startDate: start,
			endDate: end,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			}
		}, set_date);
		set_date(start, end);
	}

	/**
	* this is a example of summernote. this example must be placed in its own blade file.
	*
	* $(document).ready(function () {
	* $('#footerDesEditor,#bnFooterDesEditor,#footerTitle,#bnFooterTitle,#footerSubTitleEditor,#bnFooterSubTitleEditor').summernote({ height: 150 });
	* });
	*
	*/
</script>