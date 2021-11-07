api_url = base_url + "api/v1/";

// ############################ csrf_token & access_token ############################
function get_csrf_token()
{
    var csrf_token="";

    if(user_datas) {
        csrf_token = user_datas.csrf_token;
    }

    return csrf_token;
}

function append_csrf_token_to_form()
{
    return "&csrf_token="+ $('[name="csrf_token"]').attr('content');
}

function append_access_token()
{

    var access_token = localStorage.getItem("access_token");
    if(access_token) {
        return "&access_token="+access_token;
    }else{
        return "";
    }
}

// ############################ Espace_client_functions ############################
function load_include_page(page, check_loged=true)
{
    var str;

    $('#included_page').html("");
    $('#included_loading').show();

    $.ajax(
        {
            url: esc_url + "aj.php?page="+page,
            cache: false,
            data: str,
            success: function (html) {

                $('#included_page').html(html);

                refresh_user_datas(
                    function () {
                        $('#included_page').show();
                        $('#included_loading').hide();
                    }
                );

                if(check_loged==true) {
                    check_login(false);
                }
            }
        }
    );
}

function load_form(form_name, callback)
{
    var str, return_html;

    $('#loading_'+form_name+'_form').show();

    $.ajax(
        {
            url: esc_url + "aj.php?form="+form_name,
            cache: false,
            data: str,
            success: function (html) {
                $('#loading_'+form_name+'_form').hide();
                $('#div_'+form_name+'_form').html(html);
                callback();
            }
        }
    );
}

// Menu
var v_menu_id = "mon_compte";

function select_in_menu()
{
    $('.x-navigation li').removeClass("active");
    $('#menu_li_'+v_menu_id).addClass("active");
}


// ############################ notifications ############################
var notifications_interval = (60 * 1000) * 0.5; // 30 sec
var default_page_title = $('title').html();

function check_login(refreshing_user_data = true)
{

    console.log("check_login("+refreshing_user_data+")");

    if(refreshing_user_data) {
        refresh_user_datas(
            function () {
                if(user_datas.success == "no") {
                    logout();
                }
            }
        )
    }else{
        if(user_datas && user_datas.success == "no") {
            logout();
        }
    }
}

function get_user_notifications(callback)
{
    console.log("get_user_notifications() ");

    var str="";
    str += append_access_token();
    //str += "&from=website" + append_csrf_token_to_form();
    $.ajax(
        {
            url: api_url + "notifications.php",
            cache: false,
            data: str,
            type:"post",
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                console.error("xhr.status = "+xhr.status);
                console.error("thrownError = "+thrownError);
            },
            success: function (reponse) {
                process_get_user_notifications(
                    reponse, function () {
                        if(typeof callback === "function") {
                            callback();
                        }
                    }
                )
            }
        }
    );
}

function process_get_user_notifications(reponse, callback=null)
{
    console.log("refresh_user_datas() "+reponse.success);
    if(reponse.success == 'yes') {
        var notifications_count = reponse.notifications.length;
        $(".notifications_count").html(notifications_count);

        if(notifications_count>0) {
            $('title').html('['+notifications_count+'] '+default_page_title);
        }else{
            $('title').html(default_page_title);
        }
        // alert("count = "+notifications_count);
        //
        $('#notifications_list').html("");
        var rows_notification = "";
        for (var key in reponse.notifications){
            // alert("type = "+reponse.notifications[key].type);
            if(reponse.notifications[key].type=="transaction") {
                rows_notification += '<a href="javascript:;" class="list-group-item" onclick="show_transaction(\''+reponse.notifications[key].transaction_id+'\')">';
                rows_notification += '<span  class="fa fa-bell fa-4x pull-left" style="color:#73be28"></span>';
                rows_notification += '<span class="contacts-title">'+user_datas.transaction_types[reponse.notifications[key].transaction_type]+'</span>';
                rows_notification += '<p>'+reponse.notifications[key].transaction_comments+'</p>';
                rows_notification += '</a>';
            }else if (reponse.notifications[key].type=="message") {

                rows_notification += '<a href="javascript:;" class="list-group-item" onclick="show_notification(\''+reponse.notifications[key].id+'\')">';
                rows_notification += '<span class="fa fa-envelope fa-4x pull-left" style="color:#73be28"></span>';
                rows_notification += '<span class="contacts-title">Message</span>';
                rows_notification += '<p>'+reponse.notifications[key].message+'</p>';
                rows_notification += '</a>';
            }

        }
        $('#notifications_list').html(rows_notification);
    }

    if(typeof callback === "function") {
        callback();
    }
}

function set_notifications_interval()
{
    var last_notifications_time = localStorage.getItem("last_notifications_time");

    if(Date.now() - last_notifications_time >= notifications_interval) {
        localStorage.setItem("last_notifications_time", Date.now());
        if(append_access_token()!="") { get_user_notifications();
        }
    }

}

setInterval(
    function () {
        set_notifications_interval();
    }, 1000
);

// ############################ Check mobile confirmation ############################
var check_mobile_confirmation = false;
var check_mobile_confirmation_interval = (60 * 1000) * 0.1; // 10 sec

function get_check_mobile_confirmation()
{
    console.log("get_check_mobile_confirmation() ");

    var str="";
    str += append_access_token();
    //str += "&from=website" + append_csrf_token_to_form();
    $.ajax(
        {
            url: api_url + "check_mobile_confirmation.php",
            cache: false,
            data: str,
            type:"post",
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                console.error("xhr.status = "+xhr.status);
                console.error("thrownError = "+thrownError);
            },
            success: function (reponse) {
                if(reponse.confirm_mobile != user_datas.confirm_mobile) {
                    check_mobile_confirmation = false;
                    var swal_msg = '<p>Votre numéro mobile <b>'+reponse.mobile+'</b> a été bien confirmé</p>';
                    swal_msg += '<p>Vous allez recevoir un email avec le reste de code pin</p>';
                    if(reponse.pin_code) { swal_msg +='<p class="text-center">Code pin : <b>'+reponse.pin_code+'</b></p>';
                    }
                    swal(
                        {
                            title:'Confirmation de votre numéro mobile',
                            html: swal_msg,
                            type:'success'
                        }
                    );
                    refresh_user_datas();
                }
            }
        }
    );
}

function set_check_mobile_confirmation_interval()
{
    var last_check_mobile_confirmation_time = localStorage.getItem("last_check_mobile_confirmation_time");

    if(Date.now() - last_check_mobile_confirmation_time >= check_mobile_confirmation_interval) {
        localStorage.setItem("last_check_mobile_confirmation_time", Date.now());
        if(append_access_token()!="") { get_check_mobile_confirmation();
        }
    }

}

setInterval(
    function () {
        if(check_mobile_confirmation) {
            set_check_mobile_confirmation_interval();
        }
    }, 1000
);

// ############################ Refresh_user_datas ############################
var redirected_to_profile = false;

function refresh_user_datas(callback=null)
{
    console.log("refresh_user_datas() ");

    // if(append_access_token()==""){
    //     logout();
    //     return;
    // }


    var str="";
    str += append_access_token();
    //str += "&from=website" + append_csrf_token_to_form();
    $.ajax(
        {
            url: api_url + "user_infos.php",
            cache: false,
            data: str,
            type:"post",
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                console.error("xhr.status = "+xhr.status);
                console.error("thrownError = "+thrownError);
            },
            success: function (reponse) {
                user_datas = reponse;
                process_refresh_user_datas(
                    reponse, function () {
                        if(typeof callback === "function") {
                            callback();
                        }
                    }
                );
            }
        }
    );
}

var user_datas;

function process_refresh_user_datas(reponse, callback=null)
{

    console.log("process_refresh_user_datas() "+reponse.success);
    //console.log(reponse);
    user_datas = reponse;

    if(reponse.success == 'yes') {

        //get notifications
        get_user_notifications();

        // v_menu
        var raw_v_menu="";
        $('#v_menu').html("");
        for (var key in reponse.menu){
            raw_v_menu = '<li id="menu_li_'+reponse.menu[key]["id"]+'">';

            if(reponse.menu[key]["type"]=="mb") {
                raw_v_menu += '<a href="javascript:;" class="mb-control" data-box="#'+reponse.menu[key]["action"]+'">';
            }else{
                raw_v_menu += '<a href="'+reponse.menu[key]["action"]+'">';
            }

            raw_v_menu += '<span class="fa '+reponse.menu[key]["icon"]+'"></span> <span class="xn-text">'+reponse.menu[key]["title"]+'</span></a>';
            raw_v_menu += '</li>';

            $('#v_menu').append(raw_v_menu);
        }

        init_mb();
        select_in_menu();

        //input_user_data_wilaya
        var raw_wilaya="";
        $('.input_user_data_wilaya').html("");
        for (var key in reponse.wilayas){
            raw_wilaya = '<option value="'+key+'">'+reponse.wilayas[key]+'</option>';
            // alert(raw_wilaya);
            $('.input_user_data_wilaya').append(raw_wilaya);
        }

        //input_user_data_question
        var raw_question="";
        $('.input_user_data_question').html("");
        for (var key in reponse.questions){
            raw_question = '<option value="'+key+'">'+reponse.questions[key]+'</option>';
            $('.input_user_data_question').append(raw_question);
        }

        //input_user_data_question
        var raw_recharge_type="";
        $('.input_user_data_recharge_type').html("");
        for (var key in reponse.recharge_types){
            raw_recharge_type = '<option value="'+key+'">'+reponse.recharge_types[key]+'</option>';
            $('.input_user_data_recharge_type').append(raw_recharge_type);
        }


        //replace data in template
        $('.user_datas_img_qr_code').attr("src", api_url+"qr.php?qr_type=identity"+append_access_token());


        $('.user_data_solde').html(reponse.solde+" DA");
        $('.user_data_solde_disponible').html(reponse.solde_disponible+" DA");

        $('.user_data_mem_id').html(reponse.mem_id); $('.input_user_data_mem_id').val(reponse.mem_id);
        $('.user_data_prehashkey').html(reponse.prehashkey); $('.input_user_data_prehashkey').val(reponse.prehashkey);

        $('.user_data_firstname').html(reponse.firstname); $('.input_user_data_firstname').val(reponse.firstname);
        $('.user_data_lastname').html(reponse.lastname); $('.input_user_data_lastname').val(reponse.lastname);

        $('.user_data_email').html(reponse.email);$('.input_user_data_email').val(reponse.email);
        $('.user_data_type_account').html(reponse.type_account);$('.input_user_data_type_account').val(reponse.type_account);
        $('.user_data_type_account_id').html(reponse.type_account_id);$('.input_user_data_type_account_id').val(reponse.type_account_id);
        $('.user_data_derniere_connexion').html(reponse.derniere_connexion);
        $('.user_data_status').html(reponse.status).attr('style','background:'+reponse.status_color);
        $('.user_data_phone').html(reponse.phone);$('.input_user_data_phone').val(reponse.phone);
        $('.user_data_mobile').html(reponse.mobile);$('.input_user_data_mobile').val(reponse.mobile);
        $('.user_data_fax').html(reponse.fax);$('.input_user_data_fax').val(reponse.fax);

        $('.user_data_address').html(reponse.address);$('.input_user_data_address').val(reponse.address);
        $('.user_data_city').html(reponse.city);$('.input_user_data_city').val(reponse.city);
        $('.user_data_postcode').html(reponse.postcode);$('.input_user_data_postcode').val(reponse.postcode);
        $('.user_data_wilaya').html(reponse.wilaya);$('.input_user_data_wilaya').val(reponse.wilaya);

        $('.user_data_company').html(reponse.company);$('.input_user_data_company').val(reponse.company);
        $('.user_data_nrc').html(reponse.nrc);$('.input_user_data_nrc').val(reponse.nrc);
        $('.user_data_nnif').html(reponse.nnif);$('.input_user_data_nnif').val(reponse.nnif);
        $('.user_data_nart').html(reponse.nart);$('.input_user_data_nart').val(reponse.nart);
        $('.user_data_nfis').html(reponse.nfis);$('.input_user_data_nfis').val(reponse.nfis);

        $('.user_data_question').html(reponse.question);$('.input_user_data_question').val(reponse.question);

        var show_my_profile_note = 0;
        // profile not empty
        if(reponse.firstname!="") {
            $(".readonly_if_not_empty").attr('disabled', true);
        }
        if(reponse.empty=="1") {
            // redirected_to_profile = true;
            // load_include_page("my_profile");
            location.href = esc_url + "#my_profile/";
            // alert("my_profile_note");
            show_my_profile_note = 1;
        }

        if(show_my_profile_note!=0) {
            $("#my_profile_note").show(800);
            if(user_datas.firstname != "" && user_datas.address == "") {
                $('#li_my_profile_tab2 a').tab("show");
            }else if(user_datas.type_account_id != 0 && user_datas.address != "" ) {
                $('#li_my_profile_tab3 a').tab("show");
            }
        }

        // hide entreprise tab if is "Particulier"
        if(reponse.type_account_id == "0") {
            $(".panel_entreprise").hide(); // home
            $("#my_profile_tab3").hide(); //edit profile
            $("#li_my_profile_tab3").hide(); //edit profile
        }

        // 5 last_transactions
        fill_history_table('#tbody_last_transactions', reponse.last_transactions);

        // pending_payments
        fill_history_table('#tbody_pending_payments', reponse.pending_payments);


        // emails list
        $('#tbody_emails_list').html("");
        var icon_email_primary = [" ", '<span class="fa fa-check"  style="color:#73be28"></span>'];
        var icon_email_active = ['<span class="badge user_data_status " style="background:#FF0000">Non confirmé</span>', '<span class="badge user_data_status " style="background:#73be28">Confirmé</span>'];

        var raw_html="";
        for (var key in reponse.emails_list){
            raw_html = '';
            raw_html += '<tr>';
            raw_html += '<td>'+icon_email_primary[reponse.emails_list[key].primary]+'</td>';
            raw_html += '<td>'+reponse.emails_list[key].email+'</td>';
            raw_html += '<td>'+icon_email_active[reponse.emails_list[key].active]+'</td>';
            //actions
            raw_html += '<td>';
            if(reponse.emails_list[key].primary!=1) { //is not primary
                raw_html += '<button class="btn btn-default btn-rounded btn-sm" onclick="set_primary_email(\''+reponse.emails_list[key].email+'\');"><span class="fa fa-check"></span></button>';
                raw_html += '<button class="btn btn-danger btn-rounded btn-sm" onclick="delete_email(\''+reponse.emails_list[key].email+'\');"><span class="fa fa-times"></span></button>';
            }
            raw_html += '</td>';

            raw_html += '</tr>';
            $('#tbody_emails_list').append(raw_html);

        }

        //emails_list
        if(reponse.emails_list.length >= 3) {
            $("#add_email_form").hide();
        }else{
            $("#add_email_form").show();
        }

        // phone confirmation
        if(reponse.mobile!="" && reponse.confirm_mobile!="1") {
            $(".confirmed_mobile").hide();
            $(".not_confirmed_mobile").show();
        }else if (reponse.mobile!="" && reponse.confirm_mobile=="1") {
            $(".confirmed_mobile").show();
            $(".not_confirmed_mobile").hide();
        }else{
            $(".confirmed_mobile").hide();
            $(".not_confirmed_mobile").hide();
        }
    }


    //callback
    if(typeof callback === "function") {
        callback();
    }
}
// # user datas

// ############################ history && order (Global) ############################
function get_transactions_icon(json_array)
{
    if(json_array.ostatus == 1) { //timer
        return "fa-clock-o";
    }else if (json_array.type == "RECHARGE") { //mobile
        return "fa-mobile";
    }else if (json_array.direction == 0) { //back
        return "fa-arrow-right";
    }else{ //forward
        return "fa-arrow-left";
    }
}

function get_transactions_actions(json_array)
{
    if(json_array.ostatus==1 && json_array.type!='RECHARGE' && json_array.sender==user_datas.user_id) { // action payer
        return '<button class="btn btn-success btn-rounded btn-lg" onclick="show_pay_order_form(\''+json_array.trxid+'\', \''+json_array.nets+'\');">Payer</button>' +
            '<button class="btn btn-warning btn-rounded btn-lg" onclick="show_reject_order_form(\''+json_array.trxid+'\', \''+json_array.nets+'\');"> Rejeter </button>';
    }
    return "";
}

function show_confirmation_mobile()
{
    swal(
        {
            title: "Confirmation de votre numéro mobile",
            html:'Veuillez renvoyer ce code <b>'+user_datas.confirm_mobile_code+'</b> par sms a ce numéro <b>'+user_datas.confirmation_mobile_number+'</b>'
            +'<div id="div_show_transaction_form"></div>',
            showCancelButton: true,
            type: 'info',
            cancelButtonText: "Fermer",
            showConfirmButton: false,
            showLoaderOnConfirm: false,
            allowOutsideClick: false,
            width : 650
        }
    )

    check_mobile_confirmation = true;
}

function show_transaction(transaction_id)
{
    swal(
        {
            title: "Détails de transaction",
            html:'<div class="loader" id="loading_show_transaction_form" name="loading_show_transaction_form" ></div>'
            +'<div id="div_show_transaction_form"></div>',
            showCancelButton: true,
            cancelButtonText: "Fermer",
            showConfirmButton: false,
            showLoaderOnConfirm: false,
            allowOutsideClick: false,
            width : 650
        }
    )


    var str = "transaction_id="+transaction_id;
    str += append_access_token();

    $.ajax(
        {
            url: api_url + "get_transaction.php",
            cache: false,
            data: str,
            type:"post",
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                console.error("xhr.status = "+xhr.status);
                console.error("thrownError = "+thrownError);
                $("#loading_product_code_form").hide();
                $("#div_product_code_form").show();
            },
            success: function (reponse) {
                get_user_notifications();
                //process_get_products_list(html);
                $("#loading_show_transaction_form").hide();
                $("#div_show_transaction_form").show();

                load_form(
                    "show_transaction",function () {
                        $("#show_transaction_reference").html('<b>'+reponse.transaction.trxid+'</b>')
                        $("#show_transaction_date").html('<b>'+reponse.transaction.tdate+'</b>')
                        $("#show_transaction_identifiant").html('<b>'+reponse.transaction.recvuser+'</b>')
                        $("#show_transaction_montant").html('<b>'+reponse.transaction.amount+'</b>')
                        $("#show_transaction_frais").html('<b>'+reponse.transaction.fees+'</b>')
                        $("#show_transaction_paye").html('<b>'+reponse.transaction.nets+'</b>')
                        $("#show_transaction_type").html('<b>'+reponse.transaction.type+'</b>')
                        $("#show_transaction_status").html('<b>'+reponse.transaction.status+'</b>')
                        $("#show_transaction_description").html('<b>'+reponse.transaction.comments+'</b>');
                        action_pending_payments = get_transactions_actions(reponse.transaction);
                        $("#show_transaction_actions").html(action_pending_payments);
                    }
                )

            }
        }
    );
}
function show_notification(notification_id)
{
    swal(
        {
            title: "Message de notification",
            html:'<div class="loader" id="loading_show_notification_form" name="loading_show_notification_form" ></div>'
            +'<div id="div_show_notification_form"></div>',
            showCancelButton: true,
            cancelButtonText: "Fermer",
            showConfirmButton: false,
            showLoaderOnConfirm: false,
            allowOutsideClick: false,
            width : 650
        }
    )


    var str = "notification_id="+notification_id;
    str += append_access_token();

    $.ajax(
        {
            url: api_url + "get_notification.php",
            cache: false,
            data: str,
            type:"post",
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                console.error("xhr.status = "+xhr.status);
                console.error("thrownError = "+thrownError);
                $("#loading_product_code_form").hide();
                $("#div_product_code_form").show();
            },
            success: function (reponse) {
                get_user_notifications();
                //process_get_products_list(html);
                $("#loading_show_notification_form").hide();
                $("#div_show_notification_form").show();

                load_form(
                    "show_notification",function () {
                        $("#show_notification_message").html('<b>'+reponse.notification.message+'</b>')
                    }
                )

            }
        }
    );
}

function fill_history_table(container, json_datas, clear_container=true)
{

    if(clear_container==true) { 
        $(container).html("");
    }
    var action_pending_payments="";
    var raw_html="";
    for (var key in json_datas){
        action_pending_payments = get_transactions_actions(json_datas[key]);
        transactions_icon = get_transactions_icon(json_datas[key]);
        raw_html = '';
        raw_html += '<tr>';
        raw_html += '<td><span class="fa '+transactions_icon+'"></span></td>';
        raw_html += '<td>'+json_datas[key].username+'</td>';
        raw_html += '<td>'+json_datas[key].amount+'</td>';
        raw_html += '<td>'+json_datas[key].fees+'</td>';
        raw_html += '<td>'+json_datas[key].nets+'</td>';
        raw_html += '<td>'+json_datas[key].tdate+'</td>';
        raw_html += '<td>'+json_datas[key].type+'</td>';
        raw_html += '<td><span class="badge bg_status_'+json_datas[key].ostatus+'" >'+json_datas[key].status+'</span></td>';
        raw_html += '<td>';
        raw_html += '<button class="btn btn-default btn-rounded btn-sm" onclick="show_transaction(\''+json_datas[key].id+'\');"><span class="fa fa-info-circle"></span></button> ';
        raw_html += action_pending_payments+'</td>';
        raw_html += '</tr>';
        $(container).append(raw_html);
    }
}

function show_pay_order_form(trxid, nets)
{
    swal(
        {
            title: "Paiement de commande",
            html:'<div class="loader" id="loading_pay_order_form" name="loading_pay_order_form" ></div>'
            +'<div id="div_pay_order_form"></div>',
            showCancelButton: true,
            cancelButtonText: "Annuler",
            showConfirmButton: false,
            showLoaderOnConfirm: false,
            allowOutsideClick: false,
            width : 650
        }
    )

    load_form(
        "pay_order",function () {
            $("#loading_pay_order_form").hide();
            $("#div_pay_order_form").show();

            $('#order_trxid').html(trxid);
            $('#order_nets').html(nets);
            $('#trx_id').val(trxid);

        }
    );
}

function pay_order()
{
    console.log("pay_order() ");
    reset_error_form();

    var str = $("#pay_order_form").serialize()+"&mode=add";
    str += "&from=website" + append_csrf_token_to_form();
    str += append_access_token();

    $('#loading_pay_order').show();
    $('#btn_pay_order').hide();

    $.ajax(
        {
            url: api_url + "confirm_payment.php",
            cache: false,
            data: str,
            type:"post",
            dataType: 'json',
            error: function (xhr, ajaxOptions, thrownError) {
                console.error("xhr.status = "+xhr.status);
                console.error("thrownError = "+thrownError);
                $('#loading_pay_order').hide();
                $('#btn_pay_order').show();
            },
            success: function (html) {
                $('#loading_pay_order').hide();
                $('#btn_pay_order').show();
                process_pay_order(html);
            }
        }
    );
}

function process_pay_order(reponse)
{
    if(reponse.success=="yes") {
        let pay = 'effectué';
        if (reponse.transaction.status == "ANNULER"){
            pay = 'annulé';
        }
        swal(
            {
                title:'Paiement '+pay+' avec succes',
                html:'N° transaction:<b>'+reponse.transaction.trxid+'</b>'
                +'<br>Montant: <b>'+reponse.transaction.oamount+' DA</b>',
                timer: 4000,
                type:'success'
            }
        );
        load_include_page("history");
        //setTimeout(function(){ location.reload(); }, 4000);
    }else{

        loop_errors_form(reponse.errors);

        if(reponse.errors.confirm_payment!="") {
            swal(
                {
                    title: 'Paiement de commande!',
                    text: reponse.errors.confirm_payment,
                    timer: 4000,
                    type:  'error'
                }
            )
        }

    }
}

function show_reject_order_form(trxid, nets)
{
    swal(
        {
            title: "Annulation de commande",
            html:'<div class="loader" id="loading_reject_order_form" ></div>'
                +'<div id="div_reject_order_form"></div>',
            showCancelButton: true,
            cancelButtonText: "Annuler",
            showConfirmButton: false,
            showLoaderOnConfirm: false,
            allowOutsideClick: false,
            width : 650
        }
    )

    load_form(
        "reject_order",function () {
            $("#loading_pay_order_form").hide();
            $("#div_pay_order_form").show();

            $('#order_trxid').html(trxid);
            $('#order_nets').html(nets);
            $('#trx_id').val(trxid);

        }
    );
}