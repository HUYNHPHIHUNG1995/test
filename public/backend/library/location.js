(function($){
    //add user
    getLocation=()=>{
        //ca 2 select tp,quan deu dat chung ten class location
        $(document).on('change','.location',function () {
            let _this=$(this)
            //let province_id=_this.val()
            let option =
                {
                    'data':{
                        'id':_this.val()
                    },
                    'target' : _this.attr('data-target')
                }
            sendDataTogetLocation(option)
        });
    }
    //ham dung cho tong huong doi tuong
    sendDataTogetLocation=(option)=>{
        $.ajax({
            url:'ajax/location/getLocation',
            data:option,
            type:'GET',
            dataType:'json',
            success:function(res){
                $('.'+option.target).html(res['res'].html)
                //xu ly submit form ko thanh cong giu lai du lieu cu
                if(district_id != '' && option.target == 'districts'){

                    $('.districts').val(district_id).trigger('change')
                }

                if(ward_id != '' && option.target=='wards'){
                    $('.wards').val(ward_id).trigger('change')
                }
            },
            error:function(jqXHR,textStatus,errorThrown){
                //alert(textStatus + errorThrown)
                $('.district').html(res['res'].html)
            }
        });
    }

    loadCity =()=>{
        if(province_id !=''){
            $('.province').val(province_id).trigger('change');
        }
    }

    $(document).ready(function(){
        getLocation();
        loadCity();
    });
})(jQuery);
