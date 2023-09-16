$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id,url) {
    if(confirm('Bạn có chắc chắn xóa dữ liệu ?')){
        $.ajax({
            type:'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error==false) {
                    alert(result.massage);
                    location.reload();
                }else{
                    alert('Lỗi,vui lòng thử lại');
                }
            }
        })
    }
}
