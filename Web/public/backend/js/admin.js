$(document).ready(function () {
    //check all checkbox
    $("#cb_All").click(function () {
        $(".check-box").prop('checked', $(this).prop('checked'));
    });

    $('.btn-edit-story').click(function(){
        var storyId = $(this).parent().parent().attr('story-id');
        var url = window.location.pathname + '/edit/' + storyId;
        window.open(url, "_self");
    });

    $('.btn-delete-item').click(function() {   
        var storyId = $(this).parent().parent().attr('story-id'); 
        $.confirm({
            title: 'Xóa bối cảnh',
            content: 'Bạn muốn xóa chứ?',
            columnClass: 'small',
            buttons: {
                Xóa: function () {
                    var url = window.location.pathname + '/delete/' + storyId;
                    window.open(url, "_self");
                },
                Không: function () {
                    
                }
            }
        });
    });
    // Code
    $('.btn-delete-code').click(function() {   
        var codeId = $(this).parent().parent().attr('code-id'); 
        $.confirm({
            title: 'Xóa mã đăng nhập',
            content: 'Bạn muốn xóa chứ?',
            columnClass: 'small',
            buttons: {
                Xóa: function () {
                    var url = window.location.pathname + '/delete/' + codeId;
                    window.open(url, "_self");
                },
                Không: function () {
                    
                }
            }
        });
    });
    //submit delete all checked quiz
    // code inside this function will run when #delete_all_quiz on click
    $("#delete_all_code").on('click', function () { 
        //define list of quiz id when click on checkbox
        var list_id = [];
        $('input[name="ckb"]:checked').each(function(){
            var $this = $(this);
            //push quiz id into list
            list_id.push($this.attr('id'));
        });
        
        var token = $("#_token").val();

        $.confirm({
            title: 'Xóa lựa chọn',
            content: 'Bạn muốn xóa chứ?',
            columnClass: 'small',
            buttons: {
                Xóa: function () {
                    $.post("/admin/code/deleteall/", {'list_id': list_id, '_token': token}, function(id) {
                        for (var i = 0; i < list_id.length; i++) {
                            $("#code_" + list_id[i]).remove();               
                        }
                    })
                },
                Không: function () {
                    
                }
            }
        });
 
    });
    // User
    $('.btn-delete-user').click(function() {   
        var userId = $(this).parent().parent().attr('user-id'); 
        $.confirm({
            title: 'Xóa người dùng',
            content: 'Bạn muốn xóa chứ?',
            columnClass: 'small',
            buttons: {
                Xóa: function () {
                    var url = window.location.pathname + '/delete/' + userId;
                    window.open(url, "_self");
                },
                Không: function () {
                    
                }
            }
        });
    });

});
