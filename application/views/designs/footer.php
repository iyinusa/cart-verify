		<!-- Javascript -->
        <script src="<?php echo base_url(); ?>js/plugins/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/jquery-ui/jquery-ui-1.10.4.min.js" type="text/javascript"></script>
		
		<!-- Bootstrap -->
        <script src="<?php echo base_url(); ?>js/plugins/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/gritter/jquery.gritter.min.js" type="text/javascript"></script>
		
		<!-- Charts -->
		<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.resize.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.pie.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.stack.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url(); ?>js/plugins/flot/jquery.flot.crosshair.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/jquery-jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/jquery-jvectormap/jquery-jvectormap-europe-merc-en.js" type="text/javascript"></script>
		
		<!-- Interface -->
        <script src="<?php echo base_url(); ?>js/plugins/jquery-countTo/jquery.countTo.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/pace/pace.min.js" type="text/javascript"></script>
		
		<!-- Forms -->
        <script src="<?php echo base_url(); ?>js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/bootstrap-file-input/bootstrap-file-input.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/datepicker/datepicker.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/daterangepicker/daterangepicker.html" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/dropzone/dropzone.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/switchery/switchery.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>js/custom.js" type="text/javascript"></script>
		
		<!-- Dashboard -->
        <script type="text/javascript">
		(function($) {
		"use strict";
			// number count
			$('.timer').countTo();
			
			//TagsInput
			$("[data-toggle='tags']").tagsinput({ 
				tagClass: function(item) { 
					return 'label label-primary';
				} 
			});
			
			//File Input
			$('.file-inputs').bootstrapFileInput();
			
			//Bootstrap WYSIHTML5
			$(".bs-texteditor").wysihtml5();
			
			//DataTable
			$("#example1").dataTable();
			$('#example2').dataTable({
				"bPaginate": true,
				"bLengthChange": false,
				"bFilter": false,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": false
			});
			
			// chat scroll
			$('#chat-box').slimScroll({
				height: '250px'
			}); 
			
			//iCheck
			$("input[type='checkbox'], input[type='radio']").iCheck({
				checkboxClass: 'icheckbox_minimal',
				radioClass: 'iradio_minimal'
			});
	
			// ToDo
			$('#checkbox').on('ifChecked', function(event){
				$('.check').addClass('through')
			});
			$('#checkbox').on('ifUnchecked', function(event){
				$('.check').removeClass('through')
			});
			
			// gritter
			//setTimeout(function() {
//                $.gritter.add({
//                    title: 'You have one new task for today',
//                    text: 'Go and check <a href="mailbox.html" class="text-warning">tasks</a> to see what you should do.<br/> Check the date and today\'s tasks.'
//                });
//            }, 2000);
			
			// flot
						var v1 = [[1,50],[2,53],[3,40],[4,55],[5,47],[6,39],[7,44],[8,55],[9,43],[10,61],[11,52],[12,57],[13,64],[14,54],[15,49],[16,55],[17,53],[18,57],[19,68],[20,71],[21,84],[22,72],[23,88],[24,74],[25,87],[26,83],[27,76],[28,86],[29,93],[30,95]];
						var v2= [[1,13],[2,18],[3,14],[4,25],[5,23],[6,17],[7,20],[8,26],[9,24],[10,27],[11,32],[12,37],[13,32],[14,28],[15,25],[16,21],[17,25],[18,33],[19,30],[20,27],[21,35],[22,28],[23,29],[24,28],[25,34],[26,27],[27,40],[28,29],[29,33],[30,45]];
						var C= ["#7fb9d1","#e65353"];
						var plot = $.plot("#placeholder", [
							{ data: v1, label: "Total Visitors",lines:{fillColor: "#f8fcfd"}},
							{ data: v2, label: "Unique Visitors",lines:{fillColor: "#fdf8f8"}}
						], {
							series: {
								lines: {
									show: true,
									fill: true
								},
								points: {
									show: true
								},
								shadowSize: 0
							},
							grid: {
								hoverable: true,
								clickable: true,
								aboveData: true,
								borderWidth: 0
							},
							legend:{
								noColumns: 0,
								margin: [0,-23],
								labelBoxBorderColor: null
							},
							colors: C,
							tooltip: true
						});

						function showTooltip(x, y, contents) {
							$("<div id='flot_tip'>" + contents + "</div>").css({
								top: y - 20,
								left: x + 5,
							}).appendTo("body").fadeIn(200);
						}

						var previousPoint = null;
						$("#placeholder").bind("plothover", function (event, pos, item) {
						if (item) {
							if (previousPoint != item.dataIndex) {
								previousPoint = item.dataIndex;
								$("#flot_tip").remove();
								var x = item.datapoint[0].toFixed(0),
								y = item.datapoint[1].toFixed(0);
								showTooltip(item.pageX, item.pageY,
										 y + " " + item.series.label + " on the " + x + "th");
								}
								} else {
									$("#flot_tip").remove();
									previousPoint = null;            
								}
							});

			// jvectormap
			$('#map').vectorMap({
				map: 'europe_merc_en',
				zoomMin: '3',
				backgroundColor: "#fff",
				focusOn: { x: 0.5, y: 0.7, scale: 3 },
				markers: [
					{latLng: [42.5, 1.51], name: 'Andorra'},
					{latLng: [43.73, 7.41], name: 'Monaco'},
					{latLng: [47.14, 9.52], name: 'Liechtenstein'},
					{latLng: [41.90, 12.45], name: 'Vatican City'},
					{latLng: [43.93, 12.46], name: 'San Marino'},
					{latLng: [35.88, 14.5], name: 'Malta'}
				    ],
				    markerStyle: {
				      initial: {
				        fill: '#fa4547',
				        stroke: '#fa4547',
					    "stroke-width": 6,
					    "stroke-opacity": 0.3,
    				      }
				    },	
				regionStyle: {
					initial: {
						fill: '#e4e4e4',
						"fill-opacity": 1,
						stroke: 'none',
						"stroke-width": 0,
						"stroke-opacity": 1
					}
				}
			});
		})(jQuery);
		</script> 
    </body>

</html>