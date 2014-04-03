var Product = function () {

     var initTable = function() {
        var oTable = $('#product_list').dataTable( {           
            "aoColumnDefs": [
                { "aTargets": [ 0 ] }
            ],
            "aaSorting": [[1, 'asc']],
             "aLengthMenu": [
                [5, 15, 20, -1],
                [5, 15, 20, "All"] // change per page values here
            ],
            // set the initial value
            "iDisplayLength": 10,
        });

        jQuery('#product_list_wrapper .dataTables_filter input').addClass("form-control input-small"); // modify table search input
        jQuery('#product_list_wrapper .dataTables_length select').addClass("form-control input-small"); // modify table per page dropdown
        jQuery('#product_list_wrapper .dataTables_length select').select2(); // initialize select2 dropdown

        $('#sample_2_column_toggler input[type="checkbox"]').change(function(){
            /* Get the DataTables object again - this is not a recreation, just a get of the object */
            var iCol = parseInt($(this).attr("data-column"));
            var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
            oTable.fnSetColumnVis(iCol, (bVis ? false : true));
        });
    },
    reload = function(){
        $.ajax({
            url:msg.base_url+'admin/products/lists',
            dataType:'json',
            success:function(data){
                if(data.code == '1000')
                {
                    $('#product_list').find('tbody').html('');
                    var tr = '';
                    $.each(data.data,function(key,item){
                        tr = '<tr>'
                           + '<tr><td>'+item.code+'</td>'
                           + '<td>'+item.name+'</td>'
                           + '<td>'+item.price+'</td>'
                           + '<td>'+item.best_price+'</td>'
                           + '<td></td>'
                           + '<tr>';
                        $('#product_list').find('tbody').append(tr);
                    })
                }
            }
        })
    }

    return {

        //main function to initiate the module
        init: function () {
            
            if (!jQuery().dataTable) {
                return;
            }

            initTable();
        },
        reload: function(){
            reload();
        }
    };

}();

