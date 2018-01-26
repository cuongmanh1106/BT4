// JavaScript Document
// Các hàm kiểm tra và hỏi xóa
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
function Kiemtradulieu()
{
	var kt=document.getElementsByClassName("kiemtra");
	for(i=0;i<kt.length;i++)
	{
		if(kt.item(i).value=="")
		{
			alert(kt.item(i).getAttribute("data_error"));
			kt.item(i).focus();
			return false; 	
		}	
	}
	return true;
}
function Xoadulieu(id_xoa,tbl_xoa,field_xoa)
{
	if(confirm("Dữ liệu sẽ bị xóa, Không thể phục hồi lại\nBạn có chắc không?"))
	{
		//window.location="xoadulieu.php?id_xoa=" + id_xoa + "&tbl_xoa="+ tbl_xoa + "&field_xoa=" + field_xoa;
		// url
		var url="xoadulieu.php";
		// data
		var data={"id_xoa":id_xoa,"tbl_xoa":tbl_xoa,"field_xoa":field_xoa};
		
		$.post(url,data,function(data){
				// Hiển thị kết quả trả về 
				$("#kqXoa").text(data);
				$("#kqXoa").css({"color":"#F00","font-weight":"bold"});
			})
		.done(function () { // Thành công
			window.setTimeout('location.reload()', 2000)
		})
			
	}
	
}
function Xoasanpham()
{
	if(confirm("Dữhồi lại\nBạn có chắc không?"))
	{
		return true;
	}
	return false;
}
function check_password() {
	var passsword = document.getElementById("password");
	var password_confirm = document.getElementById("password_confirm");
	 if(password.value != password_confirm.value) {
	 	alert('fail confirm password!!! please confirm password');
	 	return false;
	 } 
	 return true;
}
function kiemtratim()
{
	var tim = document.getElementById("tim");
	if(tim.value== "")
	{
		alert('Vui lòng nhập nội dung cần tìm');
		return false;
	}
	return true;
}

$("div.alert").delay(3000).slideUp();

$(document).ready(function () {
	$("#addImages").click(function() {
        $("#insert").append('<div class="form-group"><div class="col-lg-6"><input type="file" name="fEditDetail[]" id="iamge"></div></div>')
    });
});

$(document).ready(function () {
    $('a#del_img').on('click',function () {
        var url = 'http://localhost/BT4/admin/product/delimg/'; // chạy vào route dẫn đến controller getDelImg
        var _token = $("form[name='frmEditProduct']").find("input[name='_token']").val();//khi dùng đến from thì phải lấy token
        var img = $(this).parent().find("img").attr("src"); //tìm thằng cha của thằng đang truy cập là a#del_img là thẻ img dể lấy ra attribute("src")
        var idImg = $(this).parent().find("img").attr("idHinh");
        var rid = $(this).parent().find("img").attr("id");
        $.ajax({
            url:url + idImg,
            type:'GET',
            cache:false,
            data: {"_token":_token,"idImg":idImg,"urlImg":img},
            success: function(data) {
                if(data == "ok")
                    $("#"+rid).remove();
                else {
                    alert("Error!!!");
                }
            }
        });
    });
});

