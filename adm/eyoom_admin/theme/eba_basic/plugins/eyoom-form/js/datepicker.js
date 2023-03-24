var Datepicker = function(){
    return {
        //Datepickers
        initDatepicker: function(){
	        // Select single date
	        $('#date').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>'
	        });

	        // Combine date range
	        $('#combine_start').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function(selectedDate){
	                $('#combine_finish').datepicker('option', 'minDate', selectedDate);
	            }
	        });
	        $('#combine_finish').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function(selectedDate){
	                $('#combine_start').datepicker('option', 'maxDate', selectedDate);
	            }
	        });

	        // Select date range
	        $('#start').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function(selectedDate){
	                $('#finish').datepicker('option', 'minDate', selectedDate);
	            }
	        });
	        $('#finish').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function(selectedDate){
	                $('#start').datepicker('option', 'maxDate', selectedDate);
	            }
	        });

	        // Single with inline
	        $('#inline').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>'
	        });

	        // Date range with inline
	        $('#inline-start').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function(selectedDate){
	                $('#inline-finish').datepicker('option', 'minDate', selectedDate);
	            }
	        });
	        $('#inline-finish').datepicker({
	            dateFormat: 'yy-mm-dd',
	            prevText: '<i class="fa fa-angle-left"></i>',
	            nextText: '<i class="fa fa-angle-right"></i>',
	            onSelect: function(selectedDate){
	                $('#inline-start').datepicker('option', 'maxDate', selectedDate);
	            }
	        });
        }
    };
}();