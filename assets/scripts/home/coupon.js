function getback (data) {
    if(data.code== '1000')
    {
        $('#coupon_form_submit_btn').before('<h3 class="req">已领取</h3>');
        $('#coupon_form_submit_btn').remove();
    }
}