@extends('openexam::admin.layouts.app')

@section('content')
<!-- Bootstrap CSS -->
        <!-- sweetalert-->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.css">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
<div class="container">        
<h2>Openexam > Dashboard Management</h2>
<button type="button" class="btn btn-primary" id="btnAdd">Add New</button>
<br/><br/>
<table class="table table-bordered" id="tblData">
				<thead>
			        <tr>
			         	<th>ID</th>
			            <th>Title</th>
			            <th>Detail</th>                
			            <th>Created At</th>
			            <th>Updated At</th>
			            <th>Action</th>			            
			        </tr>
			    </thead>
			</table>
</div>			
<!-- start addmodal-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlAddData">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Form</h4>
            </div>
            <div class="modal-body">
            <form role="form" id="frmDataAdd">
                <div class="form-group">
                    <label for="title" class="control-label">
                    Title<span class="required">*</span>
                    </label>
                    <input type="text" class="form-control" id="title" name="title">
                    <p class="errorTitle text-danger hidden"></p>
                </div>           
                <div class="form-group">
                    <label for="detail" class="control-label">
                    Detail<span class="required">*</span>
                    </label>
                    <input type="text" class="form-control" id="detail" name="detail">
                    <p class="errorDetail text-danger hidden"></p>
                </div>                
            </form>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSave"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- start endmodal-->

<!-- start editmodal-->
<div class="modal fade" tabindex="-1" role="dialog" id="mdlEditData">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Form</h4>
            </div>
            <div class="modal-body">
            <form role="form" id="frmDataEdit">
                <div class="form-group">
                    <label for="edit_ID" class="control-label">
                    ID
                    </label>
                    <input type="text" class="form-control" id="edit_ID" name="id" disabled>
                </div>  
                <div class="form-group">
                    <label for="edit_title" class="control-label">
                    Title<span class="required">*</span>
                    </label>
                    <input type="text" class="form-control" id="edit_title" name="title">
                    <p class="edit_errorTitle text-danger hidden"></p>
                </div>           
                <div class="form-group">
                    <label for="edit_detail" class="control-label">
                    Detail<span class="required">*</span>
                    </label>
                    <input type="text" class="form-control" id="edit_detail" name="detail">
                    <p class="edit_errorDetail text-danger hidden"></p>
                </div>                    
            </form>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnUpdate"><i class="glyphicon glyphicon-save"></i>&nbsp;Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end editmodal-->			
@endsection

@push('package-scripts')
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        
        <!-- sweetalert-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" type="text/javascript" charset="utf-8" async defer></script>
        <!-- App scripts -->
<script>

var table;

$('document').ready(function(){
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	table = $('#tblData').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('admin.openexam.dashboard.get') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'detail', name: 'detail' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action' , name : 'action', orderable : false ,searchable: false},            
        ]
    });
    
  //calling add modal 
    $('#btnAdd').click(function(e){
        $('#mdlAddData').modal('show');
    });
    
  //Adding new data
    $('#btnSave').click(function(e){
        e.preventDefault();
        var frm = $('#frmDataAdd');
        $.ajax({
            url : "{!! route('admin.openexam.dashboard.store') !!}",
            type : 'POST',
            //dataType: 'json',
            data : {                 
                title : $('#title').val(),
                detail : $('#detail').val(),                 
            },
            success:function(data){
                $('.errorTitle').addClass('hidden');
                $('.errorDetail').addClass('hidden');
                
                if (data.errors) {
                    if (data.errors.title) {
                        $('.errorTitle').removeClass('hidden');
                        $('.errorTitle').text(data.errors.title);
                    }
                    if (data.errors.detail) {
                        $('.errorDetail').removeClass('hidden');
                        $('.errorDetail').text(data.errors.detail);
                    }                    
                }
                if (data.success == true) {
                    $('#mdlAddData').modal('hide');
                    frm.trigger('reset');
                    table.ajax.reload(null,false);
                    swal('success!','Successfully Added','success');
                }
            }
        });
    }); 

  //calling edit modal and id info of data
    $('#tblData').on('click','.btnEdit[data-edit]',function(e){
        e.preventDefault();
        var url = $(this).data('edit');
        
         $.ajax({
			url : url,
			type : 'GET',
			datatype : 'json',
			success:function(data){
    			$('#edit_ID').val(data.id);
    			$('#edit_title').val(data.title);
    			$('#edit_detail').val(data.detail);
                            
				$('.edit_errorTitle').addClass('hidden');
				$('.edit_errorDetail').addClass('hidden');
                            
				$('#mdlEditData').modal('show');                            
			}
        });        
    });
// updating data infomation
    $('#btnUpdate').on('click',function(e){
        e.preventDefault();
        var url = "{!! route('admin.openexam.dashboard.update','itemid') !!}";
        var editid = $('#edit_ID').val();
        url = url.replace(/itemid/, editid);
        
        var frm = $('#frmDataEdit');

        var data = getFormData(frm);
        
        $.ajax({
            type :'POST',
            url : url,
            dataType : 'json',
            data : data,
            success:function(data){
                // console.log(data);
                /*if (data.errors) {
                    if (data.errors.edit_name) {
                        $('.edit_errorName').removeClass('hidden');
                        $('.edit_errorName').text(data.errors.edit_name);
                    }
                    if (data.errors.edit_contact) {
                        $('.edit_errorContact').removeClass('hidden');
                        $('.edit_errorContact').text(data.errors.edit_contact);
                    }                    
                }*/
                if (data.success == true) {
                    // console.log(data);
                    $('.edit_errorTitle').addClass('hidden');
                    $('.edit_errorDetail').addClass('hidden');                    
                    frm.trigger('reset');
                    $('#mdlEditData').modal('hide');
                    swal('Success!','Data Updated Successfully','success');
                    table.ajax.reload(null,false);
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Please Reload to read Ajax');
                }
        });
    });

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }




  //deleting data
    $('#tblData').on('click','.btnDelete[data-remove]',function(e){
        e.preventDefault();
        var url = $(this).data('remove');
      //pop up
        swal({
            title: "Are you sure ??",
            text: 'msg', 
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
        	  $.ajax({
                  url : url,
                  type: 'POST',
                  dataType : 'json',
                  data : { method : '_DELETE' , submit : true},
                  success:function(data){
                      if (data == 'Success') {
                    	  swal("Poof! Your imaginary file has been deleted!", {
                              icon: "success",
                            });
                          table.ajax.reload(null,false);
                      }
                  }
              });
          } else {
            swal("Your imaginary file is safe!");
          }
        });
    });

       
});
</script>
@endpush
