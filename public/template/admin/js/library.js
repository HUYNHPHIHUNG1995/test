(function($){
    checkAll=()=>{
        if($('#checkAll').length){
            $(document).on('click','#checkAll',function(){
                let isChecked=$(this).prop('checked');
                $('.checkboxItem').prop('checked',isChecked);
                
                $('.checkboxItem').each(function(){
                    let _this=$(this)
                    changeBackground(_this)
                })
            })
        }
    }
    checkBoxItem=()=>{
        if($('.checkboxItem').length){
            $(document).on('click','.checkboxItem',function(){
                let _this=$(this)
                changeBackground(_this)
                isAllChecked();
            })
        }
    }

    isAllChecked=()=>{
        let allChecked=$('.checkboxItem:checked').length === $('.checkboxItem').length; //true or false
        $('#checkAll').prop('checked',allChecked)
    }
        

    changeBackground=(object)=>{
        let isCheck= object.prop('checked')
        if(isCheck){
            object.closest('tr').addClass('active-bg')
        }else{
            object.closest('tr').removeClass('active-bg')
        }
    }

    var _token= $('meta[name="csrf-token"]').attr('content');
    changeStatus=()=>{
        $(document).on('change','.status',function(e){
            e.preventDefault();
            let _this=$(this)
            //get idUser and get publish colunm and model and field
            let option ={
                'value': _this.val(),
                'modelId': _this.attr('data-modelId'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                '_token' : _token
            }
            $.ajax({
                url:'ajax/dashboard/changeStatus',
                data:option,
                type:'POST',
                dataType:'json',
                success:function(res){
                    $('#deleteCategory2').modal('show');
                },
                error:function(jqXHR,textStatus,errorThrown){

                }
            });
        })
    }

    changeStatusAll=()=>{
        
        if($('.changeStatusAll').length){
            $(document).on('click','.changeStatusAll',function(e){
                
                let _this=$(this)
                let id = []
                
                $('.checkboxItem').each(function(){
                    let checkbox = $(this)
                    if(checkbox.prop('checked')){
                        id.push(checkbox.val())
                    }
                })
                
                let option ={
                    'value': _this.attr('data-value'),
                    'model' : _this.attr('data-model'),
                    'field' : _this.attr('data-field'),
                    'id' : id,
                    '_token' : _token
                }
                
                $.ajax({
                    url:'ajax/dashboard/changeAllStatus',
                    data:option,
                    type:'POST',
                    dataType:'json',
                    success:function(res){
                        location.reload();
                    },
                    error:function(jqXHR,textStatus,errorThrown){
    
                    }
                });
                e.preventDefault();
            })
        }
    }
    
    deletedUser=()=>{
        $('.deleteUser').click(function (e) {
            e.preventDefault();
            var id = $(this).val();
            //get email by emailclass
            var classemailvalue='.emailvalue'+id
            var email=$(classemailvalue).val();
            $('#modal-category_name').html(email);

            $('#user_id').val(id);
            $('#deleteCategory').modal('show');
        })
    }
 
    //
    var HT={};
    switchery=()=>{
        $('.js-switch').each(function(){
            var switchery = new Switchery(this, { color: '#1AB394', size:'small'});
        });
    }
    $(document).ready(function(){
        switchery();
        deletedUser();
        changeStatus();
        checkAll();
        checkBoxItem();
        isAllChecked();
        changeStatusAll();
    });
})(jQuery);
