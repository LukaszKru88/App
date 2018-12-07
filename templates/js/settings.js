$(document).ready(function() {
    // $("form").submit(function(event) {
    //     event.preventDefault();
    //     var categoryType = $("#categoryType").val();
    //     var newName = $("#categoryName").val();
    //     var oldName = $(".manageCategory").val();

    //     $.ajax({
    //         url: 'index.php?task=settings$action=edit',
    //         method: 'POST',
    //         dataType: 'text',
    //         data: {
    //             categoryType: categoryType,
    //             newName: newName,
    //             oldName: oldName
    //         }, success: function(response) {
    //             alert("Sukces!");
    //         }
    //     });
    // });

            // $("#tableManager").on('hidden.bs.modal', function(){
            //     $("#showContent").fadeOut();
            //     $("#editContent").fadeIn();
            //     $("#editRowID").val(0);
            //     $("#shortDesc").val("");
            //     $("#longDesc").val("");
            //     $("#countryName").val("");
            //     $(".modal-title").val("");
            //     $("#closeBtn").fadeOut();
            //     $("#manageBtn").attr('value', "Add New").attr('onclick', "manageData('addNew')").fadeIn();
            // });

    //getExistingData(0, 10);
});

function getCategories(task, action, categoryType) {
    $.ajax({
        url: 'index.php',
        dataType: 'json',
        data: {
            task: task,
            action: action,
            categoryType: categoryType
        }, success: function(response) {
            $("#categoryList").html(response['categories']);
            $("#suggestedCategories").html(response['suggestedCategories']);
            $("#incomes").modal('show');
        }
    });
}

function addCategory(){
    var newCategory = $("#categoryName").val();
    var categoryType = $("#categoryType").val();

    $.ajax({
        url: 'index.php?task=settings&action=addCategory',
        method: 'POST',
        dataType: 'text',
        data: {
            newCategory: newCategory,
            categoryType: categoryType
        }, success: function(response) {
            if(response != "success"){
                $(".form-message").html(response);
            } else if(response == "success"){
                $("#incomes").modal('hide');
                $("#success-message").html("Pomyślnie dodano nową kategorię!");
                $("#success-message").fadeOut(3000, function(){
                    $("#success-message").html("");
                    $("#success-message").show();
                });
            }
        }
    });
}

function editCategory(){
    var categoryType = $("#categoryType").val();
    var newName = $("#categoryName").val();
    var oldName = $(".manageCategory:checked").val();
        
    $.ajax({
        url: 'index.php?task=settings&action=editCategory',
        method: 'POST',
        dataType: 'text',
        data: {
            categoryType: categoryType,
            newName: newName,
            oldName: oldName
        }, success: function(response) {
            if(response != "success"){
                $(".form-message").html(response);
            } else if(response == "success"){
                $("#incomes").modal('hide');
                $("#success-message").html("Pomyślnie edytowano kategorię!");
                $("#success-message").fadeOut(3000, function(){
                    $("#success-message").html("");
                    $("#success-message").show();
                });
            }
        }
    });
}

function deleteCategory() {
    var categoryType = $("#categoryType").val();
    var suggestion = $(".suggestion:checked").val();
    var deleteCategory = $(".manageCategory:checked").val();

    if(confirm("Czy na pewno chcesz usunąć tę kategorię")){
        $.ajax({
            url: 'index.php?task=settings&action=deleteCategory',
            method: 'POST',
            dataType: 'text',
            data: {
                categoryType: categoryType,
                suggestion: suggestion,
                deleteCategory: deleteCategory
            }, success: function(response) {
                console.log(response);
                if(response != "success"){
                    $(".form-message").html(response);
                } 
                else if(response == "success"){
                    $("#incomes").modal('hide');
                    $("#success-message").html("Pomyślnie usunięto kategorię!");
                    $("#success-message").fadeOut(3000, function(){
                        $("#success-message").html("");
                        $("#success-message").show();
                    });
                }
            }
        });
    }
}

$(function(){
    $("body").on('click', ".manageCategory",function(){
        $("#categoryName").val(this.value);
    });
});

$(function(){
    if($(".addButton").on("click", function(){
        $(".modal-title").html("DODAJ KATEGORIĘ");
        $(".form-message").html("");
        $("#categoryName").val("");
        $("#editBtnModal").hide();
        $("#deleteBtnModal").hide();
        $(".categories").hide();
        $("#deleteCategorie").hide();
        $("#addBtnModal").show();
        $("#categoryName").show();
        $(".userInfo").html("Poniżej wprowadź nazwę dodawanej kategorii");
        $("#incomes").modal('show');
    }));
    if($(".editButton").on("click", function(){
        $(".modal-title").html("EDYTUJ KATEGORIĘ");
        $(".form-message").html("");
        $("#categoryName").val("");
        $("#addBtnModal").hide();
        $("#deleteBtnModal").hide();
        $("#deleteCategorie").hide();
        $("#editBtnModal").show();
        $(".categories").show();
    }));
    if($(".deleteButton").on("click", function(){
        $(".modal-title").html("USUŃ KATEGORIĘ");
        $(".form-message").html("");
        $("#categoryName").val("");
        $("#addBtnModal").hide();
        $("#editBtnModal").hide();
        $("#deleteBtnModal").show();
        $(".categories").show();
        $("#deleteCategorie").show();
    }));
});

$(function(){
    $(".editButton").on('click',function(){
        $(".userInfo").html("Zaznacz edytowaną kategorię a następnie podaj nową nazwę");
        $("#categoryName").show();
    });
});

$(function(){
    $(".deleteButton").on('click',function(){
        $(".userInfo").html("Zaznacz którą kategorię chcesz usunąć");
        $("#categoryName").hide();
    });
});

$(function(){
    if($("#incomeAddButton").on('click', function(){
        $("#categoryType").val('incomes');
    }));
    if($("#incomeEditButton").on('click', function(){
        $("#categoryType").val('incomes');
    }));
    if($("#incomeDeleteButton").on('click', function(){
        $("#categoryType").val('incomes');
    }));
});

$(function(){
    if($("#expenseAddButton").on('click', function(){
        $("#categoryType").val('expenses');
    }));
    if($("#expenseEditButton").on('click', function(){
        $("#categoryType").val('expenses');
    }));
    if($("#expenseDeleteButton").on('click', function(){
        $("#categoryType").val('expenses');
    }));
});

$(function(){
    if($("#paymentAddButton").on('click', function(){
        $("#categoryType").val('payment_methods');
    }));
    if($("#paymentEditButton").on('click', function(){
        $("#categoryType").val('payment_methods');
    }));
    if($("#paymentDeleteButton").on('click', function(){
        $("#categoryType").val('payment_methods');
    }));
});