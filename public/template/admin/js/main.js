$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Xóa mà không thể khôi phục. Bạn có chắc ?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Xóa lỗi vui lòng thử lại');
                }
            }
        })
    }
}

//upload file
$('#upload').change(function(){
    const form=new FormData();//tao form submit ajax
    form.append('file',$(this)[0].files[0]);//lay du lieu tu form
    $.ajax({
       //cau hinh cho ajax
       processData: false,//khong cho bien thanh chuoi
       contentType:false,//dung de upload file
        type:'JSON',
        data:form,
        url:'/admin/upload/services',
        success:function(result)
        {

        }
    });
});
