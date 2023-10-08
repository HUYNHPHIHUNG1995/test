(function($){
    var document=$(document)
    var HT={}

    HT.inputImage=()=>{
        $(document).on('click','.input-image',function(){
            let _this=$(this)
            let fileUpload=_this.attr('data-upload')
            HT.BrowseServerInput(_this,fileUpload);//kieu Images hoac thay doi
        })
    }

    HT.BrowseServerInput=(object,type)=>{//type= images hoac thay doi
        if (typeof (type)=='undefined'){
            type=='Images';
        }
        var finder=new CKFinder();
        finder.resourceType=type;

        finder.selectActionFunction=function (fileUrl,data) {
            fileUrl=fileUrl.replace(BASE_URL,"/");
            object.val(fileUrl)
        }
        finder.popup();
    }

    document.ready(function(){
        HT.inputImage();
    });
})(jQuery);
