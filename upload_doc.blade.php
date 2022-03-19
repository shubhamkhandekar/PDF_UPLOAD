<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 17%;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #F3F3F3;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

/* .sidenav a:hover {
  color: #f1f1f1;
} */

.header_doc_name{
    width: 100%;
    height: 50px;
    background-color: #4077E4;
}
.main {
  margin-left: 17%; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.item .item-content {
    padding: 30px 35px
}

.image-upload {
    width: 100%;
    height: 60px;
    border: 1px dashed #ddd;
    border-radius: 5px;
    position: relative;
    background: #f8f8f9;
    color: #666;
    overflow: hidden
}

.item-wrapper form img {
    margin-bottom: 20px;
    width: auto;
    height: auto;
    max-height: 400px;
    width: auto;
    border-radius: 5px;
    overflow: hidden
}

.image-upload img {
    height: 100% !important;
    width: auto !important;
    border-radius: 0px;
    margin: 0 auto
}

.image-upload i {
    font-size: 25px;
    color: #ccc
}

.image-upload input {
    cursor: pointer;
    opacity: 0;
    height: 100%;
    width: 100%;
    z-index: 10;
    position: absolute;
    top: 0;
    left: 0
}

.item-wrapper input {
    height: 43px;
    line-height: 43px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 20px
}
.uploaded_files{
height: 76px;
width: 100%;
border-radius: 2px;
background-color:#FFFFFF;
}
.show_doc{
    height:1000px;
    width:100%;
}
.doc_name{
    font: optional;
    color:white;
    margin-left:15px;
}
</style>
</head>
<body>

<div class="sidenav">
        <form data-validation="true" action="#" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id='token'>
            <div class="item-inner">
                <div class="item-content">
                    <div class="image-upload"> <span>FILS</span><label style="cursor: pointer; margin-left:76%" for="file_upload"> <img src="" alt="" class="uploaded-image">
                            <div class="h-100">
                                <div class="dplay-tbl">
                                    <div class="dplay-tbl-cell"> <i class="fa fa-upload"></i>
                                    </div>
                                </div>
                            </div>
                            <input onchange="doc_upload()" type="file" name="pdf_file" id="doc_name" class="image-input" data-traget-resolution="image_resolution" value="" accept=".pdf">
                        </label>
                    </div>
                </div>
            </div>
        </form>
        <hr>
        @foreach($data as $val)
        <div class="uploaded_files"><a onclick="showfile('{{ asset($val->url) }}','{{$val->name}}')"; href="#">{{$val->name}}</a></div><hr>
        @endforeach
</div>
<div class="main">
  <div class="header_doc_name"><lable class="doc_name" id="doc_name_lable">Document #1</lable></div>
  <iframe class="show_doc" id="show_document" src="file:///C:/laravel/document_upload/document_upload/storage/app/public/document/1647715681BAMS%20list.pdf"></iframe>
  </div>
</body>
<script>
    function doc_upload(){
        alert('yes');
        var file_data = $('#doc_name').prop('files')[0];  
        var token = $('#token').val();
        var form_data = new FormData();                  
        form_data.append('pdf_file', file_data);
        form_data.append('_token',token);
        alert(form_data);                             
        $.ajax({
            url: '/upload_pdf', 
            dataType: 'text',  
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(res){
                var res_new = JSON.parse(res);
                alert(res_new.msg);
            }
        });
    }

    function showfile(url,name){
        //alert(url);
        $("#doc_name_lable").text(name)
        document.getElementById('show_document').src = url;

    }
</script>
</html> 
