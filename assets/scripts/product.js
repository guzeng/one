
jQuery(document).ready(function() {
   Product.init();
});
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

function form_validate(data)
{
    if(typeof(data.code)!='undefined')
    {
        if(data.code == '1000')
        {
        console.log('ssssssss');
            window.location.href = msg.base_url+'admin/products';
        }
        else
        {
            if(typeof(data.error)!='undefined' && data.error != '')
            {
                $.each(data.error,function(key,item){
                    if(item!='' && $('input[name='+key+']').length > 0)
                    {
                        $('input[name='+key+']').parent().addClass('has-error');
                        $('input[name='+key+']').parent().find('span.help-block').html(item);
                    }
                })
            }            
        }
    }
}

function delete_product(id)
{
    $.ajax({
        url:msg.base_url+'admin/products/delete/'+id,
        dataType:'json',
        success:function(data){
            if(data.code=='1000')
            {
                $('#'+id).remove();
                show_success(data.msg);
            }
            else
            {
                show_error(data.msg);
            }
        },
        beforeSubmit:function(){
            loading();
        },
        error:function(){
            show_error();
        }
    })
}